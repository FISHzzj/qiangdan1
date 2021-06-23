<?php
header('Access-Control-Allow-Origin:*'); 

if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_WxShopPage extends MobilePage
{
	protected function getWapSet() 
	{
		global $_W;
		global $_GPC;
		$set = m('common')->getSysset(array('shop', 'wap'));
		$set['wap']['color'] = ((empty($set['wap']['color']) ? '#fff' : $set['wap']['color']));
		$params = array();
		if (!(empty($_GPC['mid']))) 
		{
			$params['mid'] = $_GPC['mid'];
		}
		if (!(empty($_GPC['backurl']))) 
		{
			$params['backurl'] = $_GPC['backurl'];
		}
		$set['wap']['loginurl'] = mobileUrl('account/login', $params);
		$set['wap']['regurl'] = mobileUrl('account/register', $params);
		$set['wap']['forgeturl'] = mobileUrl('account/forget', $params);
		return $set;
	}
	public function login() 
	{
		global $_W;
		global $_GPC;
		// if (is_weixin() || !(empty($_GPC['__wx_shop_member_session_' . $_W['uniacid']])))
		// {	
		// 	if ($_W['ispost']) 
		// 	{
		// 		show_json(0, '已登录');
		// 	}else{
		// 		header('location: ' . mobileUrl());
		// 	}
		// }
		if ($_W['ispost']) 
		{
			$mobile = trim($_GPC['mobile']);
			$pwd = trim($_GPC['pwd']);
			$member = pdo_fetch('select id,openid,mobile,pwd,salt,isblack from ' . tablename('wx_shop_member') . ' where mobile=:mobile and mobileverify=1 and uniacid=:uniacid limit 1', array(':mobile' => $mobile, ':uniacid' => $_W['uniacid']));
			if (empty($member)) 
			{
				show_json(0, '用户不存在');
			}
			if($member['isblack'] == 1){
				show_json(0, '账号已被封号');
			}
			if (md5($pwd . $member['salt']) !== $member['pwd']) 
			{
				show_json(0, '用户或密码错误');
			}
			m('account')->setLogin($member);
			$openided = base64_encode($member['openid']);
			show_json(1, array('message'=>'登录成功','openid'=>$openided));
		}
		$set = $this->getWapSet();
		$backurl = '';
		if (!(empty($_GPC['backurl']))) 
		{
			$backurl = $_W['siteroot'] . 'app/index.php?' . base64_decode(urldecode($_GPC['backurl']));
		}
		$wapset = $_W['shopset']['wap'];
		$sns = $wapset['sns'];
		include $this->template('login', NULL, true);
	}
	public function register() 
	{
		$this->rf(0);
	}
	public function forget() 
	{
		$this->rf(1);
	}
	protected function rf($type) 
	{
		global $_W;
		global $_GPC;
		if (is_weixin() || !(empty($_GPC['__wx_shop_member_session_' . $_W['uniacid']])))
		{
			/*if ($_W['ispost']) 
			{
				show_json(0, '已登录');
			}else{
				header('location: ' . mobileUrl());
			}*/
		}
		
		$sjyqm = pdo_fetch('SELECT rcode FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND id=:id ',[':uniacid'=>$_W['uniacid'],':id'=>$_GPC['mid']]);
		
		$mid = $_GPC['mid']; 

		if ($_W['ispost']) 
		{
			$mobile = trim($_GPC['mobile']);
			$verifycode = trim($_GPC['verifycode']);
			$pwd = trim($_GPC['pwd']);
			$pwd2 = trim($_GPC['pwd2']);
			$invitcode = trim($_GPC['invitcode']);
			$name = trim($_GPC['name']);

			if(!$sjyqm){

				$sjyqm = pdo_fetch('SELECT id,rcode FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND rcode=:rcode ',[':uniacid'=>$_W['uniacid'],':rcode'=>$_GPC['invitcode']]);

				$mid = $sjyqm['id']; 

			}

			if (empty($mobile)) 
			{
				show_json(0, '请输入正确的手机号');
			}
			/*if (empty($verifycode)) 
			{
				show_json(0, '请输入验证码');
			}*/
			if (empty($pwd)) 
			{
				show_json(0, '请输入密码');
			}
			if (empty($pwd2) and $type == 0) 
			{
				show_json(0, '请输入资金密码');
			}
			$memberall = pdo_fetchcolumn('select count(*) from '. tablename('wx_shop_member'));
			if($memberall>0 and $type == 0){
				if (empty($invitcode)) 
				{
					show_json(0, '请输入上级推荐码');
				}
				if($invitcode){
					$icode_check = pdo_fetch('select id,openid from ' . tablename('wx_shop_member') . 'where rcode = :rcode and status = 1 and isagent= 1 and isblack = 0',array(':rcode'=>$invitcode));
					if(!$icode_check){
						show_json(0, '上级推荐码不存在');
					}
				}
			}
			/*$key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;
			if (!(isset($_SESSION[$key])) || ($_SESSION[$key] !== $verifycode) || !(isset($_SESSION['verifycodesendtime'])) || (($_SESSION['verifycodesendtime'] + 600) < time())) 
			{
				show_json(0, '验证码错误或已过期!');
			}*/
			// $rcode = m('common')->rand_str(6,0,1,'member','rcode');  //推荐码
			$rcode = rand(100000,999999);  //推荐码
			$member = pdo_fetch('select id,openid,mobile,pwd,salt from ' . tablename('wx_shop_member') . ' where mobile=:mobile and mobileverify=1 and uniacid=:uniacid limit 1', array(':mobile' => $mobile, ':uniacid' => $_W['uniacid']));
			if (empty($type)) 
			{
				if (!(empty($member))) 
				{
					show_json(0, '此手机号已注册, 请直接登录');
				}
				$salt = ((empty($member) ? '' : $member['salt']));
				if (empty($salt)) 
				{
					$salt = m('account')->getSalt();
				}
				$openid = ((empty($member) ? '' : $member['openid']));
				$nickname = ((empty($member) ? '' : $member['nickname']));
				if (empty($openid)) 
				{
					$openid = 'wap_user_' . $_W['uniacid'] . '_' . $mobile;
					$nickname = substr($mobile, 0, 3) . 'xxxx' . substr($mobile, 7, 4);
				}
				$avatar = pdo_fetch('SELECT id,avatar FROM'.tablename('6925_avatar').'WHERE uniacid=:uniacid order by rand() limit 1',[':uniacid'=>$_W['uniacid']]);

				$bbin = m('common')->getSysset('grabsingle')['bbin'];
				$data = array('uniacid' => $_W['uniacid'], 'mobile' => $mobile,'agentid'=>$mid ,'nickname' => $name,'avatar'=>$avatar['avatar'],'openid' => $openid, 'pwd' => md5($pwd . $salt),'pwd2'=>md5($pwd2.$salt), 'salt' => $salt, 'createtime' => time(), 'mobileverify' => 1, 'comefrom' => 'mobile','rcode'=>$rcode,'credit2'=>$bbin,'bbin'=>$bbin);
			}
			else 
			{
				if (empty($member)) 
				{
					show_json(0, '此手机号未注册');
				}
				$salt = m('account')->getSalt();
				$data = array('salt' => $salt, 'pwd' => md5($pwd . $salt));
			}
			if (empty($member)) 
			{	
				// pdo_insert('wx_shop_member', $data);
				if(pdo_insert('wx_shop_member', $data)){
					pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$openid,'orderid'=>0,'money'=>$bbin,'type'=>4,'createtime'=>time()));
				}
			}
			else 
			{
				pdo_update('wx_shop_member', $data, array('id' => $member['id']));
			}
			if (p('commission')) 
			{
				p('commission')->checkAgent($openid,$icode_check['id']);
			}
			unset($_SESSION[$key]);
			show_json(1, (empty($type) ? '注册成功' : '密码重置成功'));
		}
		$sendtime = $_SESSION['verifycodesendtime'];
		if (empty($sendtime) || (($sendtime + 60) < time())) 
		{
			$endtime = 0;
		}
		else 
		{
			$endtime = 60 - time() - $sendtime;
		}
		$set = $this->getWapSet();
		include $this->template('rf', NULL, true);
	}
	public function logout() 
	{
		global $_W;
		global $_GPC;
		$key = '__wx_shop_member_session_' . $_W['uniacid'];
		isetcookie($key, false, -100);
		if ($_W['ispost']) 
			{
				show_json(0, '退出成功');
			}else{
				header('location: ' . mobileUrl());
			}
		//header('location: ' . mobileUrl());
		exit();
	}
	public function sns() 
	{
		global $_W;
		global $_GPC;
		if (is_weixin() || !(empty($_GPC['__wx_shop_member_session_' . $_W['uniacid']])))
		{
			if ($_W['ispost']) 
			{
				show_json(0, '已登录');
			}else{
				header('location: ' . mobileUrl());
			}
		}
		$sns = trim($_GPC['sns']);
		if ($_W['ispost'] && !(empty($sns)) && !(empty($_GPC['openid']))) 
		{
			m('member')->checkMemberSNS($sns);
		}
		if ($_GET['openid']) 
		{
			if ($sns == 'qq') 
			{
				$_GET['openid'] = 'sns_qq_' . $_GET['openid'];
			}
			if ($sns == 'wx') 
			{
				$_GET['openid'] = 'sns_wx_' . $_GET['openid'];
			}
			m('account')->setLogin($_GET['openid']);
		}
		$backurl = '';
		if (!(empty($_GPC['backurl']))) 
		{
			$backurl = $_W['siteroot'] . 'app/index.php?' . base64_decode(urldecode($_GPC['backurl']));
		}
		$backurl = ((empty($backurl) ? mobileUrl(NULL, NULL, true) : trim($backurl)));
		header('location: ' . $backurl);
	}
	public function verifycode() 
	{
		global $_W;
		global $_GPC;
		@session_start();
		$set = $this->getWapSet();
		$mobile = trim($_GPC['mobile']);
		$temp = trim($_GPC['temp']);
		$imgcode = trim($_GPC['imgcode']);
		if (empty($mobile)) 
		{
			show_json(0, '请输入手机号');
		}
		if (empty($temp)) 
		{
			show_json(0, '参数错误');
		}
		if (!(empty($_SESSION['verifycodesendtime'])) && (time() < ($_SESSION['verifycodesendtime'] + 60))) 
		{
			show_json(0, '请求频繁请稍后重试');
		}
		if (!(empty($set['wap']['smsimgcode']))) 
		{
			if (empty($imgcode)) 
			{
				show_json(0, '请输入图形验证码');
			}
			$imgcodehash = md5(strtolower($imgcode) . $_W['config']['setting']['authkey']);
			if ($imgcodehash != trim($_GPC['__code'])) 
			{
				show_json(-1, '请输入正确的图形验证码');
			}
		}
		$member = pdo_fetch('select id,openid,mobile,pwd,salt from ' . tablename('wx_shop_member') . ' where mobile=:mobile and mobileverify=1 and uniacid=:uniacid limit 1', array(':mobile' => $mobile, ':uniacid' => $_W['uniacid']));
		if (($temp == 'sms_forget') && empty($member)) 
		{
			show_json(0, '此手机号未注册');
		}
		if (($temp == 'sms_reg') && !(empty($member))) 
		{
			show_json(0, '此手机号已注册，请直接登录');
		}
		$sms_id = $set['wap'][$temp];
		if (empty($sms_id)) 
		{
			show_json(0, '短信发送失败(NOSMSID)');
		}
		$key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;
		@session_start();
		$code = random(5, true);
		$code = '1';
		$shopname = $_W['shopset']['shop']['name'];

		$ret = com('sms')->send($mobile, $sms_id, array('验证码' => $code, '商城名称' => (!(empty($shopname)) ? $shopname : '商城名称')));
		if ($ret['status'])
		{
			$_SESSION[$key] = $code;
			$_SESSION['verifycodesendtime'] = time();
			show_json(1, '短信发送成功');
		}
		show_json(0, $ret['message']);
	}
	
	public function verifycodes() 
	{
		global $_W;
		global $_GPC;
		@session_start();
		$set = $this->getWapSet();
		$mobile = trim($_GPC['mobile']);
		$temp = trim($_GPC['temp']);
		$imgcode = trim($_GPC['imgcode']);
		if (empty($mobile)) 
		{
			show_json(0, '请输入手机号');
		}
		if (empty($temp)) 
		{
			show_json(0, '参数错误');
		}
		if (!(empty($_SESSION['verifycodesendtime'])) && (time() < ($_SESSION['verifycodesendtime'] + 60))) 
		{
			show_json(0, '请求频繁请稍后重试');
		}
		if (!(empty($set['wap']['smsimgcode']))) 
		{
			if (empty($imgcode)) 
			{
				show_json(0, '请输入图形验证码');
			}
			$imgcodehash = md5(strtolower($imgcode) . $_W['config']['setting']['authkey']);
			if ($imgcodehash != trim($_GPC['__code'])) 
			{
				show_json(-1, '请输入正确的图形验证码');
			}
		}
		$member = pdo_fetch('select id,openid,mobile,pwd,salt from ' . tablename('wx_shop_member') . ' where mobile=:mobile and mobileverify=1 and uniacid=:uniacid limit 1', array(':mobile' => $mobile, ':uniacid' => $_W['uniacid']));
	
		
		$sms_id = $set['wap'][$temp];
		if (empty($sms_id)) 
		{
			show_json(0, '短信发送失败(NOSMSID)');
		}
		$key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;
		@session_start();
		$code = random(5, true);
		$shopname = $_W['shopset']['shop']['name'];

		$ret = com('sms')->send($mobile, $sms_id, array('验证码' => $code, '商城名称' => (!(empty($shopname)) ? $shopname : '商城名称')));
		if ($ret['status'])
		{
			$_SESSION[$key] = $code;
			$_SESSION['verifycodesendtime'] = time();
			show_json(1, '短信发送成功');
		}
		show_json(0, $ret['message']);
	}
	// public function verifycodes() 
	// {
	// 	global $_W;
	// 	global $_GPC;
	// 	@session_start();
	// 	$set = $this->getWapSet();
	// 	$mobile = trim($_GPC['mobile']);
	// 	$temp = trim($_GPC['temp']);
	// 	$imgcode = trim($_GPC['imgcode']);
	// 	if (empty($mobile)) 
	// 	{
	// 		show_json(0, '请输入手机号');
	// 	}
	// 	if (empty($temp)) 
	// 	{
	// 		show_json(0, '参数错误');
	// 	}
	// 	if (!(empty($_SESSION['verifycodesendtime'])) && (time() < ($_SESSION['verifycodesendtime'] + 60))) 
	// 	{
	// 		show_json(0, '请求频繁请稍后重试');
	// 	}

	// 	$member = pdo_fetch('select id,openid,mobile,pwd,salt from ' . tablename('wx_shop_member') . ' where mobile=:mobile and mobileverify=1 and uniacid=:uniacid limit 1', array(':mobile' => $mobile, ':uniacid' => $_W['uniacid']));
	// 	if (($temp == 'sms_forget') && empty($member)) 
	// 	{
	// 		show_json(0, '此手机号未注册');
	// 	}
		
	// 	$sms_id = $set['wap'][$temp];
	// 	if (empty($sms_id)) 
	// 	{
	// 		show_json(0, '短信发送失败(NOSMSID)');
	// 	}
	// 	$key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;
	// 	@session_start();
	// 	$code = random(5, true);
	// 	$shopname = $_W['shopset']['shop']['name'];

	// 	$ret = com('sms')->send($mobile, $sms_id, array('验证码' => $code, '商城名称' => (!(empty($shopname)) ? $shopname : '商城名称')));
	// 	if ($ret['status'])
	// 	{
	// 		$_SESSION[$key] = $code;
	// 		$_SESSION['verifycodesendtime'] = time();
	// 		show_json(1, '短信发送成功');
	// 	}
	// 	show_json(0, $ret['message']);
	// }
}
?>