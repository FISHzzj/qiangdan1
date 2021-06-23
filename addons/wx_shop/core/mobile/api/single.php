<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}

class Single_WxShopPage extends MobilePage
{   
    protected $member;
    public function __construct() 
	{
		global $_W;
		global $_GPC;
        parent::__construct();
        // $openid = m('account')->checkOpenid();
        $openid = trim($_GPC['openid']);
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

    public function main(){   //抢单
        global $_W;
        global $_GPC;
        $redis = redis();
        $openid  = trim($_GPC['openid']);
        $ile  = trim($_GPC['ile'])?trim($_GPC['ile']):true;
        if($ile  == false){
            show_json(0,'停止抢单');
        }

        $key = 'xz'.$openid;
        if(empty($redis->get($key))){

            $setex = $redis -> setex($key,2,1);

        }else if(!empty($redis->get($key))){

            show_json(0,'请勿快速点击');

        }

        $credit = m('member')->getCredit($openid, 'credit2');
        // $add_limit = m('member')->getCredit($openid, 'add_limit');
        if($credit == 0){
            show_json(0,'余额不足，请充值！');
        }
        $set = $_W['shopset']['grabsingle'];
        //把用户的余额修改进额度
        $ordercredit = $credit*$set['ordercredit'];
        pdo_update('wx_shop_member',['quota'=>$ordercredit],['uniacid'=>$_W['uniacid'],'openid'=>$openid]);
        $time_start = strtotime(date("Y-m-d".$set['start_time']),time()); //开始时间
        $time_end = strtotime(date("Y-m-d".$set['end_time']),time());//结束时间
        // $limit = $set['limit']+$add_limit;//限制单数
        $limit = $set['limit'];//限制单数
        $today_start = strtotime(date("Y-m-d"),time());
        $today_end = strtotime(date("Y-m-d 23:59:59"),time());

        $order = pdo_fetchcolumn('select count(*) from '.tablename('wx_shop_order'). 'where status > 0 and openid = :openid and uniacid = :uniacid and createtime >='.$today_start.' and createtime <='.$today_end,array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));

        $order1 =pdo_fetchcolumn('select count(*) from '.tablename('wx_shop_order'). 'where status =1 and openid = :openid and uniacid = :uniacid',array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));
        
        $refund = pdo_fetchall('select id,price,createtime,openid from '. tablename('wx_shop_order').' where freeze = 1 and openid = :openid and uniacid = :uniacid and refund = 0 ',array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));
       
        // if($refund){

        //     show_json(0,'你有冻结的订单未处理。');

        // }
    
        if($credit<$set['credit2']){
            show_json(0,'余额不可低于'.$set['credit2'].'元');
        }
        if($order1 > 0){
            show_json(0,'请提交待处理的提交再开始抢单');
        }

        if($order >= $limit){
            show_json(0,'你今天已经订单超过'.$limit.'单请明天在来');
        }

        if($time_start >= time()){
            show_json(0,'抢单时间是在'.$set['start_time'].'-'.$set['end_time'].'之间');
        }

        if(time() >= $time_end){
            show_json(0,'抢单时间是在'.$set['start_time'].'-'.$set['end_time'].'之间');
        }


        // $gltype = rand(1,10);

        // if($gltype<=6){
        $ts = pdo_fetch('SELECT tips FROM'.tablename('7033_set3').'WHERE uniacid=:uniacid order by rand() limit 1',[':uniacid'=>$_W['uniacid']]);
        //     // var_dump($ts);die;
        //     show_json(911,['ts'=>$ts['tips'],'djs'=>$_W['shopset']['grabsingle']['await_time']]);
        // }

        // $credit_start = $set['random_start']*$credit/100;//商品最低金额
        // $credit_end = $set['random_end']*$credit/100;//商品最高金额

        // $goodprice = array();
        // $goods = pdo_fetchall('select id as goodsid,marketprice,merchid,cates,type,intervalfloor,thumb,title,money,total from '.tablename('wx_shop_goods').' where status = 1 and deleted = 0 and total > 0 and marketprice >='. $credit_start.' and marketprice <='.$credit_end.' and uniacid ='.$_W['uniacid']);
       	//统计用户买过多少商品
        $countorder =pdo_fetchcolumn('select count(*) from '.tablename('wx_shop_order'). 'where status = 3 and openid = :openid and uniacid = :uniacid',array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));

        if($countorder<$set['chongfu'] && $countorder){
            //统计后台添加了多少商品
            $countgoods = pdo_fetchcolumn('SELECT count(id) FROM'.tablename('wx_shop_goods').'WHERE uniacid=:uniacid AND status=1 ',[':uniacid'=>$_W['uniacid']]);

            //查询用户购买商品的id
            $goodsid = pdo_fetchall('SELECT g.goodsid FROM'.tablename('wx_shop_order').' o left join '.tablename('wx_shop_order_goods').' g on o.id=g.orderid '. ' WHERE o.uniacid=:uniacid AND o.openid=:openid AND o.status = 3 ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);
            $gid = [];
            foreach ($goodsid as $k => $va) {
                if($va['goodsid']!=0){

                    $gid[] = $va['goodsid'];

                }

            }
            $gid = implode(',',$gid);

            $goods = pdo_fetchall('SELECT id FROM'.tablename('wx_shop_goods')." WHERE status=1 AND id not in (".$gid.") ");
           
            if($countgoods< $set['chongfu'] && !$goods){

                $goods = pdo_fetchall('SELECT id FROM'.tablename('wx_shop_goods').'WHERE uniacid=:uniacid AND status=1 ',[':uniacid'=>$_W['uniacid']]);

            }

        }else if(!$countorder || $countorder>=$set['chongfu']){
            $goods = pdo_fetchall('SELECT id FROM'.tablename('wx_shop_goods').'WHERE uniacid=:uniacid AND status=1 ',[':uniacid'=>$_W['uniacid']]);
        }

       

	   // $listid = $redis->lRange('goodsid_5812',0,-1);
        // foreach($listid as $key=>$val){
        //     if($redis->get('goods_'.$val) >= $credit_start and $redis->get('goods_'.$val) <= $credit_end){
        //         $goodprice[$key] = $val;
        //     }
        // }

        if($goods){
            $goodsid = $goods[array_rand($goods,1)];
  
          
            $goods = $this->createorder($goodsid,$openid,$set);
       
            if($this->member['is_single'] == 0){
                pdo_update('wx_shop_member',array('is_single '=>1),array('openid'=>$openid));
            }
            show_json(1,array('order'=>$goods));
        }else{
            show_json(2,'抢单失败');
        }
    }

    //扣开户保证金
    // public function account(){
    //     global $_W;
    //     global $_GPC;
    //     $openid = $_GPC['openid'];
    //     $set = $_W['shopset']['grabsingle'];

    //     $member = pdo_fetch('SELECT id,credit2,agentid,khtype FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

    //     if($member['credit2']<$set['account']){

    //         show_json(0,'你的余额不够交'.$set['account'].'的保证金');
    //     }

    //     if($member['credit2']>$set['account']){
    //         pdo_update('wx_shop_member',['khtype'=>1],['uniacid'=>$_W['uniacid'],'id'=>$member['id']]);

    //         if($member['agentid'] && $member['khtype'] == 0){

    //             $myagent = pdo_fetch('SELECT id,openid,credit2 FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND id=:id ',[':uniacid'=>$_W['uniacid'],':id'=>$member['agentid']]);

    //             $account = $set['account']-$set['ztbzj'];
    //             // var_dump($account);die;
    //             pdo_update('wx_shop_member',['credit2'=>$myagent['credit2']+$set['ztbzj']],['uniacid'=>$_W['uniacid'],'openid'=>$myagent['openid']]);

    //             //记录
    //             $this->credit2_log($myagent['openid'],$set['ztbzj'],['title'=>'直推开户奖励','rechargetype'=>'ztkhjl'],0);

    //             pdo_insert('7033_yjjiedong',['uniacid'=>$_W['uniacid'],'uid'=>$member['id'],'money'=>$account ,'status'=>'0','type'=>'3','tjtime'=>time()]);

    //             pdo_update('wx_shop_member',['credit2'=>$member['credit2']-$set['account'],'account'=>$account ],['uniacid'=>$_W['uniacid'],'openid'=>$openid]);
    //         }

    //         if($member['khtype'] == 1){

    //             pdo_update('wx_shop_member',['credit2'=>$member['credit2']-$set['account'],'account'=>$set['account'] ],['uniacid'=>$_W['uniacid'],'openid'=>$openid]);
    //             pdo_insert('7033_yjjiedong',['uniacid'=>$_W['uniacid'],'uid'=>$member['id'],'money'=>$set['account'] ,'status'=>'0','type'=>'3','tjtime'=>time()]);
    //         }

    //         //记录
    //         $this->credit2_log($openid,-$set['account'],['title'=>'开户保证金','rechargetype'=>'khbzj'],0);

    //         show_json(1,'扣除'.$set['account'].'保证金成功');
    //     }

    // }

    public function single()
    {  //抢单首页
        global $_W;
        global $_GPC;
        $openid  = trim($_GPC['openid']);
        $data = array();
        $todaystart =strtotime(date('Y-m-d')); //今天开始
        $todayend =strtotime(date('Y-m-d 23:59:59')); //今天结束
        $member = p('commission')->getInfo($openid, array('ok','pay'));
       
        $data = pdo_fetch('select count(*) as single ,IFNULL(SUM(balance),0) as balance from '.tablename('wx_shop_order').' where openid = :openid and createtime between '.$todaystart.' and '.$todayend.'',array(':openid'=>$openid));
        $data['freeze'] = pdo_fetchcolumn('select COALESCE(sum(price),0.00) from '.tablename('wx_shop_order').' where openid = :openid and freeze = 1',array(':openid'=>$openid));

        $data['dongjie'] = pdo_fetchcolumn('select count(1) from '.tablename('wx_shop_order').' where openid = :openid and freeze = 1',array(':openid'=>$openid));

        $data['commission'] = $member['commission_ok']+$member['commission_pay'];

        $data['sumteam'] = pdo_fetchcolumn('SELECT sum(money) FROM'.tablename('wx_shop_member_log').'WHERE uniacid=:uniacid AND openid=:openid AND genre=1 ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

        $data['jrsumteam'] = pdo_fetchcolumn('SELECT sum(money) FROM '.tablename('wx_shop_member_log').' where openid = :openid AND genre=1 AND createtime between '.$todaystart.' and '.$todayend.'',array(':openid'=>$openid));

        $data['credit2'] = m('member')->getCredit($openid, 'credit2');

        $set = m('common')->getSysset('grabsingle');
        $credit2 = pdo_fetch('SELECT credit2 FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

        $data['credit2'] = $credit2['credit2'];
        $data['qdbzsm'] = $set['qdbzsm'];
        $await_time1 = $_W['shopset']['grabsingle']['await_time'];
        $await_time2 = $_W['shopset']['grabsingle']['await_times2'];

        $ts = pdo_fetchall('SELECT tips FROM'.tablename('7033_set3').'WHERE uniacid=:uniacid ',[':uniacid'=>$_W['uniacid']]);
        // var_dump($ts);die;
        $awaittime = range($await_time1,$await_time2);

        $await_time = $this->randtime($awaittime);

        $qdtime = array_rand($await_time);

        $qiangtime = $await_time[$qdtime];

        $data['await_time'] = $qiangtime;

        $data['qdts'] = $ts;

        show_json(1,$data);
    }

    function randomFloat($min = 0, $max = 10)
    {
        $num = $min + mt_rand() / mt_getrandmax() * ($max - $min);
        return sprintf("%.2f", $num);
 
    }

    public function randtime($num1){
        global $_W;
        global $_GPC;

        $length = count($num1);
            $arr = [];
        for($i=0;$i<$length;$i++){
            if($num1[$i]%5==0){
                $arr[] = $num1[$i];//这是输出的都是5的倍数
            }
        }
        return $arr;
    }
    //返佣
    public function fanyongset($member){
        global $_W;
        global $_GPC;
        // $member['credit2'] = 110000 ;
        $level = pdo_fetchall('SELECT * FROM'.tablename('7033_fanyong').' WHERE uniacid=:uniacid  AND enabled = 1 ',[':uniacid'=>$_W['uniacid']]);
        // var_dump($level);die;
        $bili = 0;
        foreach ($level as $l => $v) {
            if($member['credit2']>=$v['minquota'] && $member['credit2']<=$v['maxquota']){

                pdo_update('wx_shop_member',['level'=>$v['level']],['uniacid'=>$_W['uniacid'],'id'=>$member['id']]);
                $bili = $v['discount'];

           }

        }

        return $bili;

    }

    public function createorder($goods = '',$openid,$set){   //生成订单
        global $_W;
        global $_GPC;
        // $openid = $_GPC['openid'];
        $goods = pdo_fetch('select id as goodsid,marketprice,merchid,cates,type,intervalfloor,thumb,money,title from '.tablename('wx_shop_goods').' where id = :id',array(':id'=>$goods['id']));

        $member = pdo_fetch('SELECT id,level,credit2 FROM'.tablename('wx_shop_member').' WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);
        // var_dump($member);die;
        $credit_start = $set['random_start']*$member['credit2']/100;//商品最低金额
        $credit_end = $set['random_end']*$member['credit2']/100;//商品最高金额
        $credit = $this->randomFloat($credit_start,$credit_end);

        if($goods){
            $openid  = trim($_GPC['openid']);
            $uniacid = $_W['uniacid'];
            // $result = m('member')->setCredit($openid, 'credit2', -$goods['marketprice'], array(0,$_W['shopset']['shop']['name'] . '消费' . $goods['marketprice']));
            if(pdo_update('wx_shop_member',array('credit2 -='=>$credit),array('openid'=>$openid))){
                //  //充值记录
                // $this->credit2_log($openid,-$credit,['title'=>'抢单扣除','rechargetype'=>'qdkc'],1);

                pdo_update('wx_shop_goods',array('sales +='=>1,'total -='=>1),array('id'=>$goods['goodsid']));
                $ordersn = m('common')->createNO('order', 'ordersn', 'SH');
                $data['uniacid'] = $uniacid;
                $data['openid'] = $openid;
                $data['agentid'] = 0;
                $data['ordersn'] = $ordersn;
                $data['price'] =  $credit;
                $data['goodsprice'] =  $credit;
                $data['discountprice'] =  '0.00';
                $data['status'] = 1;
                $data['paytype'] = 1;
                $data['addressid'] = 0;
                $data['createtime'] = time();
                $data['paytime'] = time();
                $data['oldprice'] = $credit;
                $data['grprice'] = $credit;
                $data['transid'] = '';
                $data['coupongoodprice'] = '0.00';

                // if (strexists($goods['money'], '%')) 
                // {
                //     $data['balance'] = round((floatval(str_replace('%', '', $goods['money'])) / 100) * $credit, 2);
                // }
                // else 
                // {
                //     $data['balance'] = round($goods['money'], 2);
                // }

                $bili = $this->fanyongset($member);
                // var_dump($bili);die;
                // var_dump($bili);die;
                //返佣金额
                // $data['balance'] = $credit * ($set['fanyong']/100);
                $data['balance'] = $credit * ($bili/100);
  
                pdo_insert('wx_shop_order', $data);
                $orderid = pdo_insertid();
                $goods['orderid'] = $orderid;
                $goods['money'] = $data['balance'];
                if($orderid){
                    $data1['uniacid'] = $uniacid;
                    $data1['orderid'] = $orderid;
                    $data1['goodsid'] = $goods['goodsid'];
                    $data1['price'] =   $credit;
                    $data1['total'] = 1;
                    $data1['optionid'] = 0;
                    $data1['createtime'] = time();
                    $data1['realprice'] =  $credit;
                    $data1['oldprice'] = $credit;
                    $data1['openid'] = $openid;
                    pdo_insert('wx_shop_order_goods', $data1);
                    // p('commission')->checkOrderConfirm($orderid);
                    pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$openid,'orderid'=>$orderid,'money'=>-$credit,'type'=>1,'createtime'=>time()));
                    $data = 
                    [
                        'uniacid'=>$_W['uniacid'],
                        'openid' =>$openid,
                        'orderid'=>$orderid,
                        'goodsid'=>$goods['goodsid'],
                        'money'  =>$data['balance'],
                        'issue'  =>0,
                        'status' =>1,
                        'createtime'=>time(),

                    ];
                    pdo_insert('wx_shop_member_commission',$data);
                    return $goods;
                }


            }
        }
    }

    public function address(){  //获取默认地址
        global $_W;
        global $_GPC;

        $openid  = trim($_GPC['openid']);
        $id  = intval($_GPC['id']);
        // if($id){
        //     $address = pdo_fetch('select province,city,area,address,mobile,realname,id from '.tablename('wx_shop_member_address').' where openid = :openid and id = :id',array(':openid'=>$openid,':id'=>$id));
        // }else{
            $address = pdo_fetch('select province,city,area,address,mobile,realname,id from '.tablename('wx_shop_member_address').' where openid = :openid ',array(':openid'=>$openid));


        // }
       
        if(!$address){
            show_json(0,'地址不存在');
        }else{
            show_json(1,array('address'=>$address));
        }

    }

    public function submit(){  //提交订单
        global $_W;
        global $_GPC;
        global $_S;

        $openid  = trim($_GPC['openid']);
        $uniacid = $_W['uniacid'];
        $set = $_W['shopset']['grabsingle'];
        $addressid = intval($_GPC['addressid']);

        $orderid = intval($_GPC['orderid']);
        $commission = $_S['commission'];
        $redis = redis();
        $key = 'tj'.$openid;
        if(empty($redis->get($key))){

            $setex = $redis -> setex($key,2,1);

        }else if(!empty($redis->get($key))){

            show_json(0,'请勿快速点击');

        }

        if ($addressid) 
		{
			$address = pdo_fetch('select * from ' . tablename('wx_shop_member_address') . ' where id=:id and openid=:openid and uniacid=:uniacid   limit 1', array(':uniacid' => $uniacid, ':openid' => $openid, ':id' => $addressid));

            // var_dump($uniacid);die;
			if (empty($address)) 
			{
				show_json(0, '未找到地址');
			}
			// else 
			// {
			// 	if (empty($address['province']) || empty($address['city'])) 
			// 	{
			// 		show_json(0, '地址请选择省市信息');
			// 	}
			// }
        }else{
            show_json(901, '请填写地址');
        }

        $order = pdo_fetch('select id,is_submit,createtime,status,price,balance,freeze from '. tablename('wx_shop_order') .'where id = :id',array(':id'=>$orderid));
        if(!$order){
            show_json(0, '订单不存在');
        }
        if($order['is_submit'] == 1){
            show_json(0, '订单已经提交过了请不要重复提交');
        }
        if($order['freeze'] == 1){
            show_json(0, '订单已经冻结了');
        }
    
        if($order['createtime']+$set['freeze_time1'] < time()){
            pdo_update('wx_shop_order',array('freeze'=>1,'status'=>3,'canceltime'=>time()),array('id'=> $orderid,'openid'=>$openid,'uniacid'=>$uniacid));
            pdo_update('wx_shop_member_commission',array('status'=>1,'finishtime'=>time()),array('orderid'=> $orderid,'uniacid'=>$uniacid));

            $this->credit2_log($openid,$order['balance']+$order['price'],['title'=>'订单冻结','rechargetype'=>'dddj'],1);
            // m('order')->setGiveBalance($orderid, 1);
            show_json(0, '提交订单因超过'.$set['freeze_time1'].'秒被冻结，余额将在48小时之后返回');
        }

        $order['addressid'] = $addressid;
        $order['address'] = iserializer($address);
        $order['is_submit'] = 1;
        $order['status'] = 3;
        $order['issue'] = 1;
        if( pdo_update('wx_shop_order',$order,array('id'=> $orderid))){

            m('member')->setCredit($openid,'credit2', $order['price'], array($_W['uid'], '提交订单'));
            
            if(pdo_update('wx_shop_member',array('credit2 +='=>$order['balance']),array('openid'=>$openid))){
                // //充值记录
                // $this->credit2_log($openid,$order['price'],['title'=>'抢单返还','rechargetype'=>'qdff'],1);
                //  //充值记录
                $this->credit2_log($openid,$order['balance'],['title'=>'抢单成功,返佣金','rechargetype'=>'qdyj'],1);

                pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$openid,'orderid'=>$orderid,'money'=>$order['price']+$order['balance'],'type'=>2,'createtime'=>time()));

                // pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$openid,'orderid'=>$orderid,'money'=>$order['balance'],'type'=>3,'createtime'=>time()));
            }
            pdo_update('wx_shop_member_commission',array('status'=>1,'finishtime'=>time(),'issue'=>1,'issuetime'=>time()),array('orderid'=> $orderid,'uniacid'=>$uniacid));

            $myuser = pdo_fetch('SELECT id,agentid FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);
            //查上级
            $myagent = $this->getmyagent($myuser['agentid']);
            $level = 0;
            foreach ($myagent as $ke => $val) {
                if($val['i']==1){
                    $yongjin = $order['balance'] * ($commission['commission1']/100);

                    $level = $val['i'];
                }else if($val['i']==2){

                    $yongjin = $order['balance'] * ($commission['commission2']/100);
                    $level = $val['i'];
                }else if($val['i']==3){

                    $yongjin = $order['balance'] * ($commission['commission3']/100);
                    $level = $val['i'];
                }

                m('member')->setCredit($val['openid'], 'credit2', $yongjin, array(0,$_W['shopset']['shop']['name'] . '下级抢单奖励' . $yongjin));
                //充值记录
                $this->credit2_log($val['openid'],$yongjin,['title'=>'下级抢单奖励','rechargetype'=>'yongjin'],1,$level);
            }
                //查询所有代理
                $daili = pdo_fetchall('SELECT id,openid,aagentprovinces,aagentcitys FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND aagentstatus=1 ',['uniacid'=>$_W['uniacid']]);

                $set = $_W['shopset']['abonus'];

                foreach ($daili as $k => $v) {
                    //省代理
                    $aagentprovinces = unserialize($v['aagentprovinces']);
                    //市代理
                    $aagentcitys = unserialize($v['aagentcitys']);

                    //省代理比例
                    $bonus1 = $set['bonus1'];
                    //市区代理比例
                    $bonus2 = $set['bonus2'];
                    
                    if($aagentprovinces['0']==$address['province']){
                         //省代理佣金
                        $sheng = $yongjin*($bonus1/100);
                      
                        m('member')->setCredit($v['openid'], 'credit2', $sheng, array(0,$_W['shopset']['shop']['name'] . '省代理佣金' . $sheng));
                        //充值记录
                        $this->credit2_log($v['openid'],$sheng,['title'=>'省代理佣金','rechargetype'=>'sheng'],1,$level);

                        
                    }
                    if($aagentcitys['0']==$address['city']){

                        //市代理佣金
                        $shi = $yongjin*($bonus2/100);

                        m('member')->setCredit($v['openid'], 'credit2', $shi, array(0,$_W['shopset']['shop']['name'] . '市代理佣金' . $shi));
                        //充值记录
                        $this->credit2_log($v['openid'],$shi,['title'=>'市代理佣金','rechargetype'=>'shi'],1,$level);

                    }

                }
                $qdtime = date('Ymd',time());
                $sumtorder = pdo_fetchcolumn('SELECT sum(goodsprice) FROM'.tablename('wx_shop_order')."WHERE uniacid=:uniacid AND openid=:openid AND status=3 AND issue= 1 AND DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y%m%d') =:createtime",['uniacid'=>$_W['uniacid'],':openid'=>$openid,':createtime'=>$qdtime]);

                $data = m('common')->getSysset('grabsingle');
                //后台设置满足多少钱
                $sumorder = $data['sumorder'];
                //后台设置奖励数量
                $jlmoney = $data['jlmoney'];
                // var_dump($openid);die;
                if($sumtorder>=$sumorder){
                    // var_dump($jlmoney);die;
                    m('member')->setCredit($openid, 'credit2', $jlmoney, array(0,$_W['shopset']['shop']['name'] . '满足抢单金额奖励' . $jlmoney));
                    //充值记录
                    $this->credit2_log($openid,$jlmoney,['title'=>'满足抢单金额奖励','rechargetype'=>'jlmoney'],1,$level);

                }


            
            show_json(1,'下单成功');
         }
    }

     //查找上级方法 2019.3.5
    public function getmyagent($id = 0,&$arr,$i = 0,$ceng = 3 ){
        if($ceng == 0){

            return false;
        }
        $i++;

        if($i == $ceng){

            return false;


        }

        $meminfo = pdo_fetch('SELECT id,agentid,openid FROM ' . tablename('wx_shop_member') . ' where id = :id ',array(':id'=>$id));

        $meminfo['i'] = $i;

        if($meminfo['id']){

            $arr[] = $meminfo;
            $this->getmyagent($meminfo['agentid'],$arr,$i,$ceng);
        }

            return $arr;

    }

    public function credit2_log($openid,$num,$arr=[],$genre,$level){
        global $_W;
        $ordersn = m('common')->createNO('order', 'ordersn', 'RC');

        $data= 
        [
            'uniacid'=>$_W['uniacid'],
            'openid' =>$openid,
            'type' => 0,
            'logno'=>$ordersn,
            'title'=>$arr['title'],
            'createtime'=>time(),
            'status'=>1,
            'money'=>$num,
            'rechargetype'=>$arr['rechargetype'],
            'genre'=>$genre,
            'level'=>$level,

        ];

        pdo_insert('wx_shop_member_log',$data);

    }

    public function get_list(){  //收单
        global $_W;
        global $_GPC;
        $openid  = trim($_GPC['openid']);
        $uniacid = $_W['uniacid'];
        $type = intval($_GPC['type']);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $createtime = date('Ymd',time()- (3 * 3600 * 24));
		$condition .= ' and openid=:openid and uniacid=:uniacid';
        $params = array(':uniacid' => $uniacid, ':openid' => $openid);
        
        if($type == 1){
            $condition .= ' and status=1 and is_submit=0 ';
        }elseif($type == 2){
            $condition .= ' and freeze = 1 and refund = 0';
        }elseif($type == 3){
            $condition .= " and status = 3 and freeze = 0 AND DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y%m%d') >= :createtime ";
            $params[':createtime'] .= $createtime ;

        }
        
        // var_dump($createtime);die;
        $list = pdo_fetchall('select id,ordersn,price,createtime,balance,refund from '.tablename('wx_shop_order').' where 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize,$params);
        $total = pdo_fetchcolumn('select id from '.tablename('wx_shop_order').' where 1'.$condition,$params);

        foreach($list as $key=> $val){
            $list[$key]['balance'] = $val['balance'];
            $list[$key]['createtime'] = date('Y-m-d H:i:s',$val['createtime']);

            if($val['refund']==1){

                $list[$key]['balance'] = $val['price'].'(解冻)';

                $$list[$key]['jied'] = 1;
            }
            if($type == 1){
                $list[$key]['type'] = 1;
                $list[$key]['endtime'] =  $_W['shopset']['grabsingle']['freeze_time1']+$val['createtime'];//到期时间
            }
            if($type == 2){
                $list[$key]['type'] = 2;
                $list[$key]['endtime'] =  ($_W['shopset']['grabsingle']['freeze_time']*60)+$val['createtime'];//解冻时间
            }
            if($type == 3){
                $list[$key]['type'] = 3;
            }
        }
        show_json(1, array('list' => $list, 'total' => $total, 'pagesize' => $psize));
    }

    public function detail(){   //提交订单 详细页
        global $_W;
        global $_GPC;

        $openid  = trim($_GPC['openid']);
        $uniacid = $_W['uniacid'];
        $orderid = intval($_GPC['orderid']);

        $data = pdo_fetch('select o.id,o.ordersn,o.price,og.total,o.is_submit,o.freeze,o.status,o.balance,g.thumb,g.title,og.commission1,og.commission2,og.commission3,g.money,g.guishu from '.tablename('wx_shop_order').' o left join '.tablename('wx_shop_order_goods').' og on o.id = og.orderid left join '.tablename('wx_shop_goods').' g on og.goodsid = g.id where o.id = :id and o.openid = :openid and o.uniacid = :uniacid',array(':id'=>$orderid,':openid'=>$openid,':uniacid'=>$uniacid));
        if($data){
            $data['credit'] = m('member')->getCredit($openid, 'credit2');
            $data['thumb'] = tomedia($data['thumb']);
            $data['commission'] = unserialize($data['commission1'])['default']+unserialize($data['commission2'])['default']+unserialize($data['commission3'])['default'];
			$data['money'] = $data['balance'];
			if($data['freeze']==1){
				$data['type'] = 2;
			}
			
			if($data['status']==1){
				$data['type'] = 1;
			}	
			
			if($data['status']==3 and $data['freeze'] == 0){
				$data['type'] = 3;
			}
			
            unset($data['commission1']);
            unset($data['commission2']);
            unset($data['commission3']);

        }else{
            show_json(0, '订单不存在');
        }

        show_json(1,array('data'=>$data));
    }

    public function single_validation(){  //抢单验证
        global $_W;
        global $_GPC;



        $openid  = trim($_GPC['openid']);
        $ile  = trim($_GPC['ile'])?trim($_GPC['ile']):true;
        if($ile  == false){
            show_json(0,'停止抢单');
        }
        $set = $_W['shopset']['grabsingle'];

        $credit = m('member')->getCredit($openid, 'credit2');

        // var_dump($credit);die;
        // $add_limit = m('member')->getCredit($openid, 'add_limit');
        if($credit < $set['qd_money']){
            show_json(0,'余额必须满足'.$set['qd_money'].'才能抢单');
        }
        $time_start = strtotime(date("Y-m-d".$set['start_time']),time()); //开始时间
        $time_end = strtotime(date("Y-m-d".$set['end_time']),time());//结束时间
        // $limit = $set['limit']+$add_limit;//限制单数
        // $limit = $set['ordersum'];
        $limit = $set['limit'];
        $today_start = strtotime(date("Y-m-d"),time());
        $today_end = strtotime(date("Y-m-d 23:59:59"),time());

        $order = pdo_fetchcolumn('select count(*) from '.tablename('wx_shop_order'). 'where status > 0 and openid = :openid and uniacid = :uniacid and createtime >='.$today_start.' and createtime <='.$today_end,array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));

        $order1 =pdo_fetchcolumn('select count(*) from '.tablename('wx_shop_order'). 'where status =1  and openid = :openid and uniacid = :uniacid',array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));

        $refund = pdo_fetchall('select id,price,createtime,openid from '. tablename('wx_shop_order').' where freeze = 1 and openid = :openid and uniacid = :uniacid and refund = 0 ',array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));
        // $address = pdo_fetch('SELECT id FROM '.tablename('wx_shop_member_address').' WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

        $address = pdo_fetch('SELECT id FROM '.tablename('wx_shop_member_address').' WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

        if(!$address){

            show_json(910,'请先填写地址');
        }

        // if(!$address){

        //     show_json(10,'请先填写地址');

        // }
      
        // if($refund){

        //     show_json(0,'你有订单被冻结，暂时还不能抢单');

        // }

        if($order1 > 0){
            show_json(0,'请提交待处理的提交再开始抢单');
        }

        if($order >= $limit){
            show_json(0,'你今天已经订单超过'.$limit.'单请明天在来');
        }

        if($time_start >= time()){
            show_json(0,'抢单时间是在'.$set['start_time'].'-'.$set['end_time'].'之间');
        }

        if(time() >= $time_end){
            show_json(0,'抢单时间是在'.$set['start_time'].'-'.$set['end_time'].'之间');
        }



        show_json(1);
    }

}