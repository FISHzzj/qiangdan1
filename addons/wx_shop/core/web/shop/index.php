<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_WxShopPage extends WebPage
{
	public function main() 
	{
		global $_W;
		if (!(empty($_W['shopversion']))) 
		{	
			if (cv('shop.notice')) 
			{
				header('location: ' . webUrl('shop/notice'));
			}
			else if (cv('shop.adv')) 
			{
				header('location: ' . webUrl('shop/adv'));
			}
			else if (cv('shop.nav')) 
			{
				header('location: ' . webUrl('shop/nav'));
			}
			else if (cv('shop.banner')) 
			{
				header('location: ' . webUrl('shop/banner'));
			}
			else if (cv('shop.cube')) 
			{
				header('location: ' . webUrl('shop/cube'));
			}
			else if (cv('shop.recommand')) 
			{
				header('location: ' . webUrl('shop/recommand'));
			}
			else if (cv('shop.sort')) 
			{
				header('location: ' . webUrl('shop/sort'));
			}
			else if (cv('shop.verify.store')) 
			{
				header('location: ' . webUrl('shop/verify/store'));
			}
			else if (cv('shop.verify.saler')) 
			{
				header('location: ' . webUrl('shop/verify/saler'));
			}
			else if (cv('shop.verify.set')) 
			{
				header('location: ' . webUrl('shop/verify/set'));
			}
			exit();
		}
		else 
		{
			$shop_data = m('common')->getSysset('shop');
			$merch_plugin = p('merch');
			$merch_data = m('common')->getPluginset('merch');
			if ($merch_plugin && $merch_data['is_openmerch']) 
			{
				$is_openmerch = 1;
			}
			else 
			{
				$is_openmerch = 0;
			}
			$order_sql = 'select id,ordersn,createtime,address,price,invoicename from ' . tablename('wx_shop_order') . ' where uniacid = :uniacid and merchid=0 and isparent=0 and deleted=0 AND ( status = 1 or (status=0 and paytype=3) ) ORDER BY createtime ASC LIMIT 20';
			$order = pdo_fetchall($order_sql, array(':uniacid' => $_W['uniacid']));
			foreach ($order as &$value ) 
			{
				$value['address'] = iunserializer($value['address']);
			}
			unset($value);
			$order_ok = $order;
			$notice = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_system_copyright_notice') . ' ORDER BY displayorder ASC,createtime DESC LIMIT 10');
			$hascommission = false;
			if (p('commission')) 
			{
				$hascommission = 0 < intval($_W['shopset']['commission']['level']);
			}

			include $this->template();
		}
	}
	public function view() 
	{
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_system_copyright_notice') . ' WHERE id = ' . $id . ' ORDER BY displayorder ASC,createtime DESC');
		$item['content'] = htmlspecialchars_decode($item['content']);
		include $this->template('shop/view');
	}
	public function notice() 
	{
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = '';
		$params = array();
		if (!(empty($_GPC['keyword']))) 
		{
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' and title like :keyword';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_system_copyright_notice') . ' WHERE 1 ' . $condition . '  ORDER BY displayorder DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
		$total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('wx_shop_system_copyright_notice') . ' WHERE 1 ' . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}
	public function ajax() 
	{
		global $_W;
		$paras = array(':uniacid' => $_W['uniacid']);
		$goods_totals = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename('wx_shop_goods') . ' WHERE uniacid = :uniacid and status=1 and deleted=0 and total<=0 and total<>-1  ', $paras);
		$finance_total = pdo_fetchcolumn('select count(1) from ' . tablename('wx_shop_member_log') . ' log ' . ' left join ' . tablename('wx_shop_member') . ' m on m.openid=log.openid and m.uniacid= log.uniacid' . ' left join ' . tablename('wx_shop_member_group') . ' g on m.groupid=g.id' . ' left join ' . tablename('wx_shop_member_level') . ' l on m.level =l.id' . ' where log.uniacid=:uniacid and log.type=:type and log.money<>0 and log.status=:status', array(':uniacid' => $_W['uniacid'], ':type' => 1, ':status' => 0));
		$commission_agent_total = pdo_fetchcolumn('select count(1) from' . tablename('wx_shop_member') . ' dm ' . ' left join ' . tablename('wx_shop_member') . ' p on p.id = dm.agentid ' . ' left join ' . tablename('mc_mapping_fans') . 'f on f.openid=dm.openid' . ' where dm.uniacid =:uniacid and dm.isagent =1', array(':uniacid' => $_W['uniacid']));
		$commission_agent_status0_total = pdo_fetchcolumn('select count(1) from' . tablename('wx_shop_member') . ' dm ' . ' left join ' . tablename('wx_shop_member') . ' p on p.id = dm.agentid ' . ' left join ' . tablename('mc_mapping_fans') . 'f on f.openid=dm.openid' . ' where dm.uniacid =:uniacid and dm.isagent =1 and dm.status=:status', array(':uniacid' => $_W['uniacid'], ':status' => 0));
		$commission_apply_status1_total = pdo_fetchcolumn('select count(1) from' . tablename('wx_shop_commission_apply') . ' a ' . ' left join ' . tablename('wx_shop_member') . ' m on m.uid = a.mid' . ' left join ' . tablename('wx_shop_commission_level') . ' l on l.id = m.agentlevel' . ' where a.uniacid=:uniacid and a.status=:status', array(':uniacid' => $_W['uniacid'], ':status' => 1));
		$commission_apply_status2_total = pdo_fetchcolumn('select count(1) from' . tablename('wx_shop_commission_apply') . ' a ' . ' left join ' . tablename('wx_shop_member') . ' m on m.uid = a.mid' . ' left join ' . tablename('wx_shop_commission_level') . ' l on l.id = m.agentlevel' . ' where a.uniacid=:uniacid and a.status=:status', array(':uniacid' => $_W['uniacid'], ':status' => 2));
		show_json(1, array('goods_totals' => $goods_totals, 'finance_total' => $finance_total, 'commission_agent_total' => $commission_agent_total, 'commission_agent_status0_total' => $commission_agent_status0_total, 'commission_apply_status1_total' => $commission_apply_status1_total, 'commission_apply_status2_total' => $commission_apply_status2_total));
	}
	public function ajaxgoods() 
	{
		global $_W;
		show_json(1, array( 'obj' => array('goods_rank_0' => $this->selectGoodsRank(0), 'goods_rank_1' => $this->selectGoodsRank(1), 'goods_rank_7' => $this->selectGoodsRank(7)) ));
	}
	protected function selectGoodsRank($day = 0) 
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
		$condition = ' and og.uniacid=' . $_W['uniacid'] . ' ';
		$condition1 = ' and g.uniacid=:uniacid';
		$params1 = array(':uniacid' => $_W['uniacid']);
		if (!(empty($createtime1))) 
		{
			$condition .= ' AND o.createtime >= ' . $createtime1;
		}
		if (!(empty($createtime2))) 
		{
			$condition .= ' AND o.createtime <= ' . $createtime2 . ' ';
		}
		$sql = 'SELECT g.id,g.title,g.thumb,' . '(select ifnull(sum(og.price),0) from  ' . tablename('wx_shop_order_goods') . ' og left join ' . tablename('wx_shop_order') . ' o on og.orderid=o.id  where o.status>=1 and og.goodsid=g.id ' . $condition . ')  as money,' . '(select ifnull(sum(og.total),0) from  ' . tablename('wx_shop_order_goods') . ' og left join ' . tablename('wx_shop_order') . ' o on og.orderid=o.id  where o.status>=1 and og.goodsid=g.id ' . $condition . ') as count  ' . 'from ' . tablename('wx_shop_goods') . ' g  ' . 'where 1 ' . $condition1 . '  order by count desc limit 7 ';
		$list = pdo_fetchall($sql, $params1);
		return $list;
	}
}
?>