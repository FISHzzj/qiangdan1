<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Order_WxShopPage extends PluginWebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$status = $_GPC['status'];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;
		$condition = ' and o.uniacid=:uniacid and o.isverify = 0 ';
		$params = array(':uniacid' => $_W['uniacid']);

		if (intval($status) == 1) {
			$condition .= ' and o.status = :status and (o.success = :success or o.is_team = :is_team)  ';
			$params[':status'] = 1;
			$params[':success'] = 1;
			$params[':is_team'] = 0;
		}
		else if (intval($status) == 2) {
			$condition .= ' and o.status = :status ';
			$params[':status'] = 2;
		}
		else if (intval($status) == 3) {
			$condition .= ' and o.status = :status ';
			$params[':status'] = 0;
		}
		else if (intval($status) == 4) {
			$condition .= ' and o.status = :status ';
			$params[':status'] = 3;
		}
		else {
			if (intval($status) == 5) {
				$condition .= ' and o.status = :status ';
				$params[':status'] = -1;
			}
		}

		if (empty($starttime) || empty($endtime)) {
			$starttime = strtotime('-1 month');
			$endtime = time();
		}

		$searchtime = trim($_GPC['searchtime']);

		if (!empty($searchtime)) {
			$condition .= ' and o.' . $searchtime . 'time > ' . strtotime($_GPC['time']['start']) . ' and o.' . $searchtime . 'time < ' . strtotime($_GPC['time']['end']) . ' ';
			$starttime = strtotime($_GPC['time']['start']);
			$endtime = strtotime($_GPC['time']['end']);
		}

		if (!empty($_GPC['paytype'])) {
			$_GPC['paytype'] = trim($_GPC['paytype']);
			$condition .= ' and o.pay_type = :paytype';
			$params[':paytype'] = $_GPC['paytype'];
		}

		if (!empty($_GPC['searchfield']) && !empty($_GPC['keyword'])) {
			$searchfield = trim(strtolower($_GPC['searchfield']));
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$params[':keyword'] = $_GPC['keyword'];

			if ($searchfield == 'orderno') {
				$condition .= ' AND locate(:keyword,o.orderno)>0 ';
			}
			else if ($searchfield == 'member') {
				$condition .= ' AND (locate(:keyword,m.realname)>0 or locate(:keyword,m.mobile)>0 or locate(:keyword,m.nickname)>0)';
			}
			else if ($searchfield == 'address') {
				$condition .= ' AND ( locate(:keyword,a.realname)>0 or locate(:keyword,a.mobile)>0) ';
			}
			else if ($searchfield == 'expresssn') {
				$condition .= ' AND locate(:keyword,o.expresssn)>0';
			}
			else if ($searchfield == 'goodstitle') {
				$condition .= ' and locate(:keyword,g.title)>0 ';
			}
			else {
				if ($searchfield == 'goodssn') {
					$condition .= ' and locate(:keyword,g.goodssn)>0 ';
				}
			}
		}

		if (empty($_GPC['export'])) {
			$page = 'LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		}

		$list = pdo_fetchall("SELECT o.id,o.orderno,o.status,o.expresssn,o.addressid,o.express,o.remark,o.is_team,o.pay_type,o.isverify,o.refundtime,o.price,o.creditmoney,\r\n\t\t\t\to.freight,o.discount,o.creditmoney,o.createtime,o.success,o.deleted,o.address,o.message,\r\n\t\t\t\tg.title,g.category,g.thumb,g.groupsprice,g.singleprice,g.price as gprice,g.goodssn,m.nickname,m.id as mid,m.realname as mrealname,m.mobile as mmobile,\r\n\t\t\t\ta.realname as arealname,a.mobile as amobile,a.province as aprovince ,a.city as acity , a.area as aarea,a.address as aaddress\r\n\t\t\t\tFROM " . tablename('wx_shop_groups_order') . " as o\r\n\t\t\t\tleft join " . tablename('wx_shop_groups_goods') . " as g on g.id = o.goodid\r\n\t\t\t\tleft join " . tablename('wx_shop_member') . " m on m.openid=o.openid and m.uniacid =  o.uniacid\r\n\t\t\t\tleft join " . tablename('wx_shop_member_address') . " a on a.id=o.addressid\r\n\t\t\t\tWHERE 1 " . $condition . ' GROUP BY o.id  ORDER BY o.createtime DESC ' . $page, $params);

		foreach ($list as $key => $value) {
			if (!empty($value['address'])) {
				$user = unserialize($value['address']);
				$list[$key]['addressdata'] = array('realname' => $user['realname'], 'mobile' => $user['mobile'], 'province' => $user['province'], 'city' => $user['city'], 'area' => $user['area'], 'street' => $user['street'], 'address' => $user['address']);
			}
			else {
				$user = iunserializer($value['addressid']);

				if (!is_array($user)) {
					$user = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_member_address') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $value['addressid'], ':uniacid' => $_W['uniacid']));
				}

				$list[$key]['addressdata'] = array('realname' => $user['realname'], 'mobile' => $user['mobile'], 'province' => $user['province'], 'city' => $user['city'], 'area' => $user['area'], 'street' => $user['street'], 'address' => $user['address']);
			}
		}

		$total = pdo_fetchcolumn('SELECT count(1) FROM ' . tablename('wx_shop_groups_order') . " as o\r\n\t\t\t\tleft join " . tablename('wx_shop_groups_goods') . " as g on g.id = o.goodid\r\n\t\t\t\tleft join " . tablename('wx_shop_member') . " m on m.openid=o.openid and m.uniacid =  o.uniacid\r\n\t\t\t\tleft join " . tablename('wx_shop_member_address') . " a on a.id=o.addressid\r\n\t\t\t\tWHERE 1 " . $condition . ' ', $params);
		$pager = pagination2($total, $pindex, $psize);
		$paytype = array('credit' => '????????????', 'wechat' => '????????????', 'other' => '????????????');
		$paystatus = array(0 => '?????????', 1 => '?????????', 2 => '?????????', 3 => '?????????', -1 => '?????????', 4 => '?????????');

		if ($_GPC['export'] == 1) {
			plog('groups.order.export', '????????????');
			$columns = array(
				array('title' => '????????????', 'field' => 'orderno', 'width' => 24),
				array('title' => '????????????', 'field' => 'nickname', 'width' => 12),
				array('title' => '????????????', 'field' => 'mrealname', 'width' => 12),
				array('title' => 'openid', 'field' => 'openid', 'width' => 30),
				array('title' => '?????????????????????', 'field' => 'mmobile', 'width' => 15),
				array('title' => '????????????(????????????)', 'field' => 'arealname', 'width' => 15),
				array('title' => '????????????', 'field' => 'amobile', 'width' => 12),
				array('title' => '????????????', 'field' => 'aprovince', 'width' => 12),
				array('title' => '', 'field' => 'acity', 'width' => 12),
				array('title' => '', 'field' => 'aarea', 'width' => 12),
				array('title' => '', 'field' => 'street', 'width' => 15),
				array('title' => '', 'field' => 'aaddress', 'width' => 20),
				array('title' => '????????????', 'field' => 'title', 'width' => 30),
				array('title' => '????????????', 'field' => 'goodssn', 'width' => 15),
				array('title' => '?????????', 'field' => 'groupsprice', 'width' => 12),
				array('title' => '?????????', 'field' => 'singleprice', 'width' => 12),
				array('title' => '??????', 'field' => 'price', 'width' => 12),
				array('title' => '????????????', 'field' => 'goods_total', 'width' => 15),
				array('title' => '????????????', 'field' => 'goodsprice', 'width' => 12),
				array('title' => '????????????', 'field' => 'credit', 'width' => 12),
				array('title' => '??????????????????', 'field' => 'creditmoney', 'width' => 12),
				array('title' => '??????', 'field' => 'freight', 'width' => 12),
				array('title' => '?????????', 'field' => 'amount', 'width' => 12),
				array('title' => '????????????', 'field' => 'pay_type', 'width' => 12),
				array('title' => '??????', 'field' => 'status', 'width' => 12),
				array('title' => '????????????', 'field' => 'createtime', 'width' => 24),
				array('title' => '????????????', 'field' => 'paytime', 'width' => 24),
				array('title' => '????????????', 'field' => 'sendtime', 'width' => 24),
				array('title' => '????????????', 'field' => 'finishtime', 'width' => 24),
				array('title' => '????????????', 'field' => 'expresscom', 'width' => 24),
				array('title' => '????????????', 'field' => 'expresssn', 'width' => 24),
				array('title' => '????????????', 'field' => 'message', 'width' => 36),
				array('title' => '????????????', 'field' => 'remark', 'width' => 36)
				);
			$exportlist = array();

			foreach ($list as $key => $value) {
				$r['orderno'] = $value['orderno'];
				$r['nickname'] = str_replace('=', '', $value['nickname']);
				$r['mrealname'] = $value['mrealname'];
				$r['openid'] = $value['openid'];
				$r['mmobile'] = $value['mmobile'];
				$r['arealname'] = $value['addressdata']['realname'];
				$r['amobile'] = $value['addressdata']['mobile'];
				$r['aprovince'] = $value['addressdata']['province'];
				$r['acity'] = $value['addressdata']['city'];
				$r['aarea'] = $value['addressdata']['area'];
				$r['street'] = $value['addressdata']['street'];
				$r['aaddress'] = $value['addressdata']['address'];
				$r['pay_type'] = $paytype['' . $value['pay_type'] . ''];
				$r['freight'] = $value['freight'];
				$r['groupsprice'] = $value['groupsprice'];
				$r['singleprice'] = $value['singleprice'];
				$r['price'] = $value['price'];
				$r['credit'] = !empty($value['credit']) ? '-' . $value['credit'] : 0;
				$r['creditmoney'] = !empty($value['creditmoney']) ? '-' . $value['creditmoney'] : 0;
				$r['goodsprice'] = $value['groupsprice'] * 1;
				$r['status'] = ($value['status'] == 1) && ($value['status'] == 1) ? $paystatus[4] : $paystatus['' . $value['status'] . ''];
				$r['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
				$r['paytime'] = !empty($value['paytime']) ? date('Y-m-d H:i:s', $value['paytime']) : '';
				$r['sendtime'] = !empty($value['sendtime']) ? date('Y-m-d H:i:s', $value['sendtime']) : '';
				$r['finishtime'] = !empty($value['finishtime']) ? date('Y-m-d H:i:s', $value['finishtime']) : '';
				$r['expresscom'] = $value['expresscom'];
				$r['expresssn'] = $value['expresssn'];
				$r['amount'] = (($value['groupsprice'] * 1) - $value['creditmoney']) + $value['freight'];
				$r['message'] = $value['message'];
				$r['remark'] = $value['remark'];
				$r['title'] = $value['title'];
				$r['goodssn'] = $value['goodssn'];
				$r['goods_total'] = 1;
				$exportlist[] = $r;
			}

			unset($r);
			m('excel')->export($exportlist, array('title' => '????????????-' . date('Y-m-d-H-i', time()), 'columns' => $columns));
		}

		include $this->template();
	}

	public function detail()
	{
		global $_W;
		global $_GPC;
		$status = $_GPC['status'];
		$orderid = intval($_GPC['orderid']);
		$params = array(':orderid' => $orderid);
		$order = pdo_fetch('SELECT o.*,g.title,g.category,g.groupsprice,g.singleprice,g.thumb,g.id as gid FROM ' . tablename('wx_shop_groups_order') . " as o\r\n\t\t\t\tleft join " . tablename('wx_shop_groups_goods') . " as g on g.id = o.goodid\r\n\t\t\t\tWHERE o.id = :orderid ", $params);
		$order = set_medias($order, 'thumb');
		$member = m('member')->getMember($order['openid'], true);

		if ($order['verifytype'] == 0) {
			$verify = pdo_fetch('select * from ' . tablename('wx_shop_groups_verify') . ' where orderid = ' . $order['id'] . ' ');

			if (!empty($verify['verifier'])) {
				$saler = m('member')->getMember($verify['verifier']);
				$saler['salername'] = pdo_fetchcolumn('select salername from ' . tablename('wx_shop_saler') . ' where openid=:openid and uniacid=:uniacid limit 1 ', array(':uniacid' => $_W['uniacid'], ':openid' => $verify['verifier']));
			}

			if (!empty($order['storeid'])) {
				$store = pdo_fetch('select * from ' . tablename('wx_shop_store') . ' where id=:storeid limit 1 ', array(':storeid' => $verify['storeid']));
			}
		}
		else {
			if ($order['verifytype'] == 1) {
				$verifyinfo = pdo_fetchall('select v.*,sm.id as salerid,sm.nickname as salernickname,s.salername,store.storename from ' . tablename('wx_shop_groups_verify') . " as v\r\n\t\t\t\t\tleft join " . tablename('wx_shop_saler') . " s on s.openid = v.verifier and s.uniacid = v.uniacid\r\n\t\t\t\t\tleft join " . tablename('wx_shop_member') . " sm on sm.openid = s.openid and sm.uniacid = s.uniacid\r\n\t\t\t\t\tleft join " . tablename('wx_shop_store') . " store on store.id = v.storeid and store.uniacid = v.uniacid\r\n\t\t\t\t\twhere v.uniacid = :uniacid and v.orderid = :orderid ", array(':orderid' => $orderid, ':uniacid' => $_W['uniacid']));
			}
		}

		if (!empty($order['address'])) {
			$user = unserialize($order['address']);
			$user['address'] = $user['province'] . ',' . $user['city'] . ',' . $user['area'] . ',' . $user['street'] . ',' . $user['address'];
			$item['addressdata'] = array('realname' => $user['realname'], 'mobile' => $user['mobile'], 'address' => $user['address']);
		}
		else {
			$user = iunserializer($order['addressid']);

			if (!is_array($user)) {
				$user = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_member_address') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $order['addressid'], ':uniacid' => $_W['uniacid']));
			}

			$user['address'] = $user['province'] . ',' . $user['city'] . ',' . $user['area'] . ',' . $user['street'] . ',' . $user['address'];
			$item['addressdata'] = array('realname' => $user['realname'], 'mobile' => $user['mobile'], 'address' => $user['address']);
		}

		include $this->template();
	}

	protected function opData()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_groups_order') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));

		if (empty($item)) {
			if ($_W['isajax']) {
				show_json(0, '???????????????!');
			}

			$this->message('???????????????!', '', 'error');
		}

		return array('id' => $id, 'item' => $item);
	}

	public function delete()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT id,name FROM ' . tablename('wx_shop_groups_order') . ' WHERE id = \'' . $id . '\' AND uniacid=' . $_W['uniacid'] . '');

		if (empty($item)) {
			message('????????????????????????????????????????????????', webUrl('groups/order', array('op' => 'display')), 'error');
		}

		pdo_delete('wx_shop_groups_order', array('id' => $id));
		plog('groups.order.delete', '?????????????????? ID: ' . $id . ' ??????: ' . $item['name'] . ' ');
		show_json(1);
	}

	public function remarksaler()
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);

		if ($_W['ispost']) {
			pdo_update('wx_shop_groups_order', array('remark' => $_GPC['remark']), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			plog('groups.order.remarksaler', '???????????? ID: ' . $item['id'] . ' ?????????: ' . $item['orderno'] . ' ????????????: ' . $_GPC['remark']);
			show_json(1);
		}

		include $this->template();
	}

	public function changeaddress()
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);
		$area_set = m('util')->get_area_config_set();
		$new_area = intval($area_set['new_area']);
		$address_street = intval($area_set['address_street']);

		if (empty($item['addressid'])) {
			$user = unserialize($item['carrier']);
		}
		else {
			$user = iunserializer($item['address']);

			if (!is_array($user)) {
				$user = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_member_address') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $item['addressid'], ':uniacid' => $_W['uniacid']));
			}

			$address_info = $user['address'];
			$user_address = $user['address'];
			$user['address'] = $user['province'] . ' ' . $user['city'] . ' ' . $user['area'] . ' ' . $user['street'] . ' ' . $user['address'];
			$item['addressdata'] = $oldaddress = array('realname' => $user['realname'], 'mobile' => $user['mobile'], 'address' => $user['address']);
		}

		if ($_W['ispost']) {
			$realname = $_GPC['realname'];
			$mobile = $_GPC['mobile'];
			$province = $_GPC['province'];
			$city = $_GPC['city'];
			$area = $_GPC['area'];
			$street = $_GPC['street'];
			$changead = intval($_GPC['changead']);
			$address = trim($_GPC['address']);

			if (!empty($id)) {
				if (empty($realname)) {
					$ret = '???????????????????????????';
					show_json(0, $ret);
				}

				if (empty($mobile)) {
					$ret = '???????????????????????????';
					show_json(0, $ret);
				}

				if ($province == '???????????????') {
					$ret = '??????????????????';
					show_json(0, $ret);
				}

				if (empty($address)) {
					$ret = '????????????????????????';
					show_json(0, $ret);
				}

				$item = pdo_fetch('SELECT id, orderno, address FROM ' . tablename('wx_shop_groups_order') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
				$address_array = iunserializer($item['address']);
				$address_array['realname'] = $realname;
				$address_array['mobile'] = $mobile;

				if ($changead) {
					$address_array['province'] = $province;
					$address_array['city'] = $city;
					$address_array['area'] = $area;
					$address_array['street'] = $street;
					$address_array['address'] = $address;
				}
				else {
					$address_array['province'] = $user['province'];
					$address_array['city'] = $user['city'];
					$address_array['area'] = $user['area'];
					$address_array['street'] = $user['street'];
					$address_array['address'] = $user_address;
				}

				$address_array = iserializer($address_array);
				pdo_update('wx_shop_groups_order', array('address' => $address_array), array('id' => $id, 'uniacid' => $_W['uniacid']));
				plog('groups.order.changeaddress', '?????????????????? ID: ' . $item['id'] . ' ?????????: ' . $item['orderno'] . ' <br>?????????: ?????????: ' . $oldaddress['realname'] . ' ?????????: ' . $oldaddress['mobile'] . ' ????????????: ' . $oldaddress['address'] . '<br>?????????: ?????????: ' . $realname . ' ?????????: ' . $mobile . ' ????????????: ' . $province . ' ' . $city . ' ' . $area . ' ' . $address);
				show_json(1);
			}
		}

		include $this->template();
	}

	public function pay($a = array(), $b = array())
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);

		if (1 < $item['status']) {
			show_json(0, '???????????????????????????????????????');
		}

		if (!empty($item['virtual']) && c('virtual')) {
			c('virtual')->pay($item);
		}
		else {
			pdo_update('wx_shop_groups_order', array('status' => 1, 'pay_type' => 'other', 'paytime' => time(), 'starttime' => time()), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			p('groups')->sendTeamMessage($item['id']);
		}

		plog('groups.order.pay', '?????????????????? ID: ' . $item['id'] . ' ?????????: ' . $item['orderno']);
		show_json(1);
	}

	public function send()
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);

		if (empty($item['addressid'])) {
			show_json(0, '?????????????????????????????????');
		}

		if (($item['pay_type'] == '') || ($item['status'] == 0)) {
			show_json(0, '?????????????????????????????????');
		}

		if ($_W['ispost']) {
			if (!empty($_GPC['isexpress']) && empty($_GPC['expresssn'])) {
				show_json(0, '????????????????????????');
			}

			if (!empty($item['transid'])) {
			}

			pdo_update('wx_shop_groups_order', array('status' => 2, 'express' => trim($_GPC['express']), 'expresscom' => trim($_GPC['expresscom']), 'expresssn' => trim($_GPC['expresssn']), 'sendtime' => time()), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			$this->model->sendTeamMessage($item['id']);
			plog('groups.order.send', '???????????? ID: ' . $item['id'] . ' ?????????: ' . $item['ordersn'] . ' <br/>????????????: ' . $_GPC['expresscom'] . ' ????????????: ' . $_GPC['expresssn']);
			show_json(1);
		}

		$address = iunserializer($item['address']);

		if (!is_array($address)) {
			$address = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_member_address') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $item['addressid'], ':uniacid' => $_W['uniacid']));
		}

		$express_list = m('express')->getExpressList();
		include $this->template();
	}

	public function sendcancel()
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);

		if ($item['status'] != 2) {
			show_json(0, '???????????????????????????????????????');
		}

		if ($_W['ispost']) {
			if (!empty($item['transid'])) {
			}

			$remark = trim($_GPC['remark']);

			if (!empty($item['remarksend'])) {
				$remark = $item['remarksend'] . "\r\n" . $remark;
			}

			pdo_update('wx_shop_groups_order', array('status' => 1, 'sendtime' => 0, 'remarksend' => $remark), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			plog('groups.order.sendcancel', '?????????????????? ID: ' . $item['id'] . ' ?????????: ' . $item['orderno'] . ' ??????: ' . $remark);
			show_json(1);
		}

		include $this->template();
	}

	public function changeexpress()
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);
		$edit_flag = 1;

		if ($_W['ispost']) {
			$express = $_GPC['express'];
			$expresscom = $_GPC['expresscom'];
			$expresssn = trim($_GPC['expresssn']);

			if (empty($id)) {
				$ret = '???????????????';
				show_json(0, $ret);
			}

			if (!empty($expresssn)) {
				$change_data = array();
				$change_data['express'] = $express;
				$change_data['expresscom'] = $expresscom;
				$change_data['expresssn'] = $expresssn;
				pdo_update('wx_shop_groups_order', $change_data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				plog('groups.order.changeexpress', '?????????????????? ID: ' . $item['id'] . ' ?????????: ' . $item['orderno'] . ' ????????????: ' . $expresscom . ' ????????????: ' . $expresssn);
				show_json(1);
			}
			else {
				show_json(0, '????????????????????????');
			}
		}

		$address = iunserializer($item['address']);

		if (!is_array($address)) {
			$address = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_member_address') . ' WHERE id = :id and uniacid=:uniacid', array(':id' => $item['addressid'], ':uniacid' => $_W['uniacid']));
		}

		$express_list = m('express')->getExpressList();
		include $this->template('groups/order/send');
	}

	public function finish()
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);
		pdo_update('wx_shop_groups_order', array('status' => 3, 'finishtime' => time()), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
		p('groups')->sendTeamMessage($item['id']);
		plog('groups.order.finish', '???????????? ID: ' . $item['id'] . ' ?????????: ' . $item['orderno']);
		show_json(1);
	}

	public function enabled()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);

		if (empty($id)) {
			$id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
		}

		$items = pdo_fetchall('SELECT id,name FROM ' . tablename('wx_shop_groups_order') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

		foreach ($items as $item) {
			pdo_update('wx_shop_groups_order', array('enabled' => intval($_GPC['enabled'])), array('id' => $item['id']));
			plog('groups.order.edit', ('??????????????????<br/>ID: ' . $item['id'] . '<br/>??????: ' . $item['name'] . '<br/>??????: ' . $_GPC['enabled']) == 1 ? '??????' : '??????');
		}

		show_json(1, array('url' => referer()));
	}

	/**
	 * ajax return ????????????
	 */
	public function ajaxorder()
	{
		global $_GPC;
		$day = (int) $_GPC['day'];
		$orderPrice = $this->selectOrderPrice($day);
		$orderPrice['avg'] = empty($orderPrice['count_avg']) ? 0 : number_format($orderPrice['price'] / $orderPrice['count_avg'], 2);
		$orderPrice['price'] = number_format($orderPrice['price'], 2);
		$orderPrice['count'] = number_format($orderPrice['count']);
		unset($orderPrice['fetchall']);
		echo json_encode($orderPrice);
	}

	/**
	 * ??????????????????
	 * @param int $day ????????????
	 * @return bool
	 */
	protected function selectOrderPrice($day = 0)
	{
		global $_W;
		$day = (int) $day;

		if ($day == 1) {
			$createtime1 = strtotime(date('Y-m-d', time() - (3600 * 24)));
			$createtime2 = strtotime(date('Y-m-d', time()));
		}
		else if (1 < $day) {
			$createtime1 = strtotime(date('Y-m-d', time() - ($day * 3600 * 24)));
			$createtime2 = strtotime(date('Y-m-d', time() + (3600 * 24)));
		}
		else {
			$createtime1 = strtotime(date('Y-m-d', time()));
			$createtime2 = strtotime(date('Y-m-d', time() + (3600 * 24)));
		}

		$sql = 'select id,price,freight,starttime,openid,creditmoney from ' . tablename('wx_shop_groups_order') . ' where uniacid = :uniacid and status > 0 and paytime between :createtime1 and :createtime2 ';
		$param = array(':uniacid' => $_W['uniacid'], ':createtime1' => $createtime1, ':createtime2' => $createtime2);
		$pdo_res = pdo_fetchall($sql, $param);
		$price = 0;

		foreach ($pdo_res as $key => $value) {
			$price += floatval(($value['price'] - $value['creditmoney']) + $value['freight']);
		}

		$new1 = '';

		if (!empty($pdo_res)) {
			foreach ($pdo_res as $k => $na) {
				$new[$k] = serialize($na['openid']);
			}

			$uniq = array_unique($new);

			foreach ($uniq as $k => $ser) {
				$new1[$k] = unserialize($ser);
			}
		}

		$result = array('price' => $price, 'count' => count($pdo_res), 'count_avg' => count($new1), 'fetchall' => $pdo_res);
		return $result;
	}

	/**
	 * ajax return ????????????
	 */
	public function ajaxteam()
	{
		global $_GPC;
		$success = intval($_GPC['success']);
		$orderPrice = $this->selectTeamPrice($success);
		$orderPrice['price'] = number_format($orderPrice['price'], 2);
		$orderPrice['count'] = number_format($orderPrice['count']);
		unset($orderPrice['fetchall']);
		echo json_encode($orderPrice);
	}

	/**
	 * ??????????????????
	 * @param int $day ????????????
	 * @return bool
	 */
	protected function selectteamPrice($success = 0)
	{
		global $_W;
		$success = intval($success);
		$sql = 'select id,price,freight,starttime from ' . tablename('wx_shop_groups_order') . ' where uniacid = :uniacid and paytime > 0 and is_team = 1 and heads = :heads and success = :success ';
		$param = array(':uniacid' => $_W['uniacid'], ':success' => $success, ':heads' => 1);
		$pdo_res = pdo_fetchall($sql, $param);
		$price = 0;

		foreach ($pdo_res as $key => $value) {
			$price += floatval($value['price'] + $value['freight']);
		}

		$result = array('price' => $price, 'count' => count($pdo_res), 'fetchall' => $pdo_res);
		return $result;
	}

	public function close()
	{
		global $_W;
		global $_GPC;
		$opdata = $this->opData();
		extract($opdata);

		if ($item['status'] == -1) {
			show_json(0, '???????????????????????????????????????');
		}
		else {
			if (1 <= $item['status']) {
				show_json(0, '?????????????????????????????????');
			}
		}

		if ($_W['ispost']) {
			if (!empty($item['transid'])) {
			}

			$time = time();
			if ((0 < $item['refundstate']) && !empty($item['refundid'])) {
				$change_refund = array();
				$change_refund['refundstatus'] = -1;
				$change_refund['refundtime'] = $time;
				pdo_update('wx_shop_groups_order_refund', $change_refund, array('id' => $item['refundid'], 'uniacid' => $_W['uniacid']));
			}

			pdo_update('wx_shop_groups_order', array('status' => -1, 'refundstate' => 0, 'canceltime' => $time, 'remarkclose' => $_GPC['remark']), array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
			plog('groups.order.close', '???????????? ID: ' . $item['id'] . ' ?????????: ' . $item['orderno']);
			show_json(1);
		}

		include $this->template();
	}

	public function ajaxgettotals()
	{
		$totals = $this->model->getTotals();
		$result = (empty($totals) ? array() : $totals);
		show_json(1, $result);
	}
}

?>
