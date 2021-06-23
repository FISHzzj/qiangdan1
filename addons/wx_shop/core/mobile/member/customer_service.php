<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Customer_service_WxShopPage extends MobileLoginPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$kefu = pdo_fetch('select id,name,images,info from ' .tablename('wx_shop_customer_service_set'). ' where uniacid =:uniacid and id = 1',array(':uniacid'=>$_W['uniacid']));
		// $list 	= pdo_fetchall('select * from ' . tablename('wx_shop_red_paper_kefu') . ' where 1 '. $condition .' order by id asc '. $limit ,array(':uniacid'=>$_W['uniacid']));
		// foreach ($list as $key => $val) {
		// 	$list[$key]['text'] = htmlspecialchars_decode($val['text']);
		// }
		$member 	= m('member')->getMember($_W['openid']);
		$suppid 	= $kefu['id'];
		$img 		= '../attachment/'.$kefu['images'];
		$name 		= $kefu['name'];
		$myname     = $member['nickname'];
		$myavatar   = $member['avatar'];
		$mid 		= $member['id'];
		$lists 	=	pdo_fetchall('select id,suppid,mid,images,text,createtime,type,source from ' .tablename('wx_shop_customer_service_chat'). ' where uniacid =:uniacid and suppid =:suppid and mid = :mid order by id desc limit 30',array(':uniacid'=>$_W['uniacid'],':suppid'=>$suppid,':mid'=>$mid));
		$lists  =  array_reverse($lists);
		foreach ($lists as $key => $val) {
			$lists[$key]['createtime'] = date('Y-m-d H:i:s');
			if($val['images']){
				$lists[$key]['images'] = trim($_W['siteroot'] .'/attachment/'.$val['images']);
	
				}
		}
		
		include $this->template();
	}
	public function tosay(){
		global $_W;
		global $_GPC;
		if($_W['isajax']){
			$member = m('member')->getMember($_W['openid']);
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
		}
	}	
}


?>