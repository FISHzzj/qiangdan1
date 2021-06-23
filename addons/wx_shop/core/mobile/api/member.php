<?php

header('Access-Control-Allow-Origin:*'); 

if (!(defined('IN_IA'))) 

{

	exit('Access Denied');

}

class Member_WxShopPage extends MobilePage

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

    

	public function main()  //用户信息

	{ 

        global $_W;

        global $_GPC;

        $openid  = trim($_GPC['openid']);


	    $member = pdo_fetch('SELECT id,openid,mobile,pwd2,avatar,isaagent,aagentstatus,aagentcitys,aagentprovinces,level FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

	    $aagentcitys = unserialize($member['aagentcitys']);

	    $aagentprovinces = unserialize($member['aagentprovinces']);
	    $dltype = 0;
	    if($member['aagentstatus']==1 && $aagentcitys['0']){

	    	$dltype = 1;
	    }


	    if($member['aagentstatus']==1 && $aagentprovinces['0']){

	    	$dltype = 2;
	    }
        //统计佣金
        $yongjin = pdo_fetchcolumn('SELECT sum(money) FROM '.tablename('wx_shop_member_log').'WHERE uniacid=:uniacid AND openid=:openid AND rechargetype = :rechargetype',[':uniacid'=>$_W['uniacid'],':openid'=>$openid,':rechargetype'=>'yongjin']);
        //保证金
        $bzj = pdo_fetchcolumn('SELECT sum(money) FROM'.tablename('7202_licaisy').'WHERE uniacid=:uniacid AND uid=:uid AND type = 1 ' ,[':uniacid'=>$_W['uniacid'],':uid'=>$member['id']]);
        //冻结订单
        $goodsprice = pdo_fetchcolumn('SELECT sum(goodsprice) FROM'.tablename('wx_shop_order').'WHERE uniacid=:uniacid AND openid=:openid AND freeze=:freeze ',[':uniacid'=>$_W['uniacid'],':openid'=>$member['openid'],':freeze'=>'1']); //freeze = 1
        // var_dump($goodsprice);die;

        if($_GPC['op']== 'pwd2'){

	        $member = pdo_fetch('SELECT id,mobile,pwd2 FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

			if(empty($member['pwd2'])){

				show_json(1,['status'=>'1','mobile'=>$member['mobile']]);

			}        	

        }

        // var_dump($yongjin);die;

		$member = $this->member;

		$members = p('commission')->getInfo($openid, array('ok','pay'));

        $datajson = array(

            'id'=>$member['id'],

            'openid'=>$member['openid'],

            'realname'=>$member['realname'],

            'avatar'=>$member['avatar']? $member['avatar']:tomedia('../addons/wx_shop/static/images/noface.png'),

            'mobile'=>$member['mobile'],

            'nickname'=>$member['nickname'],

            'credit2'=>$member['credit2'],

			'rcode'=>$member['rcode'],

			'weixin'=>$member['weixin'],

			'birthyear'=>$member['birthyear'],

			'birthmonth'=>$member['birthmonth'],

			'birthday'=>$member['birthday'],

			'province'=>$member['province'],

			'city'=>$member['city'],

			'area'=>$member['area'],

			'bankname'=>$member['bankname'],

			'bankcard'=>$member['bankcard'],

			'alipay'=>$member['alipay'],

			'commission'=>$yongjin,

			'bzj' => $bzj,

			'goodsprice' => $goodsprice,

			'dltype'=>$dltype,
			
			'level' =>$member['level'],

			'mobile'=>$member['mobile'],

			'qq'=>$member['qq'],

			'withdrawcharge' => $_W['shopset']['trade']['withdrawcharge'],


        );

        show_json(1,array('member'=>$datajson));

    }
    //首页收益计算
    public function calculation(){
    	global $_W;
    	global $_GPC;

    	$money = $_GPC['money'];

    	$daynum = $_GPC['daynum'];

    	$openid  = trim($_GPC['openid']);

    	$set = m('common')->getSysset('grabsingle');

    	$limit = $set['limit'];

    	$fanyong = pdo_fetchall('SELECT id,minquota,maxquota,discount FROM'.tablename('7033_fanyong').' WHERE uniacid=:uniacid AND enabled = 1 ',[':uniacid'=>$_W['uniacid']]);
    	$bili = 0;
    	foreach ($fanyong as $key => $value) {
    		if($money >= $value['minquota'] && $money <= $value['maxquota']){
    			$bili = $value['discount'];


    		}

    	}
    	$lcset = pdo_fetch('SELECT discount FROM'.tablename('7033_lcset').' WHERE uniacid=:uniacid AND enabled=1 AND levelname = 1 ',[':uniacid'=>$_W['uniacid']]);

    	// $num = ($money*$limit*($bili/100)*$daynum)+($money*($lcset/100)*$daynum);
    	// $qd_money = $money*$limit*($bili/100)*$daynum;
    	$qd_money = $money*($bili/100)*$daynum;
    	$lc_money = $money*($lcset['discount']/100)*$daynum;
    	$num = $qd_money + $lc_money;
    	// var_dump($num);die;
    	show_json(1,['num'=>$num]);


    }

    public function indexwz(){

    	global $_W;

    	global $_GPC;

    	$type = $_GPC['type'];

    	$data = m('common')->getSysset('grabsingle');

    	$content = $data['content'.$type];

    	show_json(1,['content'=>$content]);



    }

    //理财页面
    public function fundindex(){
    	global $_W;

    	global $_GPC;

    	$member = pdo_fetch('SELECT id,credit2 FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$_GPC['openid']]);

    	$lcset = pdo_fetchall('SELECT id,levelname,minquota,maxquota,discount FROM'.tablename('7033_lcset').'WHERE uniacid=:uniacid AND enabled = 1',[':uniacid'=>$_W['uniacid']]);

    	foreach ($lcset as $k => &$v) {
    		$v['text'] = '存'.$v['levelname'].'天/'.$v['discount'].'%';

    	}
    	$licaisy = pdo_fetchall('SELECT * FROM'.tablename('7202_licaisy').'WHERE uniacid=:uniacid AND uid =:uid ',[':uniacid'=>$_W['uniacid'],':uid'=>$member['id']]);

    	$summoney = pdo_fetchcolumn('SELECT sum(money) FROM'.tablename('7202_licaisy').'WHERE uniacid=:uniacid AND uid=:uid ',[':uniacid'=>$_W['uniacid'],':uid'=>$member['id']]);

    	$sumsylx = pdo_fetchcolumn('SELECT sum(sylx) FROM'.tablename('7202_licaisy').'WHERE uniacid=:uniacid AND uid=:uid AND type = 2 ',[':uniacid'=>$_W['uniacid'],':uid'=>$member['id']]);

    	foreach ($licaisy as $key => &$value) {
    		
    		$dqtime = $value['tjtime']+($value['syts']+60*60*24);

    		$value['lixi'] = $value['money']*($value['sybl']/100);

    		$value['dqtime'] = date('Y-m-d H:i:s',$dqtime);

    		$value['tqtime'] = date('Y-m-d H:i:s',$value['tqtime']);

    		$value['tjtime'] = date('Y-m-d H:i:s',$value['tjtime']);


    	}

    	show_json(1,['summoney'=>$summoney,'sumsylx'=>$sumsylx,'lcset'=>$lcset,'licaisy'=>$licaisy,'credit2'=>$member['credit2']]);

    }

    //理财提交
    public function fundinset(){
    	global $_W;

    	global $_GPC;
    	//理财id
    	$lcid = $_GPC['lcid'];
    	//存入金额
    	$money = $_GPC['money'];

    	$openid = $_GPC['openid'];

    	$member = pdo_fetch('SELECT id,credit2 FROM'.tablename('wx_shop_member').' WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);
    	$lcset = pdo_fetch('SELECT * FROM'.tablename('7033_lcset').'WHERE uniacid=:uniacid AND id=:id ',[':uniacid'=>$_W['uniacid'],':id'=>$lcid]);
    	// var_dump($lcset);die;
    	if($member['credit2']<$money){

    		show_json(0,'余额不足');
    	}

    	if($money<$lcset['minquota']){

    		show_json(0,'该理财最少'.$lcset['minquota'].'金额');
    	}

    	if($money>$lcset['maxquota']){

    		show_json(0,'该理财最大'.$lcset['maxquota'].'金额');
    	}

    	pdo_update('wx_shop_member',['credit2'=>$member['credit2']-$money],['id'=>$member['id']]);

    	$this->credit2_log($openid,$money,['title'=>'理财扣除金额','rechargetype'=>'lckc'],1);

    	$data = [
    		'uniacid'=>$_W['uniacid'],
    		'uid'=>$member['id'],
    		'money'=>$money,
    		'syts'=>$lcset['levelname'],
    		'sybl'=>$lcset['discount'],
    		'tjtime'=>time(),
    		'type'=>'1',
    	];

    	pdo_insert('7202_licaisy',$data);

    	show_json(1,'理财提交成功');
   

    }

    //理财提取
    public function licaitq(){
    	global $_W;
    	global $_GPC;

    	$openid = $_GPC['openid'];

    	$syid = $_GPC['syid'];

    	$member = pdo_fetch('SELECT id,credit2 FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid ]);

    	$licaisy = pdo_fetch('SELECT * FROM'.tablename('7202_licaisy').'WHERE uniacid=:uniacid AND id=:id AND uid =:uid ',[':uniacid'=>$_W['uniacid'],':id'=>$syid,':uid'=>$member['id']]);

    	if(!$licaisy){

    		show_json(0,'该理财不存在');
    	}

    	$dqtime = $licaisy['tjtime']+($licaisy['syts']+60*60*24);

    	if(time()<$dqtime){
    		pdo_update('7202_licaisy',['tqtime'=>time(),'type'=>'2'],['id'=>$licaisy['id']]);
    		pdo_update('wx_shop_member',['credit2'=>$member['credit2']+$licaisy['money']],['id'=>$member['id']]);

    		$this->credit2_log($openid,$licaisy['money'],['title'=>'理财提取','rechargetype'=>'lcsy'],1);

    	}else{
    		$lixi = $licaisy['money']*($licaisy['sybl']/100);
    		$money = $licaisy['money'] + $lixi;
    		pdo_update('7202_licaisy',['sylx'=>$lixi,'tqtime'=>time(),'type'=>'2'],['id'=>$licaisy['id']]);
    		pdo_update('wx_shop_member',['credit2'=>$member['credit2']+$money],['id'=>$member['id']]);

    		$this->credit2_log($openid,$licaisy['money'],['title'=>'理财提取','rechargetype'=>'lcsy'],1);

    		$this->credit2_log($openid,$lixi,['title'=>'理财收益利息','rechargetype'=>'lclx'],1);
    	}

    	show_json(1,'提取成功');



    }

    //理财验证
   	public function lcyz(){
   		global $_W;
    	global $_GPC;
    	$openid = $_GPC['openid'];

    	$syid = $_GPC['syid'];

    	$member = pdo_fetch('SELECT id,credit2 FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid ]);

    	$licaisy = pdo_fetch('SELECT * FROM'.tablename('7202_licaisy').'WHERE uniacid=:uniacid AND id=:id AND uid =:uid ',[':uniacid'=>$_W['uniacid'],':id'=>$syid,':uid'=>$member['id']]);

    	$dqtime = $licaisy['tjtime']+($licaisy['syts']+60*60*24);
    	// var_dump($licaisy);die;
    	if(time()<$dqtime){

    		show_json(916,'当前理财时间未到,确定提取?');
    	}else{

    		show_json(1);
    	}


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

    public function newslist(){//消息列表

    	global $_W;

    	global $_GPC;

    	if(!$_GPC['openid']){

    		show_json(0,'缺少openid');

    	}

    	$type = $_GPC['type'];//1系统信息 2站内信息

		// $log = pdo_fetchall('SELECT id,money,newstype,createtime FROM'.tablename('wx_shop_topup_check').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$_GPC['openid']]);
    	if($type==1){

    		$log = pdo_fetchall('SELECT id,title,detail,createtime FROM'.tablename('wx_shop_notice').' WHERE uniacid=:uniacid AND status=1 ',[':uniacid'=>$_W['uniacid']]);

    	}elseif($type==2){

			$log = pdo_fetchall('SELECT id,type,money,newstype,createtime FROM'.tablename('wx_shop_member_log')."WHERE uniacid=:uniacid AND openid=:openid AND rechargetype in ('cczcg','') ",[':uniacid'=>$_W['uniacid'],':openid'=>$_GPC['openid']]);

    	}

    	foreach ($log as $key => &$value) {

    		$value['createtime'] = date('Y-m-d H:i:s',$value['createtime']);

    	}

    	show_json(1,['log'=>$log]);

    }



    public function news(){ //消息详情页

    	global $_W;
    	global $_GPC;

    	if(!$_GPC['logid']){

    		show_json(0,'缺少logid');

    	}
    	$logid = $_GPC['logid'];

    	$type = $_GPC['type'];//1系统信息 2站内信息


    	if($type==1){

    		$log = pdo_fetch('SELECT id,title,detail,createtime FROM'.tablename('wx_shop_notice').'WHERE uniacid=:uniacid AND status=1 AND id=:id ',[':uniacid'=>$_W['uniacid'],':id'=>$logid]);
    		
    	}elseif($type==2){

			$log = pdo_fetch('SELECT id,type,money,newstype,createtime FROM'.tablename('wx_shop_member_log')."WHERE uniacid=:uniacid AND openid=:openid AND rechargetype in ('cczcg','') AND id=:id ",[':uniacid'=>$_W['uniacid'],':openid'=>$_GPC['openid'],':id'=>$logid]);

    	}

    	$log['createtime'] = date('Y-m-d H:i:s',$log['createtime']);

    	show_json(1,['log'=>$log]);

    }
    //活动中心接口
    public function activitylist(){
    	global $_W;
    	global $_GPC;

    	$hdnotice = pdo_fetchall('SELECT id,title,createtime FROM'.tablename('wx_shop_hdnotice').'WHERE uniacid=:uniacid AND status=1',[':uniacid'=>$_W['uniacid']]);

    	foreach ($hdnotice as $key => &$value) {
    		$value['createtime'] = date('Y-m-d H:i:s',$value['createtime']);
    	}

    	show_json(1,['hdnotice'=>$hdnotice]);


    }

    //活动中心接口内容
    public function activity(){
    	global $_W;
    	global $_GPC;

    	$id = $_GPC['id'];

    	$hdnotice = pdo_fetch('SELECT id,title,createtime,detail FROM'.tablename('wx_shop_hdnotice').'WHERE uniacid=:uniacid AND status=1 AND id=:id ',[':uniacid'=>$_W['uniacid'],':id'=>$id]);
   	
    	$hdnotice['createtime'] = date('Y-m-d H:i:s',$hdnotice['createtime']);
    	
    	show_json(1,['hdnotice'=>$hdnotice]);


    }

    //修改收货地址
    public function updatedz(){
    	global $_W;
        global $_GPC;

        $openid = $_GPC['openid'];

        $address = pdo_fetch('SELECT id FROM'.tablename('wx_shop_member_address').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

        // if($address){

        // 	show_json(0,'地址一旦设置,不可修改');die;
        // }
        // var_dump($address);die;
        if(!$address){

        	pdo_insert('wx_shop_member_address',['uniacid'=>$_W['uniacid'],'openid'=>$openid,'realname'=>$_GPC['realname'],'mobile'=>$_GPC['mobile'],'province'=>$_GPC['province'],'city'=>$_GPC['city'],'area'=>$_GPC['area'],'address'=>$_GPC['address']]);

        	show_json(1,'地址保存成功');

        }else{

        	pdo_update('wx_shop_member_address',['realname'=>$_GPC['realname'],'mobile'=>$_GPC['mobile'],'province'=>$_GPC['province'],'city'=>$_GPC['city'],'area'=>$_GPC['area'],'address'=>$_GPC['address']],['openid'=>$openid]);

        	show_json(1,'地址保存成功');

        }


    }

   	public function newstype(){

   		global $_W;

    	global $_GPC;

    	if(!$_GPC['logid']){

    		show_json(0,'缺少logid');

    	}

    	$log = pdo_fetch('SELECT id,type,money,newstype FROM'.tablename('wx_shop_member_log').'WHERE uniacid=:uniacid AND id=:id AND newstype=:newstype ',[':uniacid'=>$_W['uniacid'],':id'=>$_GPC['logid'],':newstype'=>0]);

    	$log1 = pdo_fetch('SELECT id,type,money,newstype FROM'.tablename('wx_shop_topup_check').'WHERE uniacid=:uniacid AND id=:id AND newstype=:newstype ',[':uniacid'=>$_W['uniacid'],':id'=>$_GPC['logid'],':newstype'=>0]);

    	$logs = array_merge($log,$log1);

    	if($logs){

    		$type=1;

    	}else if(!$logs){

    		$type = 0;

    	}

    	show_json(1,['type'=>$type]);//消息提醒状态

   	}

   	public function bankname(){ //银行卡名称

   		global $_W;

        global $_GPC;

   		$bank_list = pdo_fetchall('SELECT id,name FROM'.tablename('6925_bank_list').'WHERE uniacid=:uniacid ',[':uniacid'=>$_W['uniacid']]);

   		show_json(1,['bank_list'=>$bank_list]);

   	}

	public function member_submit() //修改信息

	{

		global $_W;

        global $_GPC;

		$openid  = trim($_GPC['openid']);

		$member = pdo_fetch('SELECT id,mobile,nickname,qq,bankcard,datatype FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);
		// var_dump($member);exit;
		if($member['datatype']==1){

			show_json(0,'个人资料只可以修改一次');

		}

		if(!$_GPC['mobile']){

			show_json(0,'手机号不能为空');
		}

		if(!$_GPC['nickname']){

			show_json(0,'昵称不能为空');
		}

		if(!$_GPC['bankcard']){

			show_json(0,'银行卡不能为空');
		}

		$data = array(

            'mobile'=>trim($_GPC['mobile']),
            // 'avatar'=>trim($_GPC['avatar']),
            'nickname'=>trim($_GPC['nickname']),
            // 'weixin'=>trim($_GPC['weixin']),
            'qq' => trim($_GPC['qq']),

            'bankcard' => trim($_GPC['bankcard']),

            'datatype' => 1
            // 'birthyear'=>trim($_GPC['birthyear']),

            // 'birthmonth'=>trim($_GPC['birthmonth']),

            // 'birthday'=>trim($_GPC['birthday']),

            // 'province'=>trim($_GPC['province']),

            // 'city'=>trim($_GPC['city']),

            // 'area'=>trim($_GPC['area']),

		);

		pdo_update('wx_shop_member',$data,array('openid'=>$openid,'uniacid'=>$_W['uniacid']));

		show_json(1,['member'=>$member]);

	}

	public function topup()   //充值

	{  

		global $_W;

		global $_GPC;

		$data['money'] = floatval($_GPC['money']);

		$data['image'] = trim($_GPC['image']);


		$data['mobile'] = trim($_GPC['mobile']);

		$data['type'] = intval($_GPC['type']);

		$data['openid'] = trim($_GPC['openid']);

		$data['uniacid'] = $_W['uniacid'];

		$data['createtime'] = time();

		if(empty($data['type'])){

			show_json(0, '请选择支付方式');

		}

        $redis = redis();
        $key = 'cz'.$openid;
        if(empty($redis->get($key))){
            $setex = $redis -> setex($key,2,1);
        }else if(!empty($redis->get($key))){
            show_json(0,'请勿快速点击');
        }

		// if(empty($data['mobile'])){

		// 	show_json(0, '请填写手机号');

		// }
		// if($data['type'] == 3){

			$data['branch'] = trim($_GPC['branch']);

			$data['realname'] = trim($_GPC['realname']);

			$data['bankname'] = trim($_GPC['bankname']);

			$data['bankcard'] = trim($_GPC['bankcard']);

			$data['payment'] = trim($_GPC['payment']);

			// if(empty($data['realname'])){

			// 	show_json(0, '请填写账户姓名');

			// }

			// if(empty($data['branch'])){

			// 	show_json(0, '请填写银行支行');

			// }

			// if(empty($data['bankname'])){

			// 	show_json(0, '请填写银行名称');

			// }

			// if(empty($data['bankcard'])){

			// 	show_json(0, '请填写银行卡号');

			// }

		// }



		if(!$data['money']){

			show_json(0, '请填写金额');

		}

		// if($data['money'] < $_W['shopset']['trade']['minimumcharge']){

		// 	show_json(0, '每笔充值最少要'.$_W['shopset']['trade']['minimumcharge'].'元');

		// }

		// if($data['money'] > $_W['shopset']['trade']['maximumcharge']){

		// 	show_json(0, '每笔充值最多只能充值'.$_W['shopset']['trade']['maximumcharge'].'元');

		// }

		if(!$data['image']){

			show_json(0, '请上传支付凭证');

		}

        

		if(pdo_insert('wx_shop_topup_check',$data)){
            m('member')->setonline("123456",'tixian');
			show_json(1, '提交成功请等待审核');

		}



    }



    public function address() //收货地址列表

	{

		global $_W;

		global $_GPC;

        global $_S;

        $openid  = trim($_GPC['openid']);

		$area_set = m('util')->get_area_config_set();

		$new_area = intval($area_set['new_area']);

		$address_street = intval($area_set['address_street']);

		$pindex = intval($_GPC['page']);

		$psize = 20;

		$condition = ' and openid=:openid and deleted=0 and  `uniacid` = :uniacid  ';

		$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);

		$sql = 'SELECT COUNT(*) FROM ' . tablename('wx_shop_member_address') . ' where 1 ' . $condition;

		$total = pdo_fetchcolumn($sql, $params);

		$sql = 'SELECT * FROM ' . tablename('wx_shop_member_address') . ' where 1 ' . $condition . ' ORDER BY `id` DESC';

		if ($pindex != 0) 

		{

			$sql .= ' LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;

		}

		$list = pdo_fetchall($sql, $params);

		m('member')->setonline("123456",'tixian');

		show_json(1,array('list'=>$list));



    }

    

    public function address_post() //查看地址

	{

		global $_W;

        global $_GPC;

        $openid  = trim(trim($_GPC['openid']));

		$id = intval($_GPC['id']);

		$address = pdo_fetch('select * from ' . tablename('wx_shop_member_address') . ' where openid=:openid and uniacid=:uniacid limit 1 ', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));

		$area_set = m('util')->get_area_config_set();

		$new_area = intval($area_set['new_area']);

		$address_street = intval($area_set['address_street']);

		$show_data = 1;

		if ((!(empty($new_area)) && empty($address['datavalue'])) || (empty($new_area) && !(empty($address['datavalue'])))) 

		{

			$show_data = 0;

		}

		show_json(1,array('address'=>$address));

    }


 	//押金遍历
 	public function deposit_list(){
 		global $_W;
		global $_GPC;
		$openid = $_GPC['openid'];

		$member = pdo_fetch('SELECT id,aagentprovinces,aagentcitys,account,deposit FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

		$sumdeposit= $member['account']+$member['deposit'];

		$dl_log = pdo_fetchall('SELECT * FROM'.tablename('7033_yjjiedong').'WHERE uniacid=:uniacid AND uid=:uid ',[':uniacid'=>$_W['uniacid'],':uid'=>$member['id']]);

		foreach ($dl_log as $key => &$value) {
			
			$value['tjtime'] = date('Y-m-d H:i:s',$value['tjtime']);

			$value['uptime'] = date('Y-m-d H:i:s',$value['uptime']);

		}


		show_json(1,['sumdeposit'=>$sumdeposit,'dl_log'=>$dl_log]);
 	}

    //押金解冻申请
    public function deposit_of(){
    	global $_W;
		global $_GPC;

		$type = $_GPC['type'];//1为省代 2为市代 3为开户押金 

		$openid = $_GPC['openid']; 

		$money = $_GPC['money'];

		$bzjid = $_GPC['bzjid'];

		$member = pdo_fetch('SELECT id,credit2,aagentprovinces,aagentcitys,account,deposit FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

		$yjjiedong = pdo_fetch('SELECT id,status,money FROM'.tablename('7033_yjjiedong').'WHERE uniacid=:uniacid AND id=:id AND uid=:uid',[':uniacid'=>$_W['uniacid'],':id'=>$bzjid,':uid'=>$member['id']]);

		if(!$yjjiedong){

			show_json(0,'你并没有这笔保证金可以申请解冻');
		}

		if($member['account']< $money && $type==3){

			show_json(0,'你的开户保证金不够申请解冻');
		}

		if($member['deposit']< $money && $type<3){

			show_json(0,'你的代理保证金不够申请解冻');
		}

		pdo_update('7033_yjjiedong',['status'=>'1'],['uniacid'=>$_W['uniacid'],'id'=>$bzjid,'uid'=>$member['id']]);
		m('member')->setonline("123456",'tixian');
		show_json(1,'申请解冻成功,等待后台审核');

    }

    public function withdraw_submit() //提现申请

	{

		global $_W;

		global $_GPC;

        $set = $_W['shopset']['trade'];

        $openid = trim($_GPC['openid']);



		if (empty($set['withdraw'])) 

		{

			show_json(0, '系统未开启提现!');

		}

        $redis = redis();
        $key = 'tx'.$openid;
        if(empty($redis->get($key))){
            $setex = $redis -> setex($key,2,1);
        }else if(!empty($redis->get($key))){
            show_json(0,'请勿快速点击');
        }

		$sets = $_W['shopset']['grabsingle'];
		$limit = $sets['limit'];
		$today_start = strtotime(date("Y-m-d"),time());

        $today_end = strtotime(date("Y-m-d 23:59:59"),time());

		$order = pdo_fetchcolumn('select count(*) from '.tablename('wx_shop_order'). 'where status > 0 and openid = :openid and uniacid = :uniacid and createtime >='.$today_start.' and createtime <='.$today_end,array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));
		// var_dump($limit);die;
		if($order<$limit){
			$num = $limit-$order;
			show_json(0,'你今天的订单数量还剩'.$num.'暂不能提现');
		}
		$member = pdo_fetch('SELECT id,pwd2,salt FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);



		if(empty($member['pwd2'])){

			show_json(0,'支付密码为空');

		}


		if(empty($_GPC['pwd2'])){

			show_json(0,'请输入支付密码');

		}


		$salt = ((empty($member) ? '' : $member['salt']));
		if (empty($salt)) 
		{
			$salt = m('account')->getSalt();
		}

		if(md5($_GPC['pwd2'].$salt) != $member['pwd2']){

			show_json(0,'支付密码不正确');

		}

		$set_array = array();

		$set_array['charge'] = $set['withdrawcharge'];

		$set_array['begin'] = floatval($set['withdrawbegin']);

		$set_array['end'] = floatval($set['withdrawend']);

		$money = floatval($_GPC['money']);

		$genre = intval($_GPC['genre']);

		if($genre == 1){

			$field_credit = 'credit_commission';

		}else{

			$field_credit = 'credit2';

		}

		$credit = m('member')->getCredit($openid, $field_credit);

		// if($genre != 1){

		// 	$bbin = m('member')->getCredit($openid,'bbin');

		// 	if($credit - $money < $bbin){

		// 		show_json(0, '体验金不能体现!');

		// 	}

		// }

		if ($money <= 0) 

		{

			show_json(0, '提现金额错误!');

		}

		if ($credit < $money) 

		{

			show_json(0, '提现金额过大!');

		}

		if($money < $set['withdrawmoney']){

			show_json(0, '提现金额最少'.$set['withdrawmoney']);

		}

		if($money > $set['maxwithdrawmoney']){

			show_json(0, '提现金额最大'.$set['maxwithdrawmoney']);

		}

		$today_start = strtotime(date("Y-m-d"),time());

		$today_end = strtotime(date("Y-m-d 23:59:59"),time());

		$log_member = pdo_fetchcolumn('select count(*) from'. tablename('wx_shop_member_log') .' where createtime >='.$today_start.' and createtime <='.$today_end.' and openid = :openid',array(':openid'=>$openid));

		if ($log_member > $set['everydaywithdrawmoney']) 

		{

			show_json(0, '今天已提现,一天只能提现'.$set['everydaywithdrawmoney'].'次!');

		}

		$apply = array();

		$type_array = array();

		if ($set['withdrawcashweixin'] == 1) 

		{

			$type_array[1]['title'] = '提现到微信钱包';

		}

		if ($set['withdrawcashalipay'] == 1) 

		{

			$type_array[2]['title'] = '提现到支付宝';

		}

		if ($set['withdrawcashcard'] == 1) 

		{

			$type_array[3]['title'] = '提现到银行卡';

			$condition = ' and uniacid=:uniacid';

			$params = array(':uniacid' => $_W['uniacid']);

			$banklist = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_commission_bank') . ' WHERE 1 ' . $condition . '  ORDER BY displayorder DESC', $params);

		}

		$applytype = intval($_GPC['applytype']);
		// var_dump($type_array);die;
		if (!(array_key_exists($applytype, $type_array))) 

		{

			show_json(0, '未选择提现方式，请您选择提现方式后重试!');

		}

		if ($applytype == 2) 

		{

			$realname = trim($_GPC['realname']);

			$alipay = trim($_GPC['alipay']);

			$alipay1 = trim($_GPC['alipay1']);

			if (empty($realname)) 

			{

				show_json(0, '请填写姓名!');

			}

			if (empty($alipay)) 

			{

				show_json(0, '请填写支付宝帐号!');

			}

			// if (empty($alipay1)) 

			// {

			// 	show_json(0, '请填写确认帐号!');

			// }

			// if ($alipay != $alipay1) 

			// {

			// 	show_json(0, '支付宝帐号与确认帐号不一致!');

			// }

			$apply['realname'] = $realname;

			$apply['alipay'] = $alipay;

		}

		else if ($applytype == 3) 

		{

			$realname = trim($_GPC['realname']);

			$bankname = trim($_GPC['bankname']);

			$bankcard = trim($_GPC['bankcard']);

			$bankcard1 = trim($_GPC['bankcard1']);

			if (empty($realname)) 

			{

				show_json(0, '请填写姓名!');

			}

			if (empty($bankname)) 

			{

				show_json(0, '请选择银行!');

			}

			if (empty($bankcard)) 

			{

				show_json(0, '请填写银行卡号!');

			}

			// if (empty($bankcard1)) 

			// {

			// 	show_json(0, '请填写确认卡号!');

			// }

			// if ($bankcard != $bankcard1) 

			// {

			// 	show_json(0, '银行卡号与确认卡号不一致!');

			// }

			$apply['realname'] = $realname;

			$apply['bankname'] = $bankname;

			$apply['bankcard'] = $bankcard;

		}else{

			$weixin = trim($_GPC['weixin']);

			$apply['weixin'] = $weixin;

			if (empty($weixin)) 

			{

				show_json(0, '请填写微信号!');

			}

		}

		pdo_update('wx_shop_member',$apply,array('openid'=>$openid));

		$realmoney = $money;

		if (!(empty($set_array['charge']))) 

		{

			$money_array = m('member')->getCalculateMoney($money, $set_array);

			if ($money_array['flag']) 

			{

				$realmoney = $money_array['realmoney'];

				$deductionmoney = $money_array['deductionmoney'];

			}

		}

		m('member')->setCredit($openid, $field_credit, -$money, array(0, $_W['shopset']['set'][''] . '提现预扣除: ' . $money . ',实际到账金额:' . $realmoney . ',手续费金额:' . $deductionmoney));

		$logno = m('common')->createNO('member_log', 'logno', 'RW');

		$apply['uniacid'] = $_W['uniacid'];

		$apply['logno'] = $logno;

		$apply['openid'] = $openid;

		if($genre == 1){

			$apply['title'] = '佣金提现';

		}else{

			$apply['title'] = '余额提现';

		}

		$apply['type'] = 1;

		$apply['genre'] = $genre;

		$apply['createtime'] = time();

		$apply['status'] = 0;

		$apply['money'] = $money;

		$apply['realmoney'] = $realmoney;

		$apply['deductionmoney'] = $deductionmoney;

		$apply['charge'] = $set_array['charge'];

		$apply['applytype'] = $applytype;

		$apply['imgs'] = $_GPC['imgURL'];

		pdo_insert('wx_shop_member_log', $apply);

		$logid = pdo_insertid();

		m('notice')->sendMemberLogMessage($logid);
		m('member')->setonline("123456",'tixian');

		show_json(1);

	}

	public function txzil(){
		global $_W;
		global $_GPC;
		$openid = trim($_GPC['openid']);

		$member = pdo_fetch('SELECT mobile,realname,bankname,bankcard FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],'openid'=>$openid]);

		show_json(1,['member'=>$member]);


	}

	public function setpwd2(){

		global $_W;

		global $_GPC;

		@session_start();

        $openid = trim($_GPC['openid']);

        $verifycode = trim($_GPC['verifycode']);

        if(!$openid){

        	show_json(0,'缺少openid');

        }



        $member = pdo_fetch('SELECT id,mobile,salt FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);



        $key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $member['mobile'];



        if (!(isset($_SESSION[$key])) || ($_SESSION[$key] !== $verifycode) || !(isset($_SESSION['verifycodesendtime'])) || (($_SESSION['verifycodesendtime'] + 600) < time())) 

			{

				show_json(0, '验证码错误或已过期!');

			}

		$salt = $member['salt'];
		if (empty($salt)) 
		{
			$salt = m('account')->getSalt();
		}	

        $pwd2 = md5($_GPC['pwd2'].$salt);



        pdo_update('wx_shop_member',['pwd2'=>$pwd2],['uniacid'=>$_W['uniacid'],'openid'=>$openid]);



        show_json(1,'设置支付密码成功');


	}
	//账户明细
    public function credit_log(){
    	global $_W;
		global $_GPC;
		$type = $_GPC['type'];//1.全部 2充值 3提现 4.抢单 5返佣 6冻结 7解冻 8分润
		//搜索时间
		$days = (int)$_GPC['days'];
		$openid = $_GPC['openid'];		
		$pindex = max(1, intval($_GPC['page']));
        $psize = 10;

		if($type==1){
			// $apply_type = array(0 => '微信钱包', 2 => '支付宝', 3 => '银行卡');
			$condition = "and openid=:openid and uniacid=:uniacid ";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);

		}else if($type==2){

			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype=:rechargetype";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid,':rechargetype'=>'cczcg');
		}elseif($type==3){

			$condition = "and openid=:openid and uniacid=:uniacid AND type = :type ";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid,':type'=>1);

		}elseif($type==4){

			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype=:rechargetype AND type = 0";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid,':rechargetype'=>'qdcg');

		}elseif($type==5){

			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype=:rechargetype";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid,':rechargetype'=>'qdyj');

		}elseif($type==6){

			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype=:rechargetype";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid,':rechargetype'=>'dddj');

		}elseif($type==7){

			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype=:rechargetype";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid,':rechargetype'=>'ddjd');

		}elseif($type==8){

			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype in ('yongjin')";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);
		}elseif($type==9){
			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype in ('lckc','lcsy','lclx')";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);
		}elseif($type==10){
			$condition = "and openid=:openid and uniacid=:uniacid AND rechargetype in ('txsb')";
			$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);
		}

		if($days == 1){
				$createtime = date('Ymd',time()- ($days * 3600 * 24))+1;
				$condition .= "AND DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y%m%d') =:createtime";
				$params[':createtime'] = $createtime;
		}else if($days >1){
				$createtime = date('Ymd',time()- ($days * 3600 * 24));
				$condition .= "AND DATE_FORMAT(FROM_UNIXTIME(createtime),'%Y%m%d') >:createtime";
				$params[':createtime'] = $createtime;
		}
		// var_dump($condition);exit;
		$list = pdo_fetchall('SELECT id,createtime,money,title,status,rechargetype,type FROM ' . tablename('wx_shop_member_log') . ' where 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);

		$total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_member_log') . ' where 1 ' . $condition, $params);
		
		foreach ($list as &$v) {
			if($type==3){
				if($v['status']==0){

					$v['title'] = '提现审核中';
				}elseif($v['status']==1){

					$v['title'] = '提现成功';
				}

			}
			$v['createtime'] = date('Y-m-d H:i', $v['createtime']);
		}

		show_json(1, array('list' => $list, 'total' => $total, 'pagesize' => $psize));

    }

    public function log_get_list()  //提现记录

	{

		global $_W;

		global $_GPC;

		$genre = intval($_GPC['genre']);

		$type = 1;

		$pindex = max(1, intval($_GPC['page']));

        $psize = 10;

        $openid = trim($_GPC['openid']);

		$apply_type = array(0 => '微信钱包', 2 => '支付宝', 3 => '银行卡');

		$condition = ' and openid=:openid and uniacid=:uniacid and type=:type and genre=:genre';

		$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid, ':type' => $type, ':genre'=>$genre);

		$list = pdo_fetchall('select status,applytype,createtime,money,realmoney,deductionmoney,genre from ' . tablename('wx_shop_member_log') . ' where 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);

		$total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_member_log') . ' where 1 ' . $condition, $params);

		foreach ($list as &$row ) 

		{

			$row['createtime'] = date('Y-m-d H:i', $row['createtime']);

			$row['typestr'] = $apply_type[$row['applytype']];



		}

		unset($row);

		show_json(1, array('list' => $list, 'total' => $total, 'pagesize' => $psize));

	}

	
	public function log_get_list1() //充值记录

	{

		global $_W;

		global $_GPC;

		$pindex = max(1, intval($_GPC['page']));

        $psize = 10;

        $openid = trim($_GPC['openid']);

		$apply_type = array(0 => '待审核', 1 => '通过',2=>'未通过');

		$condition = ' and openid=:openid and uniacid=:uniacid ';

		$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);

		$list = pdo_fetchall('select * from ' . tablename('wx_shop_topup_check') . ' where 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);

		$total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_topup_check') . ' where 1 ' . $condition, $params);

		foreach ($list as &$row ) 

		{

			$row['createtime'] = date('Y-m-d H:i', $row['createtime']);

			$row['typestr'] = $apply_type[$row['status']];

			$row['image'] = tomedia($row['image']);



		}

		unset($row);

		show_json(1, array('list' => $list, 'total' => $total, 'pagesize' => $psize));


	}

	public function log_get_list2(){//奖励记录
		global $_W;

		global $_GPC;

		$pindex = max(1, intval($_GPC['page']));

        $psize = 10;

        $openid = trim($_GPC['openid']);

		// $apply_type = array(0 => '待审核', 1 => '通过',2=>'未通过');

		$condition = ' and openid=:openid and uniacid=:uniacid and genre=1 ';

		$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);

		$list = pdo_fetchall('select id,money,createtime,level from ' . tablename('wx_shop_member_log') . ' where 1 ' . $condition . ' order by createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);

		$total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_member_log') . ' where 1 ' . $condition, $params);

		foreach ($list as &$row ) 

		{
			$row['createtime'] = date('Y-m-d H:i', $row['createtime']);

			if($row['level']==1){

				$row['level'] = '一级奖励';

			}else if($row['level']==2){

				$row['level'] = '二级奖励';
			}else if($row['level']==3){

				$row['level'] = '三级奖励';
			}

		}

		unset($row);

		show_json(1, array('list' => $list, 'total' => $total, 'pagesize' => $psize));



	}



	public function down_get_list() //我的团队

	{

		global $_W;

		global $_GPC;

		$openid = trim($_GPC['openid']);

		$type = $_GPC['type'];

		$member = pdo_fetch('SELECT id,isaagent,aagentstatus,aagentprovinces,aagentcitys FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

		if($member['isaagent']==1 && $member['aagentstatus']){
			$status = 1;
		}else{

			$status = 0;
		}
		// $dlyj = pdo_fetchcolumn('SELECT sum(money) FROM'.tablename('wx_shop_member_log')."WHERE uniacid=:uniacid AND openid=:openid AND rechargetype in ('sheng','shi') ",[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);
		$aagentprovinces = unserialize($member['aagentprovinces']);
		//省代理
		$provinces = $aagentprovinces['0'];
		$aagentcitys = unserialize($member['aagentcitys']);
		//市代理
		$citys = $aagentcitys['0'];
		$myxiaji = m('member')->getmylower_threes($member['id']);
		$list = [];
		$zhishu = 0;
		$team = 0;
		$credit2_log = 0;
		$tixian = 0;
		// $shengdl = 0;
		// $shidl = 0;
		foreach ($myxiaji as $key => &$value) {
			$value['createtime'] = date('Y-m-d',$value['createtime']);
			if($type==$value['i']){
				$list[] = $value;
			}

			if($value['i']==1){
				$zhishu ++;

				$value['countzt'] = pdo_fetchcolumn('SELECT count(id) FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND agentid=:agentid ',[':uniacid'=>$_W['uniacid'],':agentid'=>$value['id']]);
			}				

			$team ++;

			$cz = pdo_fetchcolumn('SELECT sum(money) FROM'.tablename('wx_shop_member_log').'WHERE uniacid=:uniacid AND openid=:openid AND (rechargetype=:rechargetype or rechargetype=:rechargetypes)',[':uniacid'=>$_W['uniacid'],':openid'=>$value['openid'],':rechargetype'=>'cczcg', ':rechargetypes' => 'system']);

			$credit2_log += $cz;

			$tx = pdo_fetchcolumn('SELECT sum(money) FROM'.tablename('wx_shop_member_log').'WHERE uniacid=:uniacid AND openid=:openid AND type=1 AND status = 1 AND rechargetype=:rechargetype',[':uniacid'=>$_W['uniacid'],':openid'=>$value['openid'],':rechargetype'=>'']);

			$tixian += $tx;

			// $address = pdo_fetch('SELECT id,province,city FROM'.tablename('wx_shop_member_address').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$value['openid']]);

			// if($provinces){
			// 	if($provinces== $address['province']){
			// 		$shengdl++;
			// 	}
			// }
			// if(!$provinces && $citys){
			// 	if($citys == $address['city']){
			// 		$shidl++;
			// 	}

			// }

		}
		// var_dump($list);exit;
		show_json(1, array('list' => $list, 'zhishu' => $zhishu,'team'=>$team,'credit2_log'=>$credit2_log,'tixian'=>$tixian,));

	}



	public function qrcode()  //我的分享二维码

	{

		global $_W;

		global $_GPC;

		$mid = intval($_GPC['mid']);

		$openid =  trim($_GPC['openid']);

		$member = $this->member;

		$share_set = set_medias(m('common')->getSysset('share'), 'icon');

		$can = false;

		if (empty($member['isagent']) || empty($member['status'])) {

			// header('location: ' . mobileUrl('commission/register'));

			show_json(0,'你还不是分销商');

			exit();

		}



		$returnurl = urlencode(mobileUrl('commission/qrcode', array('goodsid' => $_GPC['goodsid'])));

		$infourl = '';

		$set = $_W['shopset']['commission'];



		// if (!empty($set['closed_qrcode']) && !intval($_GPC['goodsid'])) {

			// $this->message('没有开启推广二维码!', mobileUrl('commission'), 'info');

			// show_json(0,'没有开启推广二维码');

		// }



		// if (empty($set['become_reg'])) {

		// 	if (empty($member['realname'])) {

		// 		$this->message('需要您完善资料才能继续操作!', mobileUrl('member/info', array('returnurl' => $returnurl)), 'info');

		// 	}

		// }



		$myshop = p('commission')->getShop($member['id']);

		

		$share_goods = false;

		$share = array();

		$goodsid = intval($_GPC['goodsid']);



		if (!empty($goodsid)) {

			$goods = pdo_fetch('select * from ' . tablename('wx_shop_goods') . ' where uniacid=:uniacid and id=:id limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $goodsid));

			$goods = set_medias($goods, 'thumb');



			if (!empty($goods)) {

				$commission = number_format(p('commission')->getCommission($goods), 2);

				$share_goods = true;

				$_W['shopshare'] = array('title' => !empty($goods['share_title']) ? $goods['share_title'] : $goods['title'], 'imgUrl' => !empty($goods['share_icon']) ? tomedia($goods['share_icon']) : tomedia($goods['thumb']), 'desc' => !empty($goods['description']) ? $goods['description'] : (empty($set['closemyshop']) ? $myshop['name'] : $_W['shopset']['shop']['name']), 'link' => mobileUrl('commission/share', array('goodsid' => $goods['id'], 'mid' => $member['id']), true));

			}

		}



		if (!$share_goods) {

			if (empty($set['closemyshop'])) {

				$_W['shopshare'] = array('imgUrl' => $myshop['logo'], 'title' => $myshop['name'], 'desc' => $myshop['desc'], 'link' => mobileUrl('commission/share', array('mid' => $member['id']), true));

			}

			else {

				$_W['shopshare'] = array('imgUrl' => !empty($share_set['icon']) ? $share_set['icon'] : $_W['shopset']['shop']['logo'], 'title' => !empty($share_set['title']) ? $share_set['title'] : $_W['shopset']['shop']['name'], 'desc' => !empty($share_set['desc']) ? $share_set['desc'] : $_W['shopset']['shop']['description'], 'link' => mobileUrl('commission/share', array('mid' => $member['id']), true));

			}

		}



		if ($_W['ispost']) {

			$p = p('poster');

			$img = '';

			if ($share_goods) {

				if ($p) {

					$img = $p->createCommissionPoster($openid, $goods['id']);

				}



				if (empty($img)) {

					$img = p('commission')->createGoodsImage($goods);

				}

			}

			else if (!empty($set['qrcode'])) {

				if ($p) {

					$img = $p->createCommissionPoster($openid, 0, 4);

				}

			}

			else {

				if ($p) {

					$img = $p->createCommissionPoster($openid);

				}



				if (empty($img)) {

					$img = p('commission')->createShopImage($openid);

				}

			}

			// var_dump($img);exit;

			$rcode = pdo_fetch('SELECT id,rcode FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

			// login?mid=4041&posterid=10

			// $url = $_W['siteroot'].'login?mid='.$rcode['id'].'&rcode='.$rcode['rcode'];

			$url =  mobileUrl('account/register', array('mid' => $rcode['id'],'rcode'=>$rcode['rcode']), true);

			// echo json_encode(array('img'=>$img));exit;

			show_json(1, array('img' => $img . '?t=' . TIMESTAMP,'url'=>$url));

		}

		$set['qrcode_content'] = htmlspecialchars_decode($set['qrcode_content'], ENT_QUOTES);

		include $this->template();

	}





	public function commission() //佣金

	{

		global $_W;

		global $_GPC;

		$openid = trim($_GPC['openid']);

		$todaystart =strtotime(date('Y-m-d')); //今天开始

		$todayend =strtotime(date('Y-m-d 23:59:59')); //今天结束



		$yesterdaystart = strtotime(date('Y-m-d',strtotime('-1 day'))); //昨天开始

		$yesterdayend = strtotime(date('Y-m-d 23:59:59',strtotime('-1 day')));//昨天结束



		$monthstart = strtotime(date('Y-m-1'));  //本月开始

        $monthend = strtotime(date('Y-m-d',strtotime(date('Y-m-1',strtotime('next month')).'-1 day')));//本月结束 



		$lastmonthstart = strtotime(date('Y-m-1',strtotime('last month')));//上月开始

		$lastmonthend = strtotime(date('Y-m-d',strtotime(date('Y-m-1').'-1 day')));//上月结束

		$member = p('commission')->getInfo($openid, array('ok','pay'));



		$data['today'] = pdo_fetchcolumn('select COALESCE(SUM(money),0) from'.tablename('wx_shop_member_commission').' where openid=:openid and issue = 1 and status =1 and to_days(from_unixtime(issuetime)) = to_days(now())',array(':openid'=>$openid));

		$data['yesterday'] = pdo_fetchcolumn('select COALESCE(SUM(money),0) from'.tablename('wx_shop_member_commission').' where openid=:openid and issue = 1 and status =1 and issuetime >'.$yesterdaystart.' and issuetime < '.$yesterdayend.' ',array(':openid'=>$openid));

		$data['month'] = pdo_fetchcolumn('select COALESCE(SUM(money),0) from'.tablename('wx_shop_member_commission').' where openid=:openid and issue = 1 and status =1 and issuetime >'.$monthstart.' and issuetime < '.$monthend.' ',array(':openid'=>$openid));

		$data['lastmonth'] = pdo_fetchcolumn('select COALESCE(SUM(money),0) from'.tablename('wx_shop_member_commission').' where openid=:openid and issue = 1 and status =1 and issuetime >'.$lastmonthstart.' and issuetime < '.$lastmonthend.' ',array(':openid'=>$openid));

		$data['commission'] = pdo_fetchcolumn('select COALESCE(SUM(money),0) from'.tablename('wx_shop_member_commission').' where openid=:openid and issue = 1 and status =1',array(':openid'=>$openid));

		$data['conut'] = $member['level1']+$member['level2']+$member['level3'];

		$data['level1'] = $member['level1'];

		$data['level2'] = $member['level2'];

		$data['level3'] = $member['level3'];

		$data['rcode'] = $member['rcode'];

		$data['avatar'] = $member['avatar']? $member['avatar']:tomedia('../addons/wx_shop/static/images/noface.png');

		$data['nickname'] = $member['nickname'];



		show_json(1,$data);

	}



	public function commission_log() //佣金明细

	{

		global $_W;

		global $_GPC;



		$openid = trim($_GPC['openid']);

		$list = pdo_fetchall('select money,FROM_UNIXTIME(createtime,"%Y-%m-%d") as day,createtime from '.tablename('wx_shop_member_log').' where openid = :openid and rechargetype = :rechargetype',array(':openid'=>$openid,':rechargetype'=>'yongjin'));



		$data = array();

		foreach($list as $key=>$val){

			$data[$val['day']]['day'] = date('Y-m-d H:i:s',$val['createtime']);

			$data[$val['day']]['commission'] += $val['money'];

		}

		$data = array_values($data);

		show_json(1, array('list' => $data, 'pagesize' => $psize, 'total' => $ordercount));

	}



	public function chatrecord() //聊天记录

	{

		global $_W;

		global $_GPC;

		$kefu = pdo_fetch('select id,name,images,info from ' .tablename('wx_shop_customer_service_set'). ' where uniacid =:uniacid and id = 1',array(':uniacid'=>$_W['uniacid']));

		// $list 	= pdo_fetchall('select * from ' . tablename('wx_shop_red_paper_kefu') . ' where 1 '. $condition .' order by id asc '. $limit ,array(':uniacid'=>$_W['uniacid']));

		// foreach ($list as $key => $val) {

		// 	$list[$key]['text'] = htmlspecialchars_decode($val['text']);

		// }

		$member 	= $this->member;

		$suppid 	= $kefu['id'];

		$img 		= '../attachment/'.$kefu['images'];

		$name 		= $kefu['name'];

		$myname     = $member['nickname'];

		$myavatar   = $member['avatar'];

		$mid 		= $member['id'];

		$lists 	=	pdo_fetchall('select id,suppid,mid,images,text,createtime,type,source from ' .tablename('wx_shop_customer_service_chat'). ' where uniacid =:uniacid and suppid =:suppid and mid = :mid order by id desc limit 30',array(':uniacid'=>$_W['uniacid'],':suppid'=>$suppid,':mid'=>$mid));

		$lists  =  array_reverse($lists);

		foreach ($lists as $key => $val) {

			$lists[$key]['createtime'] = date('Y-m-d H:i:s',$val['createtime']);

			$lists[$key]['types'] = $val['source'];

			$lists[$key]['source'] = $val['type'];

			if($val['images']){

			$lists[$key]['images'] = trim($_W['siteroot'] .'/attachment/'.$val['images']);



			}





		}



		if($lists){

			show_json(1,array('data'=>$lists));

		}else{

			show_json(0,"暂无聊天记录");

		}

		

	}

	

	public function chattosay() //储存聊天记录

	{    

		global $_W;

		global $_GPC;

		// if($_W['isajax']){

			$member = $this->member;

			$suppid = 1;

			$mid    = intval($member['id']);

			$text   = trim($_GPC['text']);

			$images = trim($_GPC['images']);

			$type   = intval($_GPC['type']);

			if($type == 1){

				if(empty($text)){

					show_json(0,'请填写内容');

				}

			}else if($type == 2){

				if(empty($images)){

					show_json(0,'请上传图片');

				}

			}



			$isid = pdo_fetch('select id from ' .tablename('wx_shop_customer_service_sign'). ' where suppid = :suppid and mid = :mid and uniacid =:uniacid',array(':mid'=>$mid,':suppid'=>$suppid,':uniacid'=>$_W['uniacid']));

			$kefu = pdo_fetch('select name,images,info from ' .tablename('wx_shop_customer_service_set'). ' where uniacid =:uniacid and id = 1',array(':uniacid'=>$_W['uniacid']));



			if(empty($isid['id'])){

				$data = array(

					'uniacid' 	=>  $_W['uniacid'],

					'suppid'	=>  $suppid,

					'mid'		=>  $mid,

					'suppread'  =>  1,

					'midread'	=>  0,

					'createtime'		=>  time(),

					'speaktime'	=>  time(),

				);

				pdo_insert('wx_shop_customer_service_sign',$data);

			}else{

				$data = array(

					'suppread' => 1,

					'speaktime' => time(),

				);

				pdo_update('wx_shop_customer_service_sign',$data,array('suppid'=>$suppid,'mid'=>$mid));

			}

			$insert = array(

				'uniacid' 	=> $_W['uniacid'],

				'suppid'	=> $suppid,

				'mid'		=> $mid,

				'images'	=> $images,

				'text'		=> $text,

				'createtime'=> time(),

				'type'		=> $type,

				'source'	=> 2,



			);

			pdo_insert('wx_shop_customer_service_chat',$insert);

			$insertd = array(

				'uniacid' 	=> $_W['uniacid'],

				'suppid'	=> $suppid,

				'mid'		=> $mid,

				'images'	=> $images,

				'text'		=> $text,

				'createtime'=> date('Y-m-d H:i:s',time()),

				'type'		=> 2,

				'source'	=> $type,

				'avatar'	=> $member['avatar'],

				'name' => $member['nickname'],

			);

			if($insertd['images']){

			$insertd['images'] = trim($_W['siteroot'] .'/attachment/'.$images);



			}



			show_json(1,array('data'=>$insertd));

		// }

	}



	public function credit()   //余额明细

	{

		global $_W;

		global $_GPC;

		$openid  = trim($_GPC['openid']);

		$member = $this->member;

		$list = pdo_fetchall('select * from '.tablename('wx_shop_member_credit_log').' where openid = :openid and uniacid = :uniacid order by createtime desc',array(':openid'=>$openid,':uniacid'=>$_W['uniacid']));



		foreach($list as $key => $val){

			if($val['type'] == 1){

				$list[$key]['type'] = '消费';

			}else if($val['type'] == 2){

				$list[$key]['type'] = '返还商品金额';

			}else{

				$list[$key]['type'] = '返还佣金';

			}

			$list[$key]['createtime'] = date('Y-m-d H:i:s',$val['createtime']);



		}

		show_json(1,array('list'=>$list));



	}



	public function mobile()  //修改绑定手机

	{

		global $_W;

		global $_GPC;

		@session_start();

		$openid = trim($_GPC['openid']);

		$member =  $this->member;

		$mobile = trim($_GPC['mobile']);

		$verifycode = trim($_GPC['verifycode']);

		$pwd = trim($_GPC['pwd']);

		$confirm = intval($_GPC['confirm']);

		$key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;

		// if (!(isset($_SESSION[$key])) || ($_SESSION[$key] !== $verifycode) || !(isset($_SESSION['verifycodesendtime'])) || (($_SESSION['verifycodesendtime'] + 600) < time())) 

		// {

		// 	show_json(0, '验证码错误或已过期');

		// }

		$member2 = pdo_fetch('select * from ' . tablename('wx_shop_member') . ' where mobile=:mobile and uniacid=:uniacid and mobileverify=1 limit 1', array(':mobile' => $mobile, ':uniacid' => $_W['uniacid']));

		if (empty($member2)) 

		{

			$salt = m('account')->getSalt();

			$data = array('mobile' => $mobile, 'pwd' => md5($pwd . $salt), 'salt' => $salt, 'mobileverify' => 1);

			if (!(empty($_GPC['realname']))) 

			{

				$data['realname'] = trim($_GPC['realname']);

			}

			if (!(empty($_GPC['birthyear']))) 

			{

				$data['birthyear'] = trim($_GPC['birthyear']);

				$data['birthmonth'] = trim($_GPC['birthmonth']);

				$data['birthday'] = trim($_GPC['birthday']);

			}

			if (!(empty($_GPC['idnumber']))) 

			{

				$data['idnumber'] = trim($_GPC['idnumber']);

			}

			if (!(empty($_GPC['bindwechat']))) 

			{

				$data['weixin'] = trim($_GPC['bindwechat']);

			}

			m('bind')->update($member['id'], $data);



			unset($_SESSION[$key]);

			m('account')->setLogin($member['id']);

			if (empty($member['mobileverify'])) 

			{

				m('bind')->sendCredit($member);

			}

			if (p('task')) 

			{

				p('task')->checkTaskReward('member_info', 1, $openid);

			}

			if (p('task')) 

			{

				p('task')->checkTaskProgress(1, 'info_phone');

			}

			show_json(1, 'bind success (0)');

		}

		if ($member['id'] == $member2['id']) 

		{

			show_json(0, '此手机号已与当前账号绑定');

		}

		if (m('bind')->iswxm($member) && m('bind')->iswxm($member2)) 

		{

			if ($confirm) 

			{

				$salt = m('account')->getSalt();

				m('bind')->update($member['id'], array('mobile' => $mobile, 'pwd' => md5($pwd . $salt), 'salt' => $salt, 'mobileverify' => 1));

				m('bind')->update($member2['id'], array('mobileverify' => 0));

				unset($_SESSION[$key]);

				m('account')->setLogin($member['id']);

				if (p('task')) 

				{

					p('task')->checkTaskReward('member_info', 1, $openid);

				}

				if (p('task')) 

				{

					p('task')->checkTaskProgress(1, 'info_phone');

				}

				show_json(1, 'bind success (1)');

			}

			else 

			{

				show_json(-1, '<center>此手机号已与其他帐号绑定<br>如果继续将会解绑之前帐号<br>确定继续吗？</center>');

			}

		}

		if (!(m('bind')->iswxm($member2))) 

		{

			if ($confirm) 

			{

				$result = m('bind')->merge($member2, $member);

				if (empty($result['errno'])) 

				{

					show_json(0, $result['message']);

				}

				$salt = m('account')->getSalt();

				m('bind')->update($member['id'], array('mobile' => $mobile, 'pwd' => md5($pwd . $salt), 'salt' => $salt, 'mobileverify' => 1));

				unset($_SESSION[$key]);

				m('account')->setLogin($member['id']);

				if (p('task')) 

				{

					p('task')->checkTaskReward('member_info', 1, $openid);

				}

				if (p('task')) 

				{

					p('task')->checkTaskProgress(1, 'info_phone');

				}

				show_json(1, 'bind success (2)');

			}

			else 

			{

				show_json(-1, '<center>此手机号已通过其他方式注册<br>如果继续将会合并账号信息<br>确定继续吗？</center>');

			}

		}

		if (!(m('bind')->iswxm($member))) 

		{

			if ($confirm) 

			{

				$result = m('bind')->merge($member, $member2);

				if (empty($result['errno'])) 

				{

					show_json(0, $result['message']);

				}

				$salt = m('account')->getSalt();

				m('bind')->update($member2['id'], array('mobile' => $mobile, 'pwd' => md5($pwd . $salt), 'salt' => $salt, 'mobileverify' => 1));

				unset($_SESSION[$key]);

				m('account')->setLogin($member2['id']);

				if (p('task')) 

				{

					p('task')->checkTaskReward('member_info', 1, $openid);

				}

				if (p('task')) 

				{

					p('task')->checkTaskProgress(1, 'info_phone');

				}

				show_json(1, 'bind success (3)');

			}

			else 

			{

				show_json(-1, '<center>此手机号已通过其他方式注册<br>如果继续将会合并账号信息<br>确定继续吗？</center>');

			}

		}



	}

	public function updapwd(){//修改密码
		global $_W;
		global $_GPC;

		$jpwd = $_GPC['jpwd'];

		$pwd1 = $_GPC['pwd1'];

		$pwd2 = $_GPC['pwd2'];

		$openid = $_GPC['openid'];

		$member = pdo_fetch('SELECT id,pwd,salt FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND openid=:openid ',[':uniacid'=>$_W['uniacid'],':openid'=>$openid]);

		$salt = $member['salt'];
		if (empty($salt)) 
		{
			$salt = m('account')->getSalt();
		}	

      	if(md5($jpwd.$salt) != $member['pwd']){

      		show_json(0,'旧密码不正确');
      	}

        if(md5($pwd1.$salt) != md5($pwd2.$salt)){

        	show_json(0,'两次密码不一致');
        }

        pdo_update('wx_shop_member',['pwd'=>md5($pwd1.$salt)],['uniacid'=>$_W['uniacid'],'openid'=>$openid]);

        show_json(1,'修改密码成功');

	}		

	public function changepwd()	 //修改取款密码

	{ 	

		global $_W;

		global $_GPC;

		$member = $this->member;

		$mobile = trim($_GPC['mobile']);

		$openid = $_GPC['openid'];

		$verifycode = trim($_GPC['verifycode']);

		$pwd1 = trim($_GPC['pwd1']);

		$pwd2 = trim($_GPC['pwd2']);

		if($pwd1 != $pwd2){

			show_json(0,'两次密码不一致');
		}


		@session_start();

		$member = pdo_fetch('select id,openid,mobile,pwd,salt,credit1,credit2, createtime from ' . tablename('wx_shop_member') . ' where mobile=:mobile and uniacid=:uniacid and mobileverify=1 limit 1', array(':mobile' => $mobile, ':uniacid' => $_W['uniacid']));


		if (!$member) {
			show_json(0,'手机号不正确');
		}
	
		// $key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;

		// if (!(isset($_SESSION[$key])) || ($_SESSION[$key] !== $verifycode) || !(isset($_SESSION['verifycodesendtime'])) || (($_SESSION['verifycodesendtime'] + 600) < time())) 

		// {

		// 	show_json(0, '验证码错误或已过期!');

		// }

		$salt = $member['salt'];
		if (empty($salt)) 
		{
			$salt = m('account')->getSalt();
		}

		pdo_update('wx_shop_member', array('pwd2' => md5($pwd2 . $salt), 'salt' => $salt, 'mobileverify' => 1), array('openid' => $openid, 'uniacid' => $_W['uniacid']));

		unset($_SESSION[$key]);

		show_json(1,' 修改密码成功');

	}

	public function about(){

		global $_W;

		global $_GPC;

		$data = m('common')->getSysset('grabsingle');

		show_json(1,['about'=>$data['about']]);
	}

}