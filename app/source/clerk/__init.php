<?php
/**
 * [HaiSheng System] Copyright (c) 2015 012WZ.COM
 
 */
defined('IN_IA') or exit('Access Denied');
checkauth();
load()->model('clerk');

$clerk = clerk_check();
if(is_error($clerk)) {
	message('您不是操作店员，没有使用该功能的权限', '', 'error');
}

if($action != 'check') {
	$uid = intval($_GPC['uid']);
	$member = mc_fetch($uid);
	$member['groupname'] = $_W['account']['groups'][$member['groupid']]['title'];
	if(empty($member)) {
		message('用户不存在或已删除', referer(), 'error');
	}
	if($member['uniacid'] != $_W['uniacid']) {
		message('非法操作', referer(), 'error');
	}
}