<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
//定时任务
class Sd_Timing_WxShopPage extends MobilePage
{      
    /**
     * [frozenOrder 冻结]
     * @return [type] [description]
     */
    public function frozenOrder()
    {   
        $fp = fopen("../data/frozenOrder.txt", "w+");
        $result = false;
        if(flock($fp,LOCK_EX)){
            global $_W;
            $uniacid = intval($_W['uniacid']);
            $freeze_time = $_W['shopset']['grabsingle']['freeze_time1'];

            $order = pdo_fetchall(' select id, createtime from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and status <> 2 and freeze = 0 order by createtime asc limit 100 ', array(':uniacid' => $uniacid));
            foreach ($order as $key => $value) {
                $isComplete = pdo_fetch(' select id, uid, price from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and status <> 2 and freeze = 0 and id = :id ', array(':uniacid' => $uniacid, ':id' => $value['id']));
                if(empty($isComplete)){
                    continue;
                }
                if(time() >= ($value['createtime'] + $freeze_time)){
                    $log = array(
                        'uniacid'       => $uniacid,
                        'uid'           => $isComplete['uid'],
                        'gold'          => $isComplete['price'],
                        'budget'        => 0,
                        'type'          => 6,
                        'createtime'    => time(),
                        'title'         => '抢单冻结',
                        'rid'           => $value['id'],
                    );
                    pdo_insert("wx_shop_sd_gold_log",$log);//钱包记录
                    pdo_update('wx_shop_sd_order', array('freeze' => 1, 'paytime' => time()), array('id' => $value['id']));
                } 
            }
            flock($fp,LOCK_UN);
            fclose($fp);
            return $result;
        }
    }

    /**
     * [thaw 自动解冻]
     * @return [type] [description]
     */
    public function thaw()
    {   
        $fp = fopen("../data/thaw.txt", "w+");
        $result = false;
        if(flock($fp,LOCK_EX)){
            global $_W;
            $uniacid = intval($_W['uniacid']);
            $freeze_time = $_W['shopset']['grabsingle']['freeze_time'];
            $sd_model = m('sd_model');
            $order = pdo_fetchall(' select id, paytime from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and freeze = 1 order by createtime asc limit 100 ', array(':uniacid' => $uniacid));
            foreach ($order as $key => $value) {
                $isComplete = pdo_fetch(' select id, price, uid from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and freeze = 1 and id = :id ', array(':uniacid' => $uniacid, ':id' => $value['id']));

                if(empty($isComplete)){
                    continue;
                }

                if(time() >= ($value['paytime'] + $freeze_time)){
                    $member = pdo_fetch(' select id, openid from ' . tablename('wx_shop_member') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $isComplete['uid']));
                    if(empty($member)){
                        continue;
                    }
                    $result1 = $sd_model->setGold($member['id'], $member['openid'], 'credit2', $isComplete['price'], 1, $value['id'], 61);//订单解冻
                    if($result1){
                        pdo_update('wx_shop_sd_order', array('freeze' => 2, 'finishtime' => time()), array('id' => $value['id']));
                    }
                }
            }

            flock($fp,LOCK_UN);
            fclose($fp);
            return $result;
        }
    }

    /**
     * [isExtract 理财自动提取]
     * @return boolean [description]
     */
    public function extract()
    {
        $fp = fopen("../data/extract.txt", "w+");
        $result = false;
        if(flock($fp,LOCK_EX)){
            global $_W;
            $uniacid = intval($_W['uniacid']);
            $sd_model = m('sd_model');

            $list = pdo_fetchall(' select id, createtime from ' . tablename('wx_shop_sd_transactions_list') . ' where uniacid = :uniacid and status = 0 order by createtime asc limit 100 ', array(':uniacid' => $uniacid));

            foreach ($list as $key => $value) {
                $isComplete = pdo_fetch(' select * from ' . tablename('wx_shop_sd_transactions_list') . ' where uniacid = :uniacid and status = 0 and id = :id ', array(':uniacid' => $uniacid, ':id' => $value['id']));

                if(time() >= ($isComplete['createtime'] + $isComplete['regular'] * 86400)){
                    // $money = round($isComplete['money'] + $isComplete['interest'], 2);
                    // if($money > 0){
                    if($isComplete['money'] > 0 && $isComplete['interest'] > 0){
                        $member = pdo_fetch(' select id, openid from ' . tablename('wx_shop_member') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $isComplete['uid']));
                        if(empty($member)){
                            continue;
                        }

                        $result = $sd_model->setGold($member['id'], $member['openid'], 'credit2', $isComplete['money'], 1, $isComplete['id'], 72);
                        $result1 = $sd_model->setGold($member['id'], $member['openid'], 'credit2', $isComplete['interest'], 1, $isComplete['id'], 71);
                        if($result1){
                            pdo_update('wx_shop_sd_transactions_list', array('status' => 3, 'updatetime' => time()), array('id' => $isComplete['id']));
                        }
                    }  
                }
            }

            flock($fp,LOCK_UN);
            fclose($fp);
            return $result;
        }
    }
}