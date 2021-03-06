<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Setting_WxShopPage extends SystemPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		if ($_W['ispost']) 
		{
			$data = array('uniacid' => $uniacid, 'casebanner' => trim($_GPC['casebanner']), 'background' => trim($_GPC['background']), 'contact' => trim($_GPC['contact']));
			$set = pdo_fetch('select * from ' . tablename('wx_shop_system_setting') . ' where uniacid = :uniacid ', array(':uniacid' => $uniacid));
			if ($set) 
			{
				pdo_update('wx_shop_system_setting', $data, array('id' => $set['id']));
				plog('system.site.setting', '修改基础设置 ID:' . $set['id']);
			}
			else 
			{
				pdo_insert('wx_shop_system_setting', $data);
				$id = pdo_insertid();
				plog('system.site.setting', '添加基础设置 ID:' . $set['id']);
			}
			show_json(1);
		}
		else 
		{
			$item = pdo_fetch('select * from ' . tablename('wx_shop_system_setting') . ' where uniacid = :uniacid ', array(':uniacid' => $uniacid));
			include $this->template();
		}
	}
}
?>