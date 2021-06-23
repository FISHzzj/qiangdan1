<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}

class Sd_Customer_Service_WxShopPage extends MobilePage
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
        $op = !empty($_GPC['op']) ? trim($_GPC['op']) : 'display';
        $levelId = intval($_GPC['level']);
        if(empty($levelId)){
            $levelset = m('common')->getSysset('shop');//默认等级设置
            $levelInfo = array(
                'level'         => 0,
                'levelname'     => $levelset['levelname'],
                'hallname'      => $levelset['hallname'],
                'c_proportion'  => (empty($levelset['c_proportion']) ? 0 : $levelset['c_proportion']),//等级大厅的佣金比例，该大厅接取任务，按照此佣金比例计算佣金
            );
        }else{
            $levelInfo = pdo_fetch(' select level, levelname, hallname, c_proportion from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level = :level ', array(':uniacid' => $uniacid, ':level' => $levelId));
        }
            
        if(empty($levelInfo)){
            show_json(0, '该大厅不存在或已删除');
        }

        if($this->member['level'] < $levelInfo['level']){
            show_json(0, '该大厅还未解锁');
        }

        $goods = pdo_fetchall(' select thumb, id from ' . tablename('wx_shop_goods') . ' where uniacid = :uniacid and status = 1 and deleted = 0 order by id asc ', array(':uniacid' => $uniacid));
        foreach ($goods as $key => &$value) {
            $value['thumb'] = tomedia($value['thumb']);
        }
        unset($value);

        if($op == 'post'){
            $this->grabSheet($levelInfo);//抢单初始化
        }

        $leftLevel = pdo_fetch(' select id from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level > :level order by level asc limit 1 ', array(':uniacid' => $uniacid, ':level' => $levelInfo['level']));
        if(empty($leftLevel)){
            $levelInfo['title'] = '已经是最高等级';
        }else{
            $levelInfo['title'] = '下一等级专属通道获得更高佣金';
        }

        $info = array(
            'tasknum'   => 0,
            'taskprice' => 0,
            'frozen'    => 0,
            'gold'      => $this->member['credit2'],
            'remarks'   => $_W['shopset']['grabsingle']['qdbzsm'],//匹配说明
        );

        $tips = pdo_fetchall('SELECT tips FROM'.tablename('7033_set3').'WHERE uniacid=:uniacid ',array(':uniacid' => $uniacid));//抢单失败提示语

        show_json(1, array(
            'level'     => $levelInfo,
            'info'      => $info,
            'tips'      => $tips,
            'goods'     => $goods,
        ));
    }

    /**
     * [grabSheet 初始化抢单，返回抢单倒计时]
     * @param  [type] $levelInfo [大厅设置]
     * @return [type]            [description]
     */
    protected function grabSheet($levelInfo)
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $set = $_W['shopset']['grabsingle'];//后台抢单设置
        $taskSet = array(
            'taskNumMax'    => intval($set['limit']),//账户每天最多抢单单数
            'taskMoneyMin'  => floatval($set['qd_money']),//账户余额最低（低于不能抢单）
            'startTime'     => strtotime(date('Y-m-d '.$set['start_time'], time())),//当天抢单开始时间
            'endTime'       => strtotime(date('Y-m-d '.$set['end_time'], time())),//抢单结束时间
            'taskTime1'     => intval($set['await_time']),//抢单等待时间范围最低
            'taskTime2'     => intval($set['await_time2']),//抢单等待时间范围最高
            'taskMoneyMinRate'  => floatval($set['random_start']),//抢单金额百分比范围最小值
            'taskMoneyMaxRate'  => floatval($set['random_end']),//抢单金额百分比范围最大值
            'hangUp'            => intval($set['chongfu']),//最大挂单数量（订单未提交最大可以存在多少单）
        );

        //当天时间戳
        $startTime = strtotime(date("Y-m-d",time()));
        $endTime = $startTime + 60 * 60 * 24 - 1;

        $taskNumMax = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and uid = :uid and createtime >= :starttime and createtime <= :endtime ', array(':uniacid' => $uniacid, ':uid' => $this->member['id'], ':starttime' => $startTime, ':endtime' => $endTime));
        if(empty($taskNumMax)){
            $taskNumMax = 0;
        }

        if($taskNumMax >= $taskSet['taskNumMax']){
            show_json(0, '已达到当天最大抢单数');
        }

        if($this->member['credit2'] < $taskSet['taskMoneyMin']){
            show_json(0, '账户余额最低为'.$taskSet['taskMoneyMin'].'（元）才可以抢单');
        }

        if(time() < $taskSet['startTime'] || time() > $taskSet['endTime']){
            show_json(0, '抢单时间在每天'.$set['start_time'].'--'.$set['end_time'].'之间');
        }

        $sleepTime = mt_rand($taskSet['taskTime1'], $taskSet['taskTime2']);//睡眠时间

        $hasLog = pdo_fetch(' select id, status, second, createtime from ' . tablename('wx_shop_sd_count_down') . ' where uniacid = :uniacid and uid = :uid ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        if(empty($hasLog)){
            pdo_insert('wx_shop_sd_count_down', array(
                'uniacid'   => $uniacid,
                'uid'       => $this->member['id'],
                'second'    => $sleepTime,
                'createtime'=> time(),
            ));
        }else{
            if($hasLog['status'] == 1){
                pdo_update('wx_shop_sd_count_down', array(
                    'second'        => $sleepTime,
                    'createtime'    => time(),
                    'status'        => 0,
                ), array('uniacid' => $uniacid, 'id' => $hasLog['id']));
            }else{
                $second = $hasLog['second'] + $hasLog['createtime'];
                if(time() >= $second){

                    $result = $this->grabSheetStart($taskSet, $levelInfo);//开始抢单
                    if($result){
                        show_json(0, '你的手速单身二十年了吧');
                    }
                }else{
                    show_json(0, '你的手速单身二十年了吧');
                }  
            }   
        }
        show_json(1, array('sleep' => $sleepTime));//返回倒计时
    }

    /**
     * [grabSheetStart 生成订单(抢单开始)]
     * @param  [type] $taskSet   [抢单设置]
     * @param  [type] $levelInfo [大厅设置]
     * @return [type]            [description]
     */
    protected function grabSheetStart($taskSet, $levelInfo)
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $hasGold = $this->member['credit2'];
        $fp = fopen("../data/grabsheet/".$this->member['id'].".txt", "w+");

        $result = true;
        if(flock($fp,LOCK_EX | LOCK_NB)){
            $hangUpNum = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and uid = :uid and status = 0 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));//当前挂单数量（未提交订单数量）
            if(empty($hangUpNum)){
                $hangUpNum = 0;
            }

            if($hangUpNum >= $taskSet['hangUp'] && $taskSet['hangUp'] > 0){
                show_json(0, '未提交订单已达到上限, 请处理完再抢单');
            }

            $orderMoney = round($hasGold*mt_rand($taskSet['taskMoneyMinRate'], $taskSet['taskMoneyMaxRate'])/100, 2);//订单金额

            //商品信息
            $Goods = pdo_fetchall(' select id, title, guishu, thumb from ' . tablename('wx_shop_goods') . ' where uniacid = :uniacid and marketprice <= :money and marketprice2 >= :money and type <> 1 and deleted = 0 and status = 1 and sd_hall = :level order by id asc ', array(':uniacid' => $uniacid, ':money' => $orderMoney, ':level' => $levelInfo['level']));

            if(empty($Goods)){
                $Goods = pdo_fetchall(' select id, title, guishu, thumb from ' . tablename('wx_shop_goods') . ' where uniacid = :uniacid and type = 1 and deleted = 0 and status = 1 order by id asc ', array(':uniacid' => $uniacid));
            }
            
            if(empty($Goods)){
                show_json(0, '商品已售罄');
            }
            
            $goodsCount = count($Goods);
            $orderGoods = $Goods[mt_rand(0, $goodsCount-1)];

            //佣金
            $commission = round($orderMoney*$levelInfo['c_proportion']/100, 2);

            $sd_model = m('sd_model');
            $payResult = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', -$orderMoney, 1, $order['id'], 1);
            if(!$payResult){
                flock($fp,LOCK_UN);
                fclose($fp);
                show_json(0, '扣款失败');
            }

            //订单信息，生成订单
            $order = array(
                'uid'       => $this->member['id'],
                'uniacid' 	=> $uniacid,
                'ordersn'   => m('sd_model')->createNO('sd_order', 'ordersn', 'QD'),
                'goodsid'   => $orderGoods['id'],
                'openid'    => $this->member['openid'],
                'price'     => $orderMoney,
                'commission'=> $commission,
                'createtime'=> time(),
                'status'        => 1, 
                'paytype'       => 1, 
                'paytime'       => time(),
            );
            pdo_insert('wx_shop_sd_order', $order);
            $orderid = pdo_insertid();
            pdo_update('wx_shop_sd_count_down', array('status' => 1), array('uniacid' => $uniacid, 'uid' => $this->member['id']));
            //返回数据，前端显示订单数据
            $return = array(
                'orderid'       => $orderid,
                'goodstitle'    => $orderGoods['title'],
                'goodsid'       => $orderGoods['id'],
                'images'        => tomedia($orderGoods['thumb']),
                'ascription' 	=> $orderGoods['guishu'],
                'goodsmoney'    => $orderMoney,
                'commission'    => $commission,
                'createtime'    => date('Y-m-d H:i:s', $order['createtime']),
            );
            flock($fp,LOCK_UN);
        	fclose($fp);
            show_json(1, $return);
        }

        return $result;
    }

    /**
     * [initializationCountDown 初始化倒计时]
     * @return [type] [description]
     */
    public function initializationCountDown()
    {
    	global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $hasCountDown = pdo_fetch(' select * from ' . tablename('wx_shop_sd_count_down') . ' where uniacid = :unaicid and uid = :uid and status = 0 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        if(!empty($hasCountDown)){
        	pdo_update('wx_shop_sd_count_down', array('status' => 1), array('uniacid' => $uniacid, 'id' => $hasCountDown['id']));
        }
        show_json(1);
    }

    /**
     * [subOrder 提交订单]
     * @return [type] [description]
     */
    public function subOrder()
    {
    	global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $orderid = intval($_GPC['orderid']);

        $order = pdo_fetch(' select * from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $orderid));
        if(empty($order)){
        	show_json(0, '订单不存在或已完成');
        }

        $address = pdo_fetch(' select id from ' . tablename('wx_shop_member_address') . ' where uniacid = :uniacid and openid = :openid ', array(':uniacid' => $uniacid, ':openid' => $this->member['openid']));
        if(empty($address)){
        	show_json(2, '还未填写收货地址');
        }

        if($order['price'] > $this->member['credit2']){
        	show_json(0, '余额不足');
        }

        if($order['freeze'] == 1){
        	show_json(0, '订单已冻结');
        }

        if($order['status'] != 1 ){
        	show_json(0, '订单已提交或已完成');
        }

        if($order['deleted'] == 1){
        	show_json(0, '订单已删除');
        }

        $fp = fopen("../data/subOrder/".$this->member['id'].".txt", "w+");
        if(flock($fp,LOCK_EX | LOCK_NB)){
        	/*$sd_model = m('sd_model');
        	$result = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', -$order['price'], 1, $order['id'], 1);
        	if(!$result){
        		flock($fp,LOCK_UN);
        		fclose($fp);
        		show_json(0, '扣款失败');
        	}
        	pdo_update('wx_shop_sd_order', array(
        		'status' 		=> 1, 
        		'paytype' 		=> 1, 
        		'paytime' 		=> time(),
        		'addressid' 	=> $address['id']
        	), array('id' => $order['id']));*/

            $sd_model = m('sd_model');
        	$result1 = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', $order['price'], 1, $order['id'], 11);//抢单本金退还
        	$result2 = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', $order['commission'], 1, $order['id'], 4);//返佣
        	if($result1 && $result2){
        		pdo_update('wx_shop_sd_order', array(
	        		'status' 		=> 2,
	        		'finishtime' 	=> time(),
	        	), array(
	        		'id' 			=> $order['id'],
	        	));

	        	flock($fp,LOCK_UN);
        		fclose($fp);
        		show_json(1, '订单完成');
        	}else{
        		flock($fp,LOCK_UN);
        		fclose($fp);
        		show_json(0, '订单错误，返佣失败');
        	}
        }
    }

    /**
     * [thaw 解冻订单]（已修改自动解冻）废弃
     * @return [type] [description]
     */
    public function thaw()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $freeze_time = $_W['shopset']['grabsingle']['freeze_time'];
        $orderid = intval($_GPC['id']);
        $order = pdo_fetch(' select id, price, createtime from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and freeze = 1 and id = :id and uid = :uid ', array(':uniacid' => $uniacid, ':id' => $orderid, ':uid' => $this->member['id']));
        if(empty($order)){
            show_json(0, '该订单已解冻或以删除');
        }
        if(time() < ($order['createtime'] + $freeze_time * 60)){
            show_json(0, '解冻时间还未到，冻结时间：' . $freeze_time . '分钟');
        }

        $fp = fopen("../data/subOrder/".$this->member['id'].".txt", "w+");
        if(flock($fp,LOCK_EX | LOCK_NB)){
            $sd_model = m('sd_model');
            $result1 = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', $order['price'], 1, $order['id'], 61);//订单解冻
            if($result1){
                flock($fp,LOCK_UN);
                fclose($fp);
                show_json(1, '已解冻');
            }else{
                flock($fp,LOCK_UN);
                fclose($fp);
                show_json(0, '系统繁忙');
            }
        }else{
            show_json(0, '点击太快，请稍安勿躁');
        }
    }
}