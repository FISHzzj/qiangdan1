<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class SystemPage extends WebPage
{
	public function __construct()
	{
		parent::__construct(false);
		global $_W;
		define('IS_WX_SHOP_SYSTEM', true);
		$routes = explode('.', $_W['routes']);
		$_W['current_menu'] = isset($routes[1]) ? $routes[1] : '';

		if (!$_W['isfounder']) {
			$this->message('您无权访问');
		}
	}
}

?>
