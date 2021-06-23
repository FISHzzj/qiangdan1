<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Sd_List_WxShopPage extends WebPage
{
	
	public function main() 
	{
		global $_W;
		global $_GPC;
		$orderData = $this->newList();
	}
	
	public function newList()
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;

		$condition = ' o.uniacid = :uniacid and o.deleted=0 ';
		$params = array(':uniacid' => $uniacid);

		if (!empty($_GPC['keyword'])) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' and (o.ordersn like :keyword or m.nickname like :keyword or m.realname like :keyword or m.mobile like :keyword or g.title like :keyword) ';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}

		if(!empty($_GPC['freeze']) && $_GPC['freeze'] > 0){
			if($_GPC['freeze'] == 3){
				$condition .= ' and o.freeze = 0 ';
			}else{
				$condition .= ' and o.freeze = :freeze ';
				$params[':freeze'] = intval($_GPC['freeze']);
			}
		}

		if(!empty($_GPC['status']) && $_GPC['status'] > 0){
			$condition .= ' and o.status = :status ';
			$params[':status'] = intval($_GPC['status']);
		}

		if(!empty($_GPC['searchtime'])){
			if($_GPC['searchtime'] == 'create'){
				$fields = ' o.createtime ';
			}else{
				$fields = ' o.finishtime ';
			}

			$starttime = strtotime($_GPC['time']['start']);
			$endtime = strtotime($_GPC['time']['end']);
			$condition .= ' AND ' . $fields . 'time >= :starttime AND ' . $fields . 'time <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}

		$sql = ' select o.id, o.ordersn, o.price, o.commission, o.addressid, o.status, o.createtime, o.freeze, o.halllevel, m.nickname, m.mobile, m.realname, m.id as mid, g.title, g.thumb from ' . tablename('wx_shop_sd_order') . ' o ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = o.uid ' . ' left join ' . tablename('wx_shop_goods') . ' g on g.id = o.goodsid ' . ' where ' . $condition . ' order by o.createtime desc ';
		$sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;

		$list = pdo_fetchall($sql, $params);
		foreach ($list as $key => &$value) {
			$value['thumb'] = tomedia($value['thumb']);
			$address = pdo_fetch(' select * from ' . tablename('wx_shop_member_address') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $value['addressid']));
			$value['address'] = array(
				'realname' 	=> $address['realname'],
				'mobile' 	=> $address['mobile'],
				'province' 	=> $address['province'],
				'city' 		=> $address['city'],
				'area' 		=> $address['area'],
				'address' 	=> $address['address'],
			);
		}
		unset($value);

		$total = pdo_fetch(' select count(o.id) as count, sum(price) as sum from ' . tablename('wx_shop_sd_order') . ' o ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = o.uid ' . ' left join ' . tablename('wx_shop_goods') . ' g on g.id = o.goodsid ' . ' where ' . $condition, $params);
		$pager = pagination2($total['count'], $pindex, $psize);
		include $this->template();
	}

	public function newAjaxorder() 
	{
		$order0 = $this->newOrder(0);
		$order1 = $this->newOrder(1);
		$order7 = $this->newOrder(7);
		$order30 = $this->newOrder(30);
		$order7['price'] = $order7['price'] + $order0['price'];
		$order7['count'] = $order7['count'] + $order0['count'];
		$order7['avg'] = ((empty($order7['count']) ? 0 : round($order7['price'] / $order7['count'], 1)));
		$order30['price'] = $order30['price'] + $order0['price'];
		$order30['count'] = $order30['count'] + $order0['count'];
		$order30['avg'] = ((empty($order30['count']) ? 0 : round($order30['price'] / $order30['count'], 1)));
		show_json(1, array('order0' => $order0, 'order1' => $order1, 'order7' => $order7, 'order30' => $order30));
	}


	protected function newOrder($day) 
	{
		global $_GPC;
		$day = (int) $day;
		$orderPrice = $this->newSelectOrderPrice($day);
		$orderPrice['avg'] = ((empty($orderPrice['count']) ? 0 : round($orderPrice['price'] / $orderPrice['count'], 1)));
		unset($orderPrice['fetchall']);
		return $orderPrice;
	}

	protected function newSelectOrderPrice($day = 0) 
	{
		global $_W;
		$day = (int) $day;
		if ($day != 0) 
		{
			$createtime1 = strtotime(date('Y-m-d', time() - ($day * 3600 * 24)));
			$createtime2 = strtotime(date('Y-m-d', time()));
		}
		else 
		{
			$createtime1 = strtotime(date('Y-m-d', time()));
			$createtime2 = strtotime(date('Y-m-d', time() + (3600 * 24)));
		}
		$sql = 'select id,price,createtime from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and status = 2 and deleted=0 and createtime between :createtime1 and :createtime2';
		$param = array(':uniacid' => $_W['uniacid'], ':createtime1' => $createtime1, ':createtime2' => $createtime2);
		$pdo_res = pdo_fetchall($sql, $param);
		$price = 0;
		foreach ($pdo_res as $arr ) 
		{
			$price += $arr['price'];
		}
		$result = array('price' => round($price, 1), 'count' => count($pdo_res), 'fetchall' => $pdo_res);
		return $result;
	}

	public function newAjaxtransaction() 
	{
		$orderPrice = $this->newSelectOrderPrice(7);
		$transaction = $this->newSelectTransaction($orderPrice['fetchall'], 7);
		if (empty($transaction)) 
		{
			$i = 7;
			while (1 <= $i) 
			{
				$transaction['price'][date('Y-m-d', time() - ($i * 3600 * 24))] = 0;
				$transaction['count'][date('Y-m-d', time() - ($i * 3600 * 24))] = 0;
				--$i;
			}
		}
		echo json_encode(array('price_key' => array_keys($transaction['price']), 'price_value' => array_values($transaction['price']), 'count_value' => array_values($transaction['count'])));
	}

	protected function newSelectTransaction(array $pdo_fetchall, $days = 7) 
	{
		$transaction = array();
		$days = (int) $days;
		if (!(empty($pdo_fetchall))) 
		{
			$i = $days;
			while (1 <= $i) 
			{
				$transaction['price'][date('Y-m-d', time() - ($i * 3600 * 24))] = 0;
				$transaction['count'][date('Y-m-d', time() - ($i * 3600 * 24))] = 0;
				--$i;
			}
			foreach ($pdo_fetchall as $key => $value ) 
			{
				if (array_key_exists(date('Y-m-d', $value['createtime']), $transaction['price'])) 
				{
					$transaction['price'][date('Y-m-d', $value['createtime'])] += $value['price'];
					$transaction['count'][date('Y-m-d', $value['createtime'])] += 1;
				}
			}
			return $transaction;
		}
		return array();
	}
}
?>