<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Customer_set_WxShopPage extends WebPage 
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$item = pdo_fetch('select * from '.tablename('wx_shop_customer_service_set').' where id = :id and uniacid = :uniacid order by id asc',array(':id' => 1,':uniacid' => $_W['uniacid']));
		if ($_W['ispost']) 
		{
			$this->post();
		}
		include $this->template();
	}

	protected function post() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('select * from '.tablename('wx_shop_customer_service_set').' where id = :id and uniacid = :uniacid',array(':id' => $id,':uniacid' => $_W['uniacid']));
		if(empty($item)){
			$data = array('id' => $id,'uniacid' => $_W['uniacid'],'name' => trim($_GPC['name']),'images' => trim($_GPC['images']),'info' => html_entity_decode($_GPC['info']),'status' => 1,'createtime' => time());
			pdo_insert('wx_shop_customer_service_set',$data);
		}else{
			$data = array('id' => $id,'uniacid' => $_W['uniacid'],'name' => trim($_GPC['name']),'images' => trim($_GPC['images']),'info' => html_entity_decode($_GPC['info']),'status' => 1);
			pdo_update('wx_shop_customer_service_set',$data,array('id' => $id,'uniacid' => $_W['uniacid']));
		}
		show_json(1, array('url' => webUrl('customer_service.customer_set')));
	}

}
?>