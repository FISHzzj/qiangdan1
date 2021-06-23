<?php

header('Access-Control-Allow-Origin:*'); 

if (!(defined('IN_IA'))) 

{

	exit('Access Denied');

}



class Com_WxShopPage extends MobilePage

{   

    public function index(){

		global $_W;

        global $_GPC;

		$list = pdo_fetchall('select thumb,link,advname from ' . tablename('wx_shop_adv') . ' where enabled = 1 and uniacid=:uniacid order by displayorder asc ', array(':uniacid' => $_W['uniacid']));

        foreach ($list as $key => $val) {
           $list[$key]['thumb'] = tomedia($val['thumb']);
        }
        $type = $_GPC['type'];
		// $content = $_W['shopset']['grabsingle']['content'.$i];

        show_json(1,array('banner'=>$list,'content'=>$_W['shopset']['grabsingle']['content'.$type]));

	}

    public function rolllog(){
        global $_W;
        global $_GPC;

        $log = pdo_fetchall('SELECT l.id,l.money,l.createtime,m.nickname FROM'.tablename('wx_shop_member_credit_log').' l left join '.tablename('wx_shop_member').' m on l.openid = m.openid WHERE l.uniacid=:uniacid AND l.type = :type order by l.id DESC limit 50',[':uniacid'=>$_W['uniacid'],':type'=> '2' ]);
        foreach ($log as $key => &$value) {
            
            $value['createtime'] = date('m-d H:i',$value['createtime']);

        }
        show_json(1,['log'=>$log]);

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


    public function refunds(){ //处理冻结订单

        global $_W;
        global $_GPC;
        $orderid  = intval($_GPC['orderid']);

        if(empty($orderid)){
            show_json(0, '订单不存在');
        }
        $uniacid = $_W['uniacid'];

        $set = $_W['shopset']['grabsingle'];

        $order = pdo_fetch('select id,price,canceltime,createtime,openid from '. tablename('wx_shop_order').' where freeze = 1 and id = :id and uniacid = :uniacid and refund = 0 ',array(':id'=>$orderid,':uniacid'=>$uniacid));
        // var_dump($orderid);exit;
        if($order){
            // foreach($order as $key=>$val){  

            //     if($val['createtime']+($set['freeze_time']*60) <= time() ){

            //         pdo_update('wx_shop_order',array('refund'=>1,'freeze'=>0,'refundtime'=>time()),array('id'=> $val['id']));

            //         m('member')->setCredit($val['openid'],'credit2', $val['price'], array($_W['uid'], '商品退款'));

            //         pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$val['openid'],'orderid'=>$val['id'],'money'=>$val['price'],'type'=>2,'createtime'=>time()));

                
            //     }

            // }
            if($order['canceltime']+($set['freeze_time']*60) <= time() ){
                pdo_update('wx_shop_order',array('refund'=>1,'freeze'=>0,'refundtime'=>time()),array('id'=> $order['id']));

                // m('member')->setCredit($order['openid'],'credit2', $order['price'], array($_W['uid'], '商品退款'));
           

                if(pdo_update('wx_shop_member',array('credit2 +='=>$order['price']),array('openid'=>$order['openid']))){

                    $this->credit2_log($order['openid'],$order['price'],['title'=>'订单解冻','rechargetype'=>'ddjd'],1);

                    pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$order['openid'],'orderid'=>$order['id'],'money'=>$order['price'],'type'=>2,'createtime'=>time()));
                }
                
            }

            show_json(1);
        }else{
            show_json(0,'暂无可以解冻的订单');
        }

    }



    public function freeze(){  //处理超时未提交订单

        global $_W;

        global $_GPC;

        $orderid  = intval($_GPC['orderid']);
        if(empty($orderid)){
            show_json(0, '订单不存在');
        }

        $freeze_time1 = $_W['shopset']['grabsingle']['freeze_time1'];

        $order = pdo_fetch('select id,openid,createtime,uniacid from '.tablename('wx_shop_order').' where status = 1 and is_submit = 0 and id = :id and freeze = 0',array(':id'=>$orderid));


        if($order){

            // foreach($order as $key => $val){

            //     if($val['createtime']+$freeze_time1 < time()){

            //         pdo_update('wx_shop_order',array('freeze'=>'1','status'=>3,'canceltime'=>time()),array('id'=> $val['id'],'openid'=>$val['openid'],'uniacid'=>$val['uniacid']));

            //         m('order')->setGiveBalance($val['id'], 1);

            //     }

            // }

            if($order['createtime']+$freeze_time1 < time()){
                pdo_update('wx_shop_order',array('freeze'=>'1','status'=>3,'canceltime'=>time()),array('id'=> $order['id']));
                pdo_update('wx_shop_member_commission',array('status'=>1,'finishtime'=>time()),array('orderid'=> $order['id']));
                m('order')->setGiveBalance($order['id'], 1);
            }
            show_json(1);

        }else{
            show_json(0,'暂无可以冻洁的订单');
        }

    }



    // public function commission_issue()  //发放佣金

    // {

    //     global $_W;

    //     // $orderid = pdo_fetchall('select openid,COALESCE(SUM(money),0) as num from '.tablename('wx_shop_member_commission'). ' where status = 1 and issue = 0 group by openid');
    //     // pdo_update('wx_shop_member_commission1',array('issue'=>1,'issuetime'=>time()));
    //     pdo_update('wx_shop_order',array('issue'=>1,'issuetime'=>time()),array('status'=>3,'issue'=>0,'uniacid'=>$_W['uniacid']));
    //     pdo_update('wx_shop_member_commission',array('issue'=>1,'issuetime'=>time()),array('status'=>1,'issue'=>0,'uniacid'=>$_W['uniacid']));
    //     // if(pdo_update('wx_shop_order',array('issue'=>1,'issuetime'=>time()),array('status'=>3,'issue'=>0,'uniacid'=>$_W['uniacid'])) and pdo_update('wx_shop_member_commission',array('issue'=>1,'issuetime'=>time()),array('status'=>1,'issue'=>0,'uniacid'=>$_W['uniacid']))){
    //     //     foreach($orderid as $key=>$val){
    //     //         m('member')->setCredit($val['openid'], 'credit_commission', $val['num'], array(0,$_W['shopset']['shop']['name'] . '佣金' . $val['num']));
                
    //     //     }
    //     // }
       

    // }

    // public function commission_issue1()  //发放佣金 修改版
    // {   
        
    //     $commission = pdo_fetchall('select openid,money,id from '.tablename('wx_shop_member_commission1').' where issue = 0 limit 50');
    //     if($commission){
    //         foreach($commission as $key=>$val){
    //             pdo_update('wx_shop_member',array('credit_commission +='=>$val['money']),array('openid'=>$val['openid']));
    //             pdo_update('wx_shop_member_commission1',array('issue'=>1,'issuetime'=>time()),array('id'=>$val['id']));
    //         }
    //     }

    // }

    public function topuptype() //充值类型
	{
		global $_W;
		global $_GPC;
		$type = intval($_GPC['type']);
		$set = $_W['shopset']['grabsingle'];
		if($type == 1){
			show_json(1,array('Payment'=>tomedia($set['alipay'])));
		}else if($type == 2){
			show_json(1,array('Payment'=>tomedia($set['wechat'])));
		}else{
			$data['realname'] = $set['realname'];
			$data['bankname'] = $set['bankname'];
			$data['branch'] = $set['branch'];
			$data['bankcard'] = $set['bankcard'];
			show_json(1,array($data));
		}

    }
    
    public function icode(){
        global $_W;
		global $_GPC;
        if($_GPC['mid']){
            $icode = pdo_fetchcolumn('select rcode from ' . tablename('wx_shop_member') . 'where id = :mid',array(':mid'=>$_GPC['mid']));
            show_json(1,array('icode'=>$icode));
		}else{
            show_json(0,'推荐码没找到');
        }
    }


    public function titles()
	{   //封号处理
        global $_W;
        global $_GPC;
        $uniacid = $_W['uniacid'];        
        $set = $_W['shopset']['grabsingle'];
        $ulist = pdo_fetchall('select id,createtime,openid from '.tablename('wx_shop_member').' where is_single = 0');
        $time = $set['titles_time']*24*60*60;
        foreach($ulist as $key=>$val){
            $val['end'] = $val['createtime']+$time;
            if($val['end'] < time()){
                $val['order'] = pdo_fetchcolumn('select count(*) from '.tablename('wx_shop_order').' where openid = :openid and uniacid = :uniacid and createtime <='.$val['end'],array(':openid'=>$val['openid'],'uniacid'=>$uniacid));
                if(empty($val['order'])){
                    pdo_update('wx_shop_member',array('isblack'=>1,'is_single'=>1),array('openid'=>$val['openid']));
                }
            }
        }
      
    }
    

    public function notice(){   //弹框公告
        global $_W;
        show_json(1,array('content'=>$_W['shopset']['grabsingle']['notice']));
    }

    public function rolling_notice(){ //滚动公告
        global $_W;
        $list = pdo_fetchall('select detail from '.tablename('wx_shop_notice').' where status = 1 order by displayorder asc');
        show_json(1,array('list'=>$list,'content'=>$_W['shopset']['grabsingle']['notice']));
    }
    // public function sqlcl(){
    //     global $_W;
    //     global $_GPC;

    //     // echo 123;
    //     // $member = pdo_fetchall('select openid from '.tablename('wx_shop_member'));
    //     // $moneys = array();
    //     // foreach($member as $key=>$val){
    //     //     $moneys[$key]['jj'] = pdo_fetchcolumn('select COALESCE(sum(money),0.00) from '.tablename('wx_shop_member_commission').' where openid = :openid and issue = 1',array(':openid'=>$val['openid']));
    //     //     $moneys[$key]['openid'] = $val['openid'];
    //     // }
    //     // $tx = pdo_fetchall('select money from '.tablename('wx_shop_member_log').'genre = 1 and status = 1');
    //     // foreach($moneys as $k=>$v){
    //     //     $moneys[$k]['tx'] = pdo_fetchcolumn('select COALESCE(sum(money),0.00) from '.tablename('wx_shop_member_log').' where genre = 1 and (status = 1 or status = 0) and openid = :openid',array(':openid'=>$v['openid']));
    //     //     $moneys[$k]['zz'] = $moneys[$k]['jj'] - $moneys[$k]['tx'];
    //     // }
    //     // foreach($moneys as $k=>$v){
    //     //     var_dump(pdo_update('wx_shop_member',array('credit_commission'=>$v['zz']),array('openid'=>$v['openid'])));
    //     // }

    //         // exit;

    //     // var_dump($moneys);
    //     // $list =  pdo_fetchall('select money from '.tablename('wx_shop_member_commission').' where issue = 1 GROUP BY openid');



    //     // var_dump($list);


    //     // $list = pdo_fetchall('select * from '.tablename('wx_shop_order').' where openid = :openid and balance > :balance',array(':openid'=>'wap_user_96_13597516502',':balance'=>69));

    //     // foreach($list as $key => $val){
            

    //     //     var_dump(pdo_update('wx_shop_order',array('balance'=>(round($val['price']*0.0035,2))),array('id'=>$val['id'])));
    //     // }

    //     // var_dump($list);


    //     // if(pdo_update('wx_shop_member',array('credit2 +='=>129.00),array('openid'=>'wap_user_96_13307277554'))){
    //     //     pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>'wap_user_96_13307277554','orderid'=>5275,'money'=>129.00,'type'=>2,'createtime'=>time()));
    //     // }

    //     // $list = pdo_fetchall('select openid,id,refundtime from '.tablename('wx_shop_order').' where refundtime > 0');

    //     // foreach($list as &$row){
    //     //     $row['refundtimes'] = date('Y-m-d H:s:i',$row['refundtime']);
    //     // }
    //     // unset($row);

    //     // var_dump($list);

    //     // $li = pdo_fetchall('select openid,credit_commission,mobile,realname from '.tablename('wx_shop_member').' where credit_commission < 0');

        
    //     // foreach($li as $k=>$v){
    //     //     $li[$k]['moneylogo'] = pdo_fetch('select money,id from '.tablename('wx_shop_member_log').' where genre = 1 and status = 0 and money > :money and openid = :openid',array(':openid'=>$v['openid'],':money'=>$v['credit_commission']));

    //     // }
        
    //     // foreach($li as $k=>$v){
    //     //     if($v['moneylogo']){
    //     //         pdo_update('wx_shop_member',array('credit_commission'=>0),array('openid'=>$v['openid']));
    //     //         pdo_update('wx_shop_member_log',array('money'=>$v['moneylogo']['money']-$v['credit_commission']),array('openid'=>$v['moneylogo']['id']));
    //     //     }
    //     // }


    //     // var_dump($li);
        
    //     // $pindex = max(1, intval($_GPC['page']));
    //     // $psize = 20;
        

    //     // $member = pdo_fetchall('select openid,credit_commission from '.tablename('wx_shop_member').' where id != 0  order by id desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize);
        
    //     // foreach($member as $k => $v){
    //     //     $member[$k]['log1'] = pdo_fetchcolumn('select SUM(`realmoney`) from '.tablename('wx_shop_member_log').' where  `genre` = 1 and (`status` = 1 or `status` = 0) and openid = :openid ',array(':openid'=>$v['openid']));
    //     //     $member[$k]['log'] = pdo_fetchcolumn('select sum(`money`) from '.tablename('wx_shop_member_log').' where  `genre` = 1 and (`status` = 1 or `status` = 0) and openid = :openid ',array(':openid'=>$v['openid']));
    //     //     $member[$k]['commission'] = pdo_fetchcolumn('select SUM(`money`) from '.tablename('wx_shop_member_commission').' where  `issue` = 1 and openid = :openid ',array(':openid'=>$v['openid']));
    //     // }

    //     // var_dump($member);

    // }
    public function xieyi(){
        global $_W;
        global $_GPC;
        $openid = $_GPC['openid'];
        $set  = m('common')->getPluginset('abonus');
        // $set = $data['regbg'];
        $member = m('member')->getMember($openid);

        // var_dump($data);die;
        $apply_set = array();
        $apply_set['open_protocol'] = $set['open_protocol'];

        if (empty($set['applytitle'])) 
        {
            $apply_set['applytitle'] = '区域代理申请协议';
        }
        else 
        {
            $apply_set['applytitle'] = $set['applytitle'];
        }

        $apply_set['applycontent'] = $set['applycontent'];
        $template_flag = 0;
        $diyform_plugin = p('diyform');

        if ($diyform_plugin) 
        {
            $set_config = $diyform_plugin->getSet();
            $abonus_diyform_open = $set_config['abonus_diyform_open'];
            if ($abonus_diyform_open == 1) 
            {
                $template_flag = 1;
                $diyform_id = $set_config['abonus_diyform'];
                if (!(empty($diyform_id))) 
                {
                    $formInfo = $diyform_plugin->getDiyformInfo($diyform_id);
                    $fields = $formInfo['fields'];
                    $diyform_data = iunserializer($member['diyaagentdata']);
                    $f_data = $diyform_plugin->getDiyformData($diyform_data, $fields, $member);
                }
            }
         }
         // var_dump($apply_set);die;
         show_json(1,['apply_set'=>$apply_set]);
    }

 	public function register() 
	{
		global $_W;
		global $_GPC;
		$openid = $_GPC['openid'];
     
        if ($_W['ispost']){
            // var_dump($openid);die;
    		$province = trim(str_replace(' ', '', $_GPC['province']));
            $city = trim(str_replace(' ', '', $_GPC['city']));

            // if(!$_GPC['province']){

            //     show_json(0,'代理地区不能为空');
            // }


            if(!$_GPC['realname']){

                show_json(0,'请填写姓名');
            }
            if(!$_GPC['weixin']){

                show_json(0,'请填写微信');
            }
    		$dls = pdo_fetchall('SELECT id,aagentprovinces,aagentcitys FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND aagentstatus=1 ',[':uniacid'=>$_W['uniacid']]);
    		// var_dump($dls);die;
    		foreach ($dls as $k => $v) {					
    			if($city){
    				//市代
    				$sdl = iunserializer($v['aagentcitys']);

    				if($city == $sdl['0']){

    					show_json(0,'该地区已存在市代理');
    				}
    			}
    			if($province){
    				//省代
    				$provinces = iunserializer($v['aagentprovinces']);

    			
    				if($province == $provinces['0']){
    					// var_dump(111);
    					show_json(0,'该地区已存在省代理');
    				}
    			}

    		}
    		
    		$provinces = ((!(empty($province)) ? iserializer(array($province)) : iserializer(array())));
    		$citys = ((!(empty($city)) ? iserializer(array(str_replace(' ', '', $city))) : iserializer(array())));
    		$area = trim(str_replace(' ', '', $_GPC['area']));
    		$areas = ((!(empty($area)) ? iserializer(array($area)) : iserializer(array())));
    		//查询用户押金
    		$member = pdo_fetch('SELECT id,openid,credit2,credit3,isaagent,aagentstatus FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);
 
            if($member['isaagent']==1 || $member['aagentstatus']==1 ){

                show_json(0,'你已经是代理，或者在审核当中');

            }

    		//后台押金设置
    		$data = m('common')->getSysset('grabsingle');
    		if($city){
    			//市代押金
    			$sdyj = $data['sdyj1'];
    			$type = '2';
    			if($member['credit2']<$sdyj){

    				show_json(0,'你的余额不够开通市区代理押金');
    			}

    		}else if($province){
    			//省代押金
    			$sdyj = $data['sdyj2'];
    			$type = '1';
    			if($member['credit2']<$sdyj){

    				show_json(0,'你的余额不够开通省区代理押金');
    			}

    		}
    		//扣除余额为押金
    		m('member')->setCredit($openid, 'credit2', -$sdyj, array($_W['uid'], '申请代理扣除余额为押金' .'余额'));
    		//记录
    		pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$openid,'orderid'=>0,'money'=>-$sdyj,'type'=>5,'createtime'=>time()));
    		//加押金
    		m('member')->setCredit($openid, 'credit3', $sdyj, array($_W['uid'], '申请代理扣除余额为押金' .'押金'));
    		//记录
    		pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$openid,'orderid'=>0,'money'=>$sdyj,'type'=>6,'createtime'=>time()));

    		pdo_insert('7033_yjjiedong',['uniacid'=>$_W['uniacid'],'uid'=>$member['id'],'money'=>$sdyj,'status'=>'0','type'=>$type,'tjtime'=>time()]);

    		 //记录
        	$this->credit2_log($openid,-$sdyj,['title'=>'代理保证金','rechargetype'=>'dlbzj'],0);

    		$data = array('isaagent' => 1, 'aagentstatus' => 0, 'realname' => trim($_GPC['realname']), 'weixin' => trim($_GPC['weixin']), 'aagenttime' => 0, 'aagenttype' => intval($_GPC['aagenttype']), 'aagentprovinces' => $provinces, 'aagentcitys' => $citys, 'aagentareas' => $areas,'deposit'=>$sdyj,'sqtime'=>time(),'dltype'=>$type);
    		pdo_update('wx_shop_member', $data, array('id' => $member['id']));
    		if (!(empty($member['uid']))) 
    		{
    			m('member')->mc_update($member['uid'], array('realname' => $data['realname'], 'mobile' => $data['mobile']));
    		}
    	   m('member')->setonline("123456",'tixian');
    	   show_json(1,'申请代理成功,请等待审核');
        }
		
		
	}

	

}