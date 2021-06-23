<?php

if (!(defined('IN_IA'))) 

{

	exit('Access Denied');

}

class Customer_chat_WxShopPage extends WebPage 

{

	public function main() 

	{

		global $_W;

		global $_GPC;

		$suppid 	= 1;

		$suppname   = '客服';

		$mid 		= 4004; 

		$pindex 	= max(1, intval($_GPC['page']));

		$psize 		= 20;

		$list = pdo_fetchall('select c.id,m.id as mid,m.nickname as mnickname,m.avatar as mavatar,c.suppid from ' .tablename('wx_shop_customer_service_sign'). ' as c left join '.tablename('wx_shop_member').' as m on m.id = c.mid where c.suppid = :suppid and c.uniacid =:uniacid order by c.suppread desc,c.speaktime desc',array(':uniacid'=>$_W['uniacid'],':suppid'=>$suppid));

		$ones	= array();

		$kefu = pdo_fetch('select name,images,info from ' .tablename('wx_shop_customer_service_set'). ' where uniacid =:uniacid and id = 1',array(':uniacid'=>$_W['uniacid']));

		if($list){

			$mid 	=  $list[0]['mid'];

			$name   =  $list[0]['mnickname'];

			$avatar =  $list[0]['mavatar'];

			$lists 	=	pdo_fetchall('select id,suppid,mid,images,text,createtime,type,source from ' .tablename('wx_shop_customer_service_chat'). ' where uniacid =:uniacid and suppid =:suppid and mid = :mid order by id desc limit 30',array(':uniacid'=>$_W['uniacid'],':suppid'=>$suppid,':mid'=>$mid));

			$lists  =  array_reverse($lists);

			foreach ($lists as $key => $val) {

				$lists[$key]['createtime'] = date('Y-m-d H:i:s');

			}

		}

		load()->func('tpl');

		include $this->template();

	}

	public function getlist(){

		global $_W;

		global $_GPC;

		if($_W['isajax']){

			$suppid = 1;

			$mid    = intval($_GPC['mid']);

			$kefu = pdo_fetch('select name,images,info from ' .tablename('wx_shop_customer_service_set'). ' where uniacid =:uniacid and id = 1',array(':uniacid'=>$_W['uniacid']));

			$member = pdo_fetch('select nickname,avatar from '.tablename('wx_shop_member').' where id = :mid and uniacid = :uniacid',array(':mid'=>$mid,':uniacid'=>$_W['uniacid']));

			$lists 	=	pdo_fetchall('select id,suppid,mid,images,text,createtime,type,source from ' .tablename('wx_shop_customer_service_chat'). ' where uniacid =:uniacid and suppid =:suppid and mid = :mid order by id desc limit 30',array(':uniacid'=>$_W['uniacid'],':suppid'=>$suppid,':mid'=>$mid));

			$lists  =  array_reverse($lists);

			foreach ($lists as $key => $val) {

				if($val['source'] == 1){

					$lists[$key]['avatar'] = tomedia($kefu['images']);

					$lists[$key]['name'] = $kefu['name'];

				}else{
					
					$lists[$key]['avatar'] = tomedia($member['avatar']);

					$lists[$key]['name'] = $member['nickname'];
				}
				

				$lists[$key]['createtime'] = date('Y-m-d H:i:s',$val['createtime']);

				if($val['images']){
					$lists[$key]['images'] = trim($_W['siteroot'] .'/attachment/'.$val['images']);
		
					}
			}

			show_json(1,array('list'=>$lists));

		}

	}

	public function tosay(){

		global $_W;

		global $_GPC;

		if($_W['isajax']){

			$suppid = 1;

			$mid    = intval($_GPC['mid']);

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

			$ismember = pdo_fetch('select id from ' .tablename('wx_shop_member').' where uniacid =:uniacid and id = :mid',array(':uniacid'=>$_W['uniacid'],':mid'=>$mid));

			if(empty($ismember['id'])){

				show_json(0,'没有该会员');

			}

			$isid = pdo_fetch('select id from ' .tablename('wx_shop_customer_service_sign'). ' where suppid = :suppid and mid = :mid and uniacid =:uniacid',array(':mid'=>$mid,':suppid'=>$suppid,':uniacid'=>$_W['uniacid']));

			$kefu = pdo_fetch('select name,images,info from ' .tablename('wx_shop_customer_service_set'). ' where uniacid =:uniacid and id = 1',array(':uniacid'=>$_W['uniacid']));

			if(empty($isid['id'])){

				$data = array(

					'uniacid' 	=>  $_W['uniacid'],

					'suppid'	=>  $suppid,

					'mid'		=>  $mid,

					'suppread'  =>  0,

					'midread'	=>  1,

					'createtime'		=>  time(),

					'speaktime'	=>  time(),

				);

				pdo_insert('wx_shop_customer_service_sign',$data);

			}else{

				$data = array(

					'midread' => 1,

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

				'source'	=> 1,

			);

			pdo_insert('wx_shop_customer_service_chat',$insert);

			$insertd = array(

				'uniacid' 	=> $_W['uniacid'],

				'suppid'	=> $suppid,

				'mid'		=> $mid,

				'images'	=> $images,

				'text'		=> $text,

				'createtime'=> date('Y-m-d H:i:s',time()),

				'type'		=> 1,

				'source'	=> $type,

				'avatar'	=> tomedia($kefu['images']),

				'name'	=> $kefu['name'],

			);
			if($insertd['images']){
				$insertd['images'] = trim($_W['siteroot'] .'/attachment/'.$images);
	
				}
			show_json(1,array('data'=>$insertd));

		}

	}	

}

?>