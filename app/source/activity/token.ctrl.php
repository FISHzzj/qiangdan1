<?php
/**
 * [HaiSheng System] Copyright (c) 2014 HaiShengCMS.COM
 
 */
defined('IN_IA') or exit('Access Denied');
$dos = array('display', 'post', 'mine', 'use');
$do = in_array($_GPC['do'], $dos) ? $_GPC['do'] : 'display';
if($do == 'display') {
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM '. tablename('activity_coupon'). " WHERE uniacid = :uniacid AND type = :type AND endtime > :endtime" , array(':uniacid' => $_W['uniacid'], ':type' => 2, ':endtime' => TIMESTAMP));
	$pindex = max(1, intval($_GPC['page']));
	$psize = 10;
	$lists = pdo_fetchall('SELECT couponid,title,thumb,type,credittype,credit,endtime,description FROM ' . tablename('activity_coupon') . " WHERE uniacid = :uniacid AND type = :type AND endtime > :endtime {$condition} ORDER BY endtime ASC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':uniacid' => $_W['uniacid'], ':type' => 2, ':endtime' => TIMESTAMP));
	$pager = pagination($total, $pindex, $psize);
}
if($do == 'post') {
	$id = intval($_GPC['id']);
	$token = activity_token_info($id, $_W['uniacid']);
	if(empty($token)){
		message(error(-1, '没有指定的礼品兑换'), '', 'ajax');
	}
	$credit = mc_credit_fetch($_W['member']['uid'], array($token['credittype']));
	if ($credit[$token['credittype']] < $token['credit']) {
		message(error(-1, "您的 {$creditnames[$token['credittype']]} 数量不够,无法兑换."), '', 'ajax');
	}
	
	$ret = activity_token_grant($_W['member']['uid'], $id, '', '用户使用' . $token['credit'] . $creditnames[$token['credittype']] . '兑换');
	if(is_error($ret)) {
		message($ret, '', 'ajax');
	}
		mc_credit_update($_W['member']['uid'], $token['credittype'], -1 * $token['credit'], array($_W['member']['uid'], '礼品兑换:' . $token['title'] . ' 消耗 ' . $creditnames[$token['credittype']] . ':' . $token['credit']));
		if($token['credittype'] == 'credit1') {
		mc_notice_credit1($_W['openid'], $_W['member']['uid'], -1 * $token['credit'], '兑换代金券消耗积分');
	} else {
		mc_notice_credit2($_W['openid'], $_W['member']['uid'], -1 * $token['credit'], 0, '线上消费，兑换代金券');
	}
	message(error(0, "兑换成功,您消费了 {$token['credit']} {$creditnames[$token['credittype']]}"), '', 'ajax');
}
if($do == 'mine') {
	$psize = 10;
	$pindex = max(1, intval($_GPC['page']));
	$params = array(':uid' => $_W['member']['uid']);
	$filter['used'] = '1';
	$type = 1;
	if($_GPC['type'] == 'used') {
		$filter['used'] = '2';
		$type = 2;
	}
	$coupon = activity_token_owned($_W['member']['uid'], $filter, $pindex, $psize);
	$data = $coupon['data'];
	$total = $coupon['total'];
	unset($coupon);
	$pager = pagination($total , $pindex, $psize);
}
if($do == 'use') {
	$id = intval($_GPC['id']);
	$recid = intval($_GPC['recid']);
	$data = activity_token_owned($_W['member']['uid'], array('couponid' => $id, 'used' => 1));
	$data = $data['data'][$id];
	if(checksubmit('submit')) {
		load()->model('user');
		$password = $_GPC['password'];
		$sql = 'SELECT * FROM ' . tablename('activity_clerks') . " WHERE `uniacid` = :uniacid AND `password` = :password";
		$clerk = pdo_fetch($sql, array(':uniacid' => $_W['uniacid'], ':password' => $password));
		if(!empty($clerk)) {
			$status = activity_token_use($_W['member']['uid'], $id, $clerk['name'], $clerk['id'], '', 'system', 3, $clerk['storeid']);
			if (!is_error($status)) {
				message('代金券使用成功！', url('activity/token/mine', array('type' => $_GPC['type'])), 'success');
			} else {
				message($status['message'], url('activity/token/mine', array('type' => $_GPC['type'])), 'error');
			}
		}
		message('密码错误！', referer(), 'error');
	}
}
template('activity/token');
