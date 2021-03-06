<?php
error_reporting(0);
require '../../../../framework/bootstrap.inc.php';
require '../../../../addons/wx_shop/defines.php';
require '../../../../addons/wx_shop/core/inc/functions.php';
global $_W;
global $_GPC;
$polyapi_plugin = p('polyapi');

if (!($polyapi_plugin)) {
	print_r('没有找到网店管家插件');
	exit();
}


$array = array();
$array['appkey'] = trim($_GPC['appkey']);
$array['bizcontent'] = $_GPC['bizcontent'];
$array['method'] = trim($_GPC['method']);
$array['token'] = trim($_GPC['token']);
$array['sign'] = trim($_GPC['sign']);
$polyapi_plugin->check_request($array);
$key_info = $polyapi_plugin->get_key_info($array);
$array['bizcontent'] = html_entity_decode($array['bizcontent']);

if (empty($key_info)) {
	$polyapi_plugin->errorData('商城未找到appkey和的信息token');
}
 else if (empty($key_info['status'])) {
	$polyapi_plugin->errorData('接口已经关闭,请到商城中开启接口!');
}
 else {
	$polyapi_plugin->check_sign($array, $key_info);
}

$_W['uniacid'] = $key_info['uniacid'];
$array['uniacid'] = $key_info['uniacid'];
$array['bizcontent'] = json_decode($array['bizcontent'], true);

switch ($array['method']) {
case 'Differ.JH.Business.GetOrder':
	$data = $polyapi_plugin->GetOrder($array);
	break;

case 'Differ.JH.Business.CheckRefundStatus':
	$data = $polyapi_plugin->CheckRefundStatus($array);
	break;

case 'Differ.JH.Business.Send':
	$data = $polyapi_plugin->Send($array);
	break;

case 'Differ.JH.Business.DownloadProduct':
	$data = $polyapi_plugin->DownloadProduct($array);
	break;

case 'Differ.JH.Business.SyncStock':
	$data = $polyapi_plugin->SyncStock($array);
	break;

	$polyapi_plugin->errorData('平台不支持此接口', 6);
}

$data = json_encode($data);
echo $data;
exit();

?>