<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}
require WX_SHOP_PLUGIN . 'app/core/page_mobile.php';
class Address_WxShopPage extends AppMobilePage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		global $_S;
		$pindex = max(1, intval($_GPC['page']));
		$openid = $_GPC['openid'];
		$psize = 20;
		$condition = ' and openid=:openid and deleted=0 and  `uniacid` = :uniacid  ';
		$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);
		$sql = 'SELECT COUNT(*) FROM ' . tablename('wx_shop_member_address') . ' where 1 ' . $condition;
		$total = pdo_fetchcolumn($sql, $params);
		$sql = 'SELECT * FROM ' . tablename('wx_shop_member_address') . ' where 1 ' . $condition . ' ORDER BY `id` DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		$list = pdo_fetchall($sql, $params);
		// include $this->template();
		show_json(1, array('list' => $list));
	}

	public function post()
	{
		global $_W;
		global $_GPC;
		$openid = $_GPC['openid'];
		$id = intval($_GPC['id']);
		$address = pdo_fetch('select * from ' . tablename('wx_shop_member_address') . ' where id=:id and openid=:openid and uniacid=:uniacid limit 1 ', array(':id' => $id, ':uniacid' => $_W['uniacid'], ':openid' => $openid));
		$shareaddress_config = false;
		$area_set = m('util')->get_area_config_set();
		$new_area = intval($area_set['new_area']);
		$address_street = intval($area_set['address_street']);
		if ($_W['shopset']['trade']['shareaddress'] && is_weixin()) {
			$account = WeAccount::create();

			if (method_exists($account, 'getShareAddressConfig')) {
				$shareaddress_config = $account->getShareAddressConfig();
			}
		}

		$show_data = 1;
		if ((!empty($new_area) && empty($address['datavalue'])) || (empty($new_area) && !empty($address['datavalue']))) {
			$show_data = 0;
		}

		// include $this->template();
		show_json(1, array('address'=>$address, 'show_data'=>$show_data, 'shareaddress_config'=>$shareaddress_config, 'address_street'=>$address_street));
	}

	public function setdefault()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$openid = $_GPC['openid'];
		$data = pdo_fetch('select id from ' . tablename('wx_shop_member_address') . ' where id=:id and deleted=0 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $id));

		if (empty($data)) {
			show_json(0, '???????????????');
		}

		pdo_update('wx_shop_member_address', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'openid' => $openid));
		pdo_update('wx_shop_member_address', array('isdefault' => 1), array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $openid));
		show_json(1);
	}

	public function submit()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		// $data = $_GPC['addressdata'];
		// $areas = explode(' ', $data['areas']);
		// $data['province'] = $areas[0];
		// $data['city'] = $areas[1];
		// $data['area'] = $areas[2];
		// unset($data['areas']);
		$data['realname'] = $_GPC['realname'];
		$data['mobile'] = $_GPC['mobile'];
		$data['province'] = $_GPC['province'];
		$data['city'] = $_GPC['city'];
		$data['area'] = $_GPC['area'];
		$data['address'] = $_GPC['address'];
		$openid = $_GPC['openid'];
		$data['openid'] = $openid;
		$data['uniacid'] = $_W['uniacid'];

		if (empty($id)) {
			$addresscount = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('wx_shop_member_address') . ' where openid=:openid and deleted=0 and `uniacid` = :uniacid ', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));

			if ($addresscount <= 0) {
				$data['isdefault'] = 1;
			}

			pdo_insert('wx_shop_member_address', $data);
			$id = pdo_insertid();
		}
		else {
			pdo_update('wx_shop_member_address', $data, array('id' => $id, 'uniacid' => $_W['uniacid'], 'openid' => $openid));
		}

		show_json(1, array('addressid' => $id));
	}

	public function delete()
	{
		global $_W;
		global $_GPC;
		$openid = $_GPC['openid'];
		$id = intval($_GPC['id']);
		$data = pdo_fetch('select id,isdefault from ' . tablename('wx_shop_member_address') . ' where  id=:id and openid=:openid and deleted=0 and uniacid=:uniacid  limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid, ':id' => $id));

		if (empty($data)) {
			show_json(0, '???????????????');
		}

		pdo_update('wx_shop_member_address', array('deleted' => 1), array('id' => $id));

		if ($data['isdefault'] == 1) {
			pdo_update('wx_shop_member_address', array('isdefault' => 0), array('uniacid' => $_W['uniacid'], 'openid' => $openid, 'id' => $id));
			$data2 = pdo_fetch('select id from ' . tablename('wx_shop_member_address') . ' where openid=:openid and deleted=0 and uniacid=:uniacid order by id desc limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));

			if (!empty($data2)) {
				pdo_update('wx_shop_member_address', array('isdefault' => 1), array('uniacid' => $_W['uniacid'], 'openid' => $openid, 'id' => $data2['id']));
				show_json(1, array('defaultid' => $data2['id']));
			}
		}

		show_json(1);
	}

	public function selector()
	{
		global $_W;
		global $_GPC;
		$openid = $_GPC['openid'];
		$condition = ' and openid=:openid and deleted=0 and  `uniacid` = :uniacid  ';
		$params = array(':uniacid' => $_W['uniacid'], ':openid' => $openid);

		$sql = 'SELECT id,realname,mobile,address,province,city,area,isdefault FROM ' . tablename('wx_shop_member_address') . ' where 1 ' . $condition . ' ORDER BY isdefault desc, id DESC ';
		$list = pdo_fetchall($sql, $params);
		show_json(1,array('list' => $list));

	}
}

?>
