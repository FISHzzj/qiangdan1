<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Pages_WxShopPage extends PluginWebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' WHERE uniacid=:uniacid and merchid=0';
		$params = array(':uniacid' => $_W['uniacid']);
		$keyword = trim($_GPC['keyword']);

		if (!empty($keyword)) {
			$condition .= ' AND title LIKE \'%' . $keyword . '%\' ';
		}

		$status = trim($_GPC['status']);

		if ($status != '') {
			$condition .= ' AND status=:status ';
			$params['status'] = intval($status);
		}

		$limit = ' limit ' . (($pindex - 1) * $psize) . ',' . $psize;
		$list = pdo_fetchall('SELECT * FROM' . tablename('wx_shop_quick') . $condition . ' ORDER BY createtime DESC' . $limit, $params);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM' . tablename('wx_shop_quick') . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);

		if (!empty($list)) {
			foreach ($list as $key => &$value) {
				$url = mobileUrl('quick', array('id' => $value['id']), true);
				$value['qrcode'] = m('qrcode')->createQrcode($url);
			}
		}

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
		$id = intval($_GPC['id']);

		if (!empty($id)) {
			$item = pdo_fetch('SELECT * FROM' . tablename('wx_shop_quick') . ' WHERE id=:id AND uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));

			if (!empty($item['datas'])) {
				$datas = htmlspecialchars_decode(base64_decode($item['datas']));
				$datas = $this->model->update($datas);
			}
			else {
				$datas = 'null';
			}

			if (!empty($item['adv_data'])) {
				$item['adv_data'] = iunserializer($item['adv_data']);
			}
		}
		else {
			$datas = 'null';
		}

		if ($_W['ispost']) {
			$tab = trim($_GPC['tab']);
			$arr = array('title' => trim($_GPC['title']), 'keyword' => trim($_GPC['keyword']), 'share_title' => trim($_GPC['share_title']), 'share_desc' => trim($_GPC['share_desc']), 'share_icon' => trim($_GPC['share_icon']), 'enter_title' => trim($_GPC['enter_title']), 'enter_desc' => trim($_GPC['enter_desc']), 'enter_icon' => trim($_GPC['enter_icon']), 'status' => intval($_GPC['status']), 'lasttime' => time());
			$arr['datas'] = base64_encode($_GPC['datas']);

			if (empty($arr['title'])) {
				show_json(0, '?????????????????????');
			}

			if (!empty($arr['keyword'])) {
				$keyword = m('common')->keyExist($arr['keyword']);

				if (!empty($keyword)) {
					if ($keyword['name'] != ('wx_shop:quick:' . $id)) {
						show_json(0, '?????????"' . $arr['keyword'] . '"?????????!');
					}
				}
			}

			if (empty($item)) {
				$arr['uniacid'] = $_W['uniacid'];
				$arr['createtime'] = time();
				pdo_insert('wx_shop_quick', $arr);
				$id = pdo_insertid();
				plog('quick.pages.add', '?????????????????? ID: ' . $id . ' ??????: ' . $arr['title']);
			}
			else {
				pdo_update('wx_shop_quick', $arr, array('uniacid' => $_W['uniacid'], 'id' => $id));
				plog('quick.pages.add', '?????????????????? ID: ' . $id . ' ??????: ' . $arr['title']);
			}

			if (!empty($arr['keyword'])) {
				$rule = pdo_fetch('select * from ' . tablename('rule') . ' where uniacid=:uniacid and module=:module and name=:name  limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'wx_shop', ':name' => 'wx_shop:quick:' . $id));

				if (!empty($rule)) {
					pdo_update('rule_keyword', array('content' => $arr['keyword']), array('rid' => $rule['id']));
				}
				else {
					$rule_data = array('uniacid' => $_W['uniacid'], 'name' => 'wx_shop:quick:' . $id, 'module' => 'wx_shop', 'displayorder' => 0, 'status' => 1);
					pdo_insert('rule', $rule_data);
					$rid = pdo_insertid();
					$keyword_data = array('uniacid' => $_W['uniacid'], 'rid' => $rid, 'module' => 'wx_shop', 'content' => $arr['keyword'], 'type' => 1, 'displayorder' => 0, 'status' => 1);
					pdo_insert('rule_keyword', $keyword_data);
				}
			}
			else {
				$this->delKey($item['keyword']);
			}

			show_json(1, array('url' => webUrl('quick/pages/edit', array('id' => $id, 'tab' => $tab))));
		}

		if (!empty($item)) {
			$url = mobileUrl('quick', array('id' => $item['id']), true);
			$qrcode = m('qrcode')->createQrcode($url);
		}

		$merchid = 0;
		$shopset = $_W['shopset']['shop'];
		$diymenu = pdo_fetchall('select id, `name` from ' . tablename('wx_shop_diypage_menu') . ' where merch=:merch and uniacid=:uniacid  order by id desc', array(':merch' => intval($_W['merchid']), ':uniacid' => $_W['uniacid']));
		include $this->template();
	}

	public function delete()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);

		if (empty($id)) {
			$id = (is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0);
		}

		$items = pdo_fetchall('SELECT id,title,cart,keyword FROM ' . tablename('wx_shop_quick') . ' WHERE id in( ' . $id . ' ) AND uniacid=:uniacid AND merchid=0', array(':uniacid' => $_W['uniacid']));

		if (!empty($items)) {
			foreach ($items as $item) {
				pdo_delete('wx_shop_quick', array('id' => $item['id'], 'uniacid' => $_W['uniacid']));
				plog('quick.pages.delete', '?????????????????? ID: ' . $item['id'] . ' ??????: ' . $item['title'] . ' ');

				if (!empty($item['cart'])) {
					pdo_delete('wx_shop_quick_cart', array('quickid' => $item['id'], 'uniacid' => $_W['uniacid']));
				}

				if (!empty($item['keyword'])) {
					$this->delKey($item['keyword']);
				}
			}
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

		$items = pdo_fetchall('SELECT id,title FROM ' . tablename('wx_shop_quick') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

		if (!empty($items)) {
			foreach ($items as $item) {
				pdo_update('wx_shop_quick', array('status' => intval($_GPC['status'])), array('id' => $item['id']));
				plog('quick.pages.status', ('??????????????????<br/>ID: ' . $item['id'] . '<br/>??????: ' . $item['title'] . '<br/>??????: ' . $_GPC['status']) == 1 ? '??????' : '??????');
			}
		}

		show_json(1, array('url' => referer()));
	}

	protected function delKey($keyword)
	{
		global $_W;

		if (empty($keyword)) {
			return NULL;
		}

		$keyword = pdo_fetch('SELECT * FROM ' . tablename('rule_keyword') . ' WHERE content=:content and module=:module and uniacid=:uniacid limit 1 ', array(':content' => $keyword, ':module' => 'wx_shop', ':uniacid' => $_W['uniacid']));

		if (!empty($keyword)) {
			pdo_delete('rule_keyword', array('id' => $keyword['id']));
			pdo_delete('rule', array('id' => $keyword['rid']));
		}
	}
}

?>
