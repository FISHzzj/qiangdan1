<?php 
/**
 * [HaiSheng System] Copyright (c) 2014 012WZ.COM
 * HaiSheng is NOT a free software, it under the license terms, visited http://www.012wz.com/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
$_W['page']['title'] = '高级工具 - 版权设置';
$usergroup = pdo_get('users_group',array('id'=>$_W['user']['groupid']));
if(!$usergroup['domain']){message('抱歉，您不能使用此功能，请联系管理员开通',url('system/welcome',error));}
$setting = pdo_get('agent_copyright',array('uid'=>$_W['uid']));
$settings = $setting ? iunserializer($setting['copyright']) : array();
	if (checksubmit('submit')) {
		$copyright = array(
			'smname' => $_GPC['smname'],
			'sitename' => $_GPC['sitename'],
			'url' => strexists($_GPC['url'], 'http://') ? $_GPC['url'] : "http://{$_GPC['url']}",
			'sitehost' => $_GPC['sitehost'],
			'statcode' => htmlspecialchars_decode($_GPC['statcode']),
			'footerleft' => htmlspecialchars_decode($_GPC['footerleft']),
			'footerright' => htmlspecialchars_decode($_GPC['footerright']),
			'icon' => $_GPC['icon'],
			'ewm' => $_GPC['ewm'],
			'flogo' => $_GPC['flogo'],
			'slides' => iserializer($_GPC['slides']),
			'notice' => $_GPC['notice'],
			'blogo' => $_GPC['blogo'],
			'baidumap' => $_GPC['baidumap'],
			'company' => $_GPC['company'],
			'address' => $_GPC['address'],
			'person' => $_GPC['person'],
			'phone' => $_GPC['phone'],
			'qq' => $_GPC['qq'],
			'email' => $_GPC['email'],
			'keywords' => $_GPC['keywords'],
			'description' => $_GPC['description'],
			'showhomepage' => intval($_GPC['showhomepage']),
		);
		$data = array('uid'=>$_W['uid'],'copyright'=>iserializer($copyright));
		if(empty($setting)){
			pdo_insert('agent_copyright',$data);
		}
		else{
			pdo_update('agent_copyright',$data);
		}
		message('更新设置成功！', url('user/copyright'));
	}


template('user/copyright');