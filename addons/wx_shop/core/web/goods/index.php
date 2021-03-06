<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_WxShopPage extends WebPage
{
	public function main($goodsfrom = 'sale')
	{
		global $_W;
		global $_GPC;

		if (empty($_W['shopversion'])) {
			$goodsfrom = strtolower(trim($_GPC['goodsfrom']));

			if (empty($goodsfrom)) {
				header('location: ' . webUrl('goods', array('goodsfrom' => 'sale')));
			}
		}
		else {
			if (!empty($_GPC['goodsfrom'])) {
				header('location: ' . webUrl('goods/' . $_GPC['goodsfrom']));
			}
		}

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sqlcondition = $groupcondition = '';
		$condition = ' WHERE g.`uniacid` = :uniacid';
		$params = array(':uniacid' => $_W['uniacid']);

		if (!empty($_GPC['keyword'])) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$sqlcondition = ' left join ' . tablename('wx_shop_goods_option') . ' op on g.id = op.goodsid';

			$groupcondition = ' group by g.`id`';
			$condition .= ' AND (g.`id` = :id or g.`title` LIKE :keyword or g.`keywords` LIKE :keyword or g.`goodssn` LIKE :keyword or g.`productsn` LIKE :keyword or op.`title` LIKE :keyword or op.`goodssn` LIKE :keyword or op.`productsn` LIKE :keyword';

			$condition .= ' )';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
			$params[':id'] = $_GPC['keyword'];
		}

		empty($goodsfrom) && $_GPC['goodsfrom'] = $goodsfrom = 'sale';
		$_GPC['goodsfrom'] = $goodsfrom;

		if ($goodsfrom == 'sale') {
			$condition .= ' AND g.`status` > 0 and g.`deleted`=0';
			$status = 1;
		}
		else if ($goodsfrom == 'stock') {
			$status = 0;
			$condition .= ' AND g.`status` = 0 and g.`deleted`=0';
		}
		else if ($goodsfrom == 'cycle') {
			$status = 0;
			$condition .= ' AND g.`deleted`=1';
		}

		$sql = 'SELECT g.id FROM ' . tablename('wx_shop_goods') . 'g' . $sqlcondition . $condition . $groupcondition;
		$total_all = pdo_fetchall($sql, $params);
		$total = count($total_all);
		unset($total_all);

		if (!empty($total)) {
			$sql = 'SELECT g.* FROM ' . tablename('wx_shop_goods') . 'g' . $sqlcondition . $condition . $groupcondition . " ORDER BY g.`status` DESC, g.`displayorder` DESC,\r\n                g.`id` DESC LIMIT " . (($pindex - 1) * $psize) . ',' . $psize;
			$list = pdo_fetchall($sql, $params);

			$hallset = m('common')->getSysset();
			foreach ($list as $key => &$value) {
				$url = mobileUrl('goods/detail', array('id' => $value['id']), true);

				$value['hallname'] = (empty($hallset['shop']['levelname']) ? '????????????' : $hallset['shop']['levelname']);
				$hallname = pdo_fetchcolumn(' select levelname from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level = :level ', array(':uniacid' => $_W['uniacid'], ':level' => $value['sd_hall']));
				if(!empty($hallname)){
					$value['hallname'] = $hallname;
				}
			}

			$pager = pagination2($total, $pindex, $psize);
		}

		$goodstotal = intval($_W['shopset']['shop']['goodstotal']);
		include $this->template('goods');
	}

	public function sale()
	{
		$this->main('sale');
	}

	public function stock()
	{
		$this->main('stock');
	}

	public function cycle()
	{
		$this->main('cycle');
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
		require dirname(__FILE__) . '/post.php';
	}

	public function delete()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);

		if (empty($id)) {
			$id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
		}

		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('wx_shop_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

		foreach ($items as $item) {
			pdo_update('wx_shop_goods', array('deleted' => 1), array('id' => $item['id']));
			plog('goods.delete', '???????????? ID: ' . $item['id'] . ' ????????????: ' . $item['title'] . ' ');
		}

		show_json(1, array('url' => referer()));
	}

	public function status()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);

		if (empty($id)) {
			$id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
		}
		else {
			pdo_update('wx_shop_goods', array('newgoods' => 0), array('id' => $id));
		}

		$items = pdo_fetchall('SELECT id,title,status,isstatustime,statustimestart,statustimeend FROM ' . tablename('wx_shop_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

		foreach ($items as $item) {
			if (0 < $item['isstatustime']) {
				if ((0 < intval($_GPC['status'])) && ($item['statustimestart'] < time()) && (time() < $item['statustimeend'])) {
				}
				else {
					show_json(0, '?????? [' . $item['title'] . '] ??????????????????????????????');
				}
			}

			pdo_update('wx_shop_goods', array('status' => intval($_GPC['status'])), array('id' => $item['id']));
			plog('goods.edit', ('??????????????????<br/>ID: ' . $item['id'] . '<br/>????????????: ' . $item['title'] . '<br/>??????: ' . $_GPC['status']) == 1 ? '??????' : '??????');
		}

		show_json(1, array('url' => referer()));
	}

	public function delete1()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);

		if (empty($id)) {
			$id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
		}

		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('wx_shop_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

		foreach ($items as $item) {
			pdo_delete('wx_shop_goods', array('id' => $item['id']));
			plog('goods.edit', '??????????????????????????????<br/>ID: ' . $item['id'] . '<br/>????????????: ' . $item['title']);
		}

		show_json(1, array('url' => referer()));
	}

	public function restore()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);

		if (empty($id)) {
			$id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
		}

		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('wx_shop_goods') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

		foreach ($items as $item) {
			pdo_update('wx_shop_goods', array('deleted' => 0), array('id' => $item['id']));
			plog('goods.edit', '????????????????????????<br/>ID: ' . $item['id'] . '<br/>????????????: ' . $item['title']);
		}

		show_json(1, array('url' => referer()));
	}

	public function change()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$redis = redis();
		if (empty($id)) {
			show_json(0, array('message' => '????????????'));
		}
		else {
			pdo_update('wx_shop_goods', array('newgoods' => 0), array('id' => $id));
		}

		$type = trim($_GPC['type']);
		$value = trim($_GPC['value']);

		if (!in_array($type, array('title', 'marketprice', 'total', 'goodssn', 'productsn', 'displayorder', 'dowpayment'))) {
			show_json(0, array('message' => '????????????'));
		}

		$goods = pdo_fetch('select id,hasoption,marketprice,dowpayment from ' . tablename('wx_shop_goods') . ' where id=:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));

		if (empty($goods)) {
			show_json(0, array('message' => '????????????'));
		}

		if ($type == 'dowpayment') {
			if ($goods['marketprice'] < $value) {
				show_json(0, array('message' => '????????????????????????'));
			}
		}
		else {
			if ($type == 'marketprice') {
				if ($value < $goods['dowpayment']) {
					show_json(0, array('message' => '????????????????????????'));
				}
			}
		}

		pdo_update('wx_shop_goods', array($type => $value), array('id' => $id));
		$goodsid =  $redis->lRange('goodsid_5812',0,-1);
		if(!in_array($id,$goodsid)){
			$redis->lPush('goodsid_5812',$id);
		}
		$redis->set('goods_'.$id,$value);
		if ($goods['hasoption'] == 0) {
			$sql = 'update ' . tablename('wx_shop_goods') . ' set minprice = marketprice,maxprice = marketprice where id = ' . $goods['id'] . ' and hasoption=0;';
			pdo_query($sql);
		}

		show_json(1);
	}

	public function tpl()
	{
		global $_GPC;
		global $_W;
		$tpl = trim($_GPC['tpl']);

		if ($tpl == 'option') {
			$tag = random(32);
			include $this->template('goods/tpl/option');
		}
		else if ($tpl == 'spec') {
			$spec = array('id' => random(32), 'title' => $_GPC['title']);
			include $this->template('goods/tpl/spec');
		}
		else if ($tpl == 'specitem') {
			$spec = array('id' => $_GPC['specid']);
			$specitem = array('id' => random(32), 'title' => $_GPC['title'], 'show' => 1);
			include $this->template('goods/tpl/spec_item');
		}
		else {
			if ($tpl == 'param') {
				$tag = random(32);
				include $this->template('goods/tpl/param');
			}
		}
	}

	public function query()
	{
		global $_W;
		global $_GPC;
		$kwd = trim($_GPC['keyword']);
		$type = intval($_GPC['type']);
		$live = intval($_GPC['live']);
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$condition = ' and status=1 and deleted=0 and uniacid=:uniacid';

		if (!empty($kwd)) {
			$condition .= ' AND (`title` LIKE :keywords OR `keywords` LIKE :keywords)';
			$params[':keywords'] = '%' . $kwd . '%';
		}

		if (empty($type)) {
			$condition .= ' AND `type` != 10 ';
		}
		else {
			$condition .= ' AND `type` = :type ';
			$params[':type'] = $type;
		}

		$ds = pdo_fetchall('SELECT id,title,thumb,marketprice,productprice,share_title,share_icon,description,minprice,costprice,total,sales,islive,liveprice FROM ' . tablename('wx_shop_goods') . ' WHERE 1 ' . $condition . ' order by createtime desc', $params);
		$ds = set_medias($ds, array('thumb', 'share_icon'));

		if ($_GPC['suggest']) {
			exit(json_encode(array('value' => $ds)));
		}

		include $this->template();
	}

	public function goodsprice()
	{
		global $_W;
		$sql = 'update ' . tablename('wx_shop_goods') . " g set \r\ng.minprice = (select min(marketprice) from " . tablename('wx_shop_goods_option') . " where g.id = goodsid),\r\ng.maxprice = (select max(marketprice) from " . tablename('wx_shop_goods_option') . " where g.id = goodsid)\r\nwhere g.hasoption=1 and g.uniacid=" . $_W['uniacid'] . ";\r\nupdate " . tablename('wx_shop_goods') . ' set minprice = marketprice,maxprice = marketprice where hasoption=0 and uniacid=' . $_W['uniacid'] . ';';
		pdo_run($sql);
		show_json(1);
	}
}

?>
