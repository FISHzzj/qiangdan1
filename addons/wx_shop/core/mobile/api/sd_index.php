<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
    exit('Access Denied');
}

class Sd_Index_WxShopPage extends MobilePage
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

        //账户信息
            $info = array(
                'avatar'                => $this->member['avatar'],
                'nickname'              => $this->member['nickname'],
                'mobile'                => $this->member['mobile'],
                'gold'                  => $this->member['credit2'],
                'ydProfit'              => 0,//昨日收益
                'cumulativeProfit'      => 0,//累计收益
                'cumulativeEarningRate' => 0,//累计收益率
                'news'                  => 0,//未读消息（个人消息）
            );
        //收益
            $yesterdayStart=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
            $yesterdayEnd=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
            $ydProfit = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and budget = 0 and (type = 4 or type = 5 or type = 71) and createtime >= :starttime and createtime <= :endtime ', array(':uniacid' => $uniacid, ':uid' => $this->member['id'], ':starttime' => $yesterdayStart, ':endtime' => $yesterdayEnd));
            $cumulativeProfit = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and budget = 0 and (type = 4 or type = 5 or type = 71) ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
            $info['ydProfit']           = empty($ydProfit) ? 0 : floatval($ydProfit);
            $info['cumulativeProfit']   = empty($cumulativeProfit) ? 0 : floatval($cumulativeProfit);
            // $info['cumulativeEarningRate'] = ($this->member['credit2'] == 0 || $info['cumulativeProfit'] == 0) ? 0 : round($info['cumulativeProfit'] / $this->member['credit2'] * 100, 2);
            
            //抢单总本金
            $totlaGold = pdo_fetchcolumn(' select sum(price) from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and uid = :uid and status = 2 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
            $info['cumulativeEarningRate'] = ($totlaGold == 0 || $info['cumulativeProfit'] == 0) ? 0 : round($info['cumulativeProfit'] / $totlaGold * 100, 2);

        //公告
            $noticeList = pdo_fetchall('select id, title from '.tablename('wx_shop_notice').' where status = 1 order by displayorder asc');
            $notice = array(
                'elasticFrame'  => $_W['shopset']['grabsingle']['notice'],//弹框公告
                'roll'          => $noticeList,//滚动公告
                'cooperation'   => $_W['shopset']['grabsingle']['content1'],//合作
                'rule'          => $_W['shopset']['grabsingle']['content3'],//规则
            );

        //任务大厅
            $hallAll = array();//初始化任务大厅列表
            $levelset = m('common')->getSysset('shop');

            //所有等级
            $levelAll = pdo_fetchall(' select level, levelname, hallname, c_proportion, picture, recharge, invitations_num from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid order by level asc ', array(':uniacid' => $uniacid));
            
            $hallAll[0] = array(//默认等级大厅
                'level'         => 0,
                'levelname'     => (empty($levelset['levelname'])       ? '普通等级' : $levelset['levelname']),
                'hallname'      => (empty($levelset['hallname'])        ? '--'       : $levelset['hallname']), //默认大厅名称
                'c_proportion'  => (empty($levelset['c_proportion'])    ? 0          : $levelset['c_proportion']),//等级大厅的佣金比例，该大厅接取任务，按照此佣金比例计算佣金
                'picture'       => (empty($levelset['picture'])         ? ''         : tomedia($levelset['picture'])),//大厅图片
                'status'        => 1,
            );

            foreach ($levelAll as $key => $value) {
                $hallAll[intval($key+1)] = array(
                    'level'         => $value['level'],
                    'levelname'     => empty($value['levelname'])       ? '--'  : $value['levelname'],
                    'hallname'      => empty($value['hallname'])        ? '--'  : $value['hallname'],
                    'c_proportion'  => empty($value['c_proportion'])    ? 0     : $value['c_proportion'],
                    'picture'       => empty($value['picture'])         ? '--'  : tomedia($value['picture']),
                );

                $newInvitationNum = array();
                $InvitationNum = pdo_fetchall(' select m.id, sum(gl.gold) as recharge from ' . tablename('wx_shop_member') . ' m ' . ' left join ' . tablename('wx_shop_sd_gold_log') . ' gl on gl.uid = m.id ' . ' where m.uniacid = :uniacid and m.agentid = :id and gl.type in(2,21) group by gl.uid order by sum(gl.gold) desc ', array(':uniacid' => $uniacid, ':id' => $this->member['id']));
                foreach ($InvitationNum as $key1 => $value1) {
                    if($value1['recharge'] >= $value['recharge']){//个人累计充值满足升级条件
                        $newInvitationNum[] = $value1;
                    }
                    unset($InvitationNum[$key1]);
                }

                $newInvitationCount = 0;
                if(!empty($newInvitationNum)){
                    $newInvitationCount = count($newInvitationNum);
                }

                $difference = intval($value['invitations_num'] - $newInvitationCount);
                if($difference > 0){
                    $hallAll[intval($key+1)]['status'] = 0;
                }else{
                    $hallAll[intval($key+1)]['status'] = 1;
                }
            }
            unset($levelAll);

        //会员动态
            $sd_model = m('sd_model');
            $dynamic = array();
            $log = pdo_fetchall(' select o.id, o.commission, o.finishtime, m.nickname, o.halllevel from ' . tablename('wx_shop_sd_order') . ' o ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = o.uid ' . ' where o.uniacid = :uniacid and o.status = 2 order by o.finishtime desc limit 30 ', array(':uniacid' => $uniacid));
            foreach ($log as $key => $value) {
                $hallname = pdo_fetchcolumn(' select hallname from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level = :level ', array(':uniacid' => $uniacid, ':level' => $value['halllevel']));
                if(empty($hallname)){
                    $hallname = $hallAll[0]['hallname'];
                }
                $dynamic[$key] = array(
                    'name'      => $sd_model->substr_cut($value['nickname'], 3, 0),
                    'hallname'  => $hallname,
                    'price'     => $value['commission'],
                    'createtime'=> date('m-d H:i', $value['finishtime']),
                );
            }
            unset($log);

        //其他设置
            //收益计算
            $profitSet = m('common')->getSysset('grabsingle')['limit'];//每天最大抢单数
            $cftSet = pdo_fetchcolumn('SELECT discount FROM'.tablename('7033_lcset').' WHERE uniacid=:uniacid AND enabled=1 order by discount desc limit 1 ', array(':uniacid' => $uniacid));//理财每天最大收益率
            $thisCommission = pdo_fetchcolumn(' select c_proportion from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level = :level ', array(':uniacid' => $uniacid, ':level' => $this->member['level']));
            if(empty($thisCommission)){//如果为空，就用默认等级的返佣比例，如果默认没有就是0；
                $thisCommission = (empty($levelset['c_proportion']) ? 0 : $levelset['c_proportion']);
            }

            $grabSheetMax = 0;//抢单最大收益率
            if($profitSet > 0 && !empty($profitSet)){
                $grabSheetMax = floatval($profitSet*$thisCommission/100);
            }

            $cftMax = 0;//理财最大收益率
            if($cftSet > 0 && !empty($cftSet)){
                $cftMax = floatval($cftSet/100);
            }

        //未读消息
            $unreadNum = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type in(2,3,31) and unread = 0 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
            if(empty($unreadNum)){
                $unreadNum = 0;
            }
            $info['news'] = $unreadNum;

        show_json(1, array(
            'info'      => $info,
            'notice'    => $notice,
            'hallall'   => $hallAll,
            'dynamic'   => $dynamic,
            'oset'      => array(
                'grabSheetMax'  => $grabSheetMax,
                'cftMax'        => $cftMax
            ),
        ));
    }

    //消息
    public function notice()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $op = empty($_GPC['op']) ? 'display' : trim($_GPC['op']);

        $type = intval($_GPC['type']);//1个人消息 2系统公告

        /*if($op == 'sub'){
            $id = intval($_GPC['id']);
            $condition = ' and uniacid = :uniacid and id = :id ';
            $params = array(
                ':uniacid' => $uniacid,
                ':id'      => $id,
            );
            if($type == 1){
                $condition .= ' and uid = :uid and type in(2,3,31)';
                $params[':uid'] = $this->member['id'];
                $sql = ' select id, gold, createtime, title from ' . tablename('wx_shop_sd_gold_log') . ' where 1 ' . $condition;
            }else{
                $condition .= ' and status = 1 ';
                $sql = ' select id,title,detail,createtime from ' . tablename('wx_shop_notice') . ' where 1 ' . $condition;
            }

            $info = pdo_fetch($sql, $params);

            if($type == 1){
                pdo_update('wx_shop_sd_gold_log', array('unread' => 1), array('id' => $info['id']));
            }
            
            $info['createtime'] = date('Y-m-d H:i', $info['createtime']);
            show_json(1, array('info' => $info));
        }*/

        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;

        $condition = ' and uniacid = :uniacid ';
        $params = array(
            ':uniacid' => $uniacid,
        );
        if($type == 1){
            $condition .= ' and uid = :uid and type in(2,3,31)';
            $params[':uid'] = $this->member['id'];
            $sql = ' select id, gold, createtime, title from ' . tablename('wx_shop_sd_gold_log') . ' where 1 ' . $condition . ' order by createtime desc ';
            $sqlTotal = ' select count(id) from ' . tablename('wx_shop_sd_gold_log') . ' where 1 ' . $condition;
            pdo_update('wx_shop_sd_gold_log', array('unread' => 1), array('uid' => $this->member['id'], 'unread' => 0));
        }else{
            $condition .= ' and status = 1 ';
            $sql = ' select id,title,detail,createtime from ' . tablename('wx_shop_notice') . ' where 1 ' . $condition . ' order by displayorder desc, createtime desc ';
            $sqlTotal = ' select count(id) from ' . tablename('wx_shop_notice') . ' where 1 ' . $condition;
        }

        $sql .= 'limit ' . (($pindex - 1) * $psize) . ',' . $psize;
        $list = pdo_fetchall($sql, $params);
        foreach ($list as $key => &$value) {
            $value['createtime'] = date('Y-m-d H:i', $value['createtime']);
        }
        unset($value);

        $total = pdo_fetchcolumn($sqlTotal, $params);

        $unreadNum = 0;
        /*if($type == 1){
            $unreadNum = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type in(2,3,31) and unread = 0 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
            if(empty($unreadNum)){
                $unreadNum = 0;
            }
        }*/
        show_json(1, array(
            'list'  => $list,
            'total' => $total,
            'page'  => $pindex,
            'unread'=> $unreadNum,
        ));
    }

    /**
     * [activityCenter 活动中心]
     * @return [type] [description]
     */
    public function activityCenter()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $op = empty($_GPC['op']) ? 'display' : trim($_GPC['op']);

        if($op == 'sub'){
            $id = intval($_GPC['id']);
            $activityInfo = pdo_fetch(' select title,createtime,detail from '.tablename('wx_shop_hdnotice').' where uniacid=:uniacid and status=1 and id=:id ', array(':uniacid' => $uniacid, ':id' => $id));
    
            $activityInfo['createtime'] = date('Y-m-d H:i:s',$activityInfo['createtime']);
            
            show_json(1, $activityInfo);
        }
        $activity = pdo_fetchall(' select id,title,createtime from ' . tablename('wx_shop_hdnotice') . ' where uniacid = :uniacid and status = 1 ',array(':uniacid' => $uniacid));

        foreach ($activity as $key => &$value) {
            $value['createtime'] = date('Y-m-d H:i:s',$value['createtime']);
        }

        show_json(1, $activity);
    }
}