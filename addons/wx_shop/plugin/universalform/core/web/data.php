<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Data_WxShopPage extends PluginWebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$typeid = $_GPC['typeid'];

		if (empty($typeid)) {
			$this->message('Url参数错误！请重试！', webUrl('universalform/temp'), 'error');
			exit();
		}


		$kw = trim($_GPC['keyword']);
		$page = ((empty($_GPC['page']) ? '' : $_GPC['page']));
		$pindex = max(1, intval($page));
		$psize = 20;
		$type = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_universalform_type') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $typeid, ':uniacid' => $_W['uniacid']));
		$type['fields'] = iunserializer($type['fields']);
		$condition = ' and d.typeid=:typeid and d.uniacid=:uniacid';
		$params = array(':typeid' => $typeid, ':uniacid' => $_W['uniacid']);

		if (!empty($kw)) {
			$condition .= ' and d.fields like :fields';
			$params[':fields'] = '%' . $kw . '%';
		}

		$items = pdo_fetchall('SELECT *  FROM ' . tablename('wx_shop_universalform_data') . ' d ' . ' where 1 ' . $condition . ' order by id desc limit ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_universalform_data') . ' d ' . ' where 1 ' . $condition . ' ', $params);
		$pager = pagination($total, $pindex, $psize);
		include $this->template();
	}
}


?>