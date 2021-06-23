<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Sd_Test_WxShopPage extends MobilePage
{
	public function main() 
	{
		global $_W;
		$uniacid = intval($_W['uniacid']);
		
		// $sd_model = m('sd_model');
		// $sd_model->upgrade(5109);
	}
}
?>