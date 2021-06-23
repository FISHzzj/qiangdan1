<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}

class Sd_Goldcans_WxShopPage extends MobilePage
{   
    protected $member;
    public function __construct() 
    {
        global $_W;
        global $_GPC;
        parent::__construct();
        // $openid = trim($_GPC['openid']);
        $openid = base64_decode($_GPC['openid']);
        $this->member = m('member')->getMember($openid);
        if(!$this->member){
            show_json(0, '请登录');
        }

        if($this->member['isblack'] == 1){
            $key = '__wx_shop_member_session_' . $_W['uniacid'];
            isetcookie($key, false, -100);
            show_json(999, '账号已被封号');
        }
    }

    public function main()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $storageGold = pdo_fetchcolumn(' select sum(money) from ' . tablename('wx_shop_sd_transactions_list') . ' where uniacid = :uniacid and uid = :uid and status in(0, 1) ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        $cumulative = pdo_fetchcolumn(' select sum(money) from ' . tablename('wx_shop_sd_transactions_list') . ' where uniacid = :uniacid and uid = :uid and status = 3 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));

        $info = array(
            'gold'                      => $this->member['credit2'],
            'storageGold'               => empty($storageGold) ? 0 : round($storageGold, 2),//已存金额
            'cumulative'                => empty($cumulative) ? 0 : round($cumulative, 2),//累计收益（元）
            'cumulativeEarningRate'     => 0,//累计收益率
            'introduce'                 => $set = $_W['shopset']['grabsingle']['transactions'],//理财介绍
        );

        $row = array();
        $list = pdo_fetchall(' select id, money, interest, regular, createtime, status from ' . tablename('wx_shop_sd_transactions_list') . ' where uniacid = :uniacid and uid = :uid and status = 0 order by createtime desc ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        foreach ($list as $key => $value) {
            $row[$key]['id']            = $value['id'];
            $row[$key]['money']         = $value['money'];
            $row[$key]['interest']      = $value['interest'];
            $row[$key]['expiretime']    = date('Y-m-d H:i', $value['regular'] * 86400 + $value['createtime']);
            $row[$key]['createtime']    = date('Y-m-d H:i', $value['createtime']);
            // $row[$key]['status']        = $value['status'];//已改成自动提取
        }
        unset($list);
        show_json(1, array(
            'info'  => $info,
            'list'  => $row,
        ));
    }

    /**
     * [investment 理财投入]
     * @return [type] [description]
     */
    public function investment()
    {
        global $_W;
        global $_GPC;
        $op = empty($_GPC['op']) ? 'display' : trim($_GPC['op']);
        $uniacid = intval($_W['uniacid']);

        $set = pdo_fetchall(' select id, day, min, max, income_ratio from ' . tablename('wx_shop_sd_transactions_set') . ' where uniacid = :uniacid and enabled = 1 order by day asc ', array(':uniacid' => $uniacid));
        if(empty($set)){
            show_json(0, '没有理财设置');
        }

        if($op == 'sub'){
            $id = intval($_GPC['id']);
            $money = floatval($_GPC['money']);

            if($money <= 0){
                show_json(0, '请输入投入金额');
            }

            if($id <= 0){
                show_json(0, '请选择理财天数');
            }

            $info = pdo_fetch(' select day, min, max, income_ratio from ' . tablename('wx_shop_sd_transactions_set') . ' where uniacid = :uniacid and enabled = 1 and id = :id ', array(':uniacid' => $uniacid, ':id' => $id));
            if(empty($info)){
                show_json(0, '系统繁忙，请稍后再试');
            }

            if(floatval($info['min']) > $money && floatval($info['min']) > 0){
                show_json(0, '最小投入金额'.$info['min'].'元');
            }

            if(floatval($info['max']) < $money && floatval($info['max']) > 0){
                show_json(0, '最大投入金额'.$info['max'].'元');
            }

            $fp = fopen("../data/business/".$this->member['id'].".txt", "w+");
            if(flock($fp,LOCK_EX | LOCK_NB)){
                $sd_model = m('sd_model');
                $result = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', -$money, 1, 0, 7);
                if($result){
                    $data = array(
                        'uniacid'       => $uniacid,
                        'uid'           => $this->member['id'],
                        'money'         => $money,
                        'regular'       => $info['day'],
                        'interest'      => round($money * $info['income_ratio'] / 100, 2),
                        'income_ratio'  => $info['income_ratio'],
                        'createtime'    => time(),
                    );
                    pdo_insert('wx_shop_sd_transactions_list', $data);
                    flock($fp,LOCK_UN);
                    fclose($fp);
                    show_json(1, '投入成功');
                }else{
                    flock($fp,LOCK_UN);
                    fclose($fp);
                    show_json(1, '系统繁忙，请稍后再试');
                } 
            }
        }
        show_json(1, $set);
    }

    /**
     * [extract 提取]（已修改自动提取）可提前提取，不算收益
     * @return [type] [description]
     */
    public function extract()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $op = empty($_GPC['op']) ? 'display' : trim($_GPC['op']);
        $id = intval($_GPC['id']);

        $info = pdo_fetch(' select * from ' . tablename('wx_shop_sd_transactions_list') . ' where uniacid = :uniacid and id = :id and uid = :uid and status in(0,1) ', array(':uniacid' => $uniacid, ':uid' => $this->member['id'], ':id' => $id));
        if(empty($info)){
            show_json(0, '该理财已提取');
        }

        if($op == 'sub'){
            if($info['status'] == 1){
                $money = round($info['money'] + $info['interest'], 2);
            }else{
                $money = $info['money'];
            }

            if($money > 0){
                $fp = fopen("../data/business/".$this->member['id'].".txt", "w+");
                if(flock($fp,LOCK_EX | LOCK_NB)){
                    $sd_model = m('sd_model');
                    $result = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', $money, 1, $info['id'], 71);
                    if($result){
                        pdo_update('wx_shop_sd_transactions_list', array('status' => 3, 'updatetime' => time()), array('id' => $info['id']));
                        show_json(1, '提取成功');
                    }else{
                        show_json(0, '系统繁忙，请稍后再试');
                    }
                }
            }else{
                show_json(0, '金额错误，请联系客服');
            }
        }

        if($info['status'] == 1){
            $str = '提取后返还本金：'.$info['money'].'元，利息：'.$info['interest'].'元';
        }else{
            $str = '该理财还未到期，提前提取将不产生利息，确认提取？';
        }
        show_json(1, $str);
    }
}