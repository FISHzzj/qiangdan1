<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
require WX_SHOP_PLUGIN . 'merch/core/inc/page_merch.php';
class Index_WxShopPage extends MerchWebPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$this->model->CheckPlugin('exhelper');
		include $this->template();
	}
}
?>