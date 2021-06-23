<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Transactions_WxShopPage extends WebPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);

		$condition = ' and uniacid = :uniacid ';
		$params = array(':uniacid' => $_W['uniacid']);
		if ($_GPC['enabled'] != '') 
		{
			$condition .= ' and enabled=' . intval($_GPC['enabled']);
		}
		$list = pdo_fetchall(' select id, day, min, max, income_ratio, enabled from ' . tablename('wx_shop_sd_transactions_set') . ' where 1 ' . $condition . ' order by day asc ', array(':uniacid' => $uniacid));
		include $this->template();
	}
	public function add() 
	{
		$this->post();
	}
	public function edit() 
	{
		$this->post();
	}
	protected function post() 
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$id = trim($_GPC['id']);
		$ransactions = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_sd_transactions_set') . ' WHERE id=:id and uniacid=:uniacid limit 1', array(':uniacid' => $uniacid, ':id' => intval($id)));

		if ($_W['ispost']) {
			$data = array(
				'day' 			=> intval($_GPC['day']),
				'min' 			=> floatval($_GPC['min']),
				'max' 			=> floatval($_GPC['max']),
				'income_ratio'  => floatval($_GPC['income_ratio']),
				'enabled' 		=> intval($_GPC['enabled']),
			);

			if (!empty($ransactions)) {
				pdo_update('wx_shop_sd_transactions_set', $data, array('id' => $id, 'uniacid' => $uniacid));
			}else {
				$data['uniacid'] = $uniacid;
				pdo_insert('wx_shop_sd_transactions_set', $data);
			}
			show_json(1, array('url' => webUrl('finance/transactions')));
		}

		include $this->template();
	}
	public function delete() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) 
		{
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id FROM ' . tablename('wx_shop_sd_transactions_set') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) 
		{
			pdo_delete('wx_shop_sd_transactions_set', array('id' => $item['id']));
		}
		show_json(1, array('url' => referer()));
	}

	public function enabled() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) 
		{
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id FROM ' . tablename('wx_shop_sd_transactions_set') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		
		foreach ($items as $item ) 
		{
			pdo_update('wx_shop_sd_transactions_set', array('enabled' => intval($_GPC['enabled'])), array('id' => $item['id']));
		}
		show_json(1, array('url' => referer()));
	}
}
?>