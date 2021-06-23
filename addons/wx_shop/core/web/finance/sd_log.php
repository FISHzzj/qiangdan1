<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Sd_Log_WxShopPage extends WebPage
{
	protected function main($type = 0) 
	{
		global $_W;
		global $_GPC;
		
		include $this->template();
	}
	
	public function gold()
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$deduction = 0;//总扣款
		$receivables = 0;//总收款

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' log.uniacid = :uniacid and log.gold <> 0 ';
		$params = array(':uniacid' => $uniacid);

		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}

		if (!(empty($_GPC['createtime']['start'])) && !(empty($_GPC['createtime']['end']))) {
			$starttime = strtotime($_GPC['createtime']['start']);
			$endtime = strtotime($_GPC['createtime']['end']);
			$condition .= ' AND log.createtime >= :starttime AND log.createtime <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}

		// var_dump($condition);die;

		if(!empty($_GPC['type'])){
			$type = intval($_GPC['type']);
			$condition .= ' and log.type = :type ';
			$params[':type'] = $type;
		}

		$sql = ' select log.gold, log.budget, log.createtime, log.title, log.rid, log.status, log.type, m.avatar, m.nickname, m.mobile, m.id as mid, m.realname, log.updatetime from ' . tablename('wx_shop_sd_gold_log') . ' log ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = log.uid ' . ' where ' . $condition . ' order by log.createtime desc ';
		$sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;

		$list = pdo_fetchall($sql, $params);
		foreach ($list as $key => &$value) {
			if($value['type'] == 3 && $value['budget'] == 1){
				$value['createtime'] = $value['updatetime'];
			}
			// $value['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
			$value['avatar'] = tomedia($value['avatar']);

			if($value['budget'] == 1){
				$value['gold'] = '-'.$value['gold'];
				$deduction += $value['gold'];
				unset($value['budget']);
			}else{
				$receivables += $value['gold'];
			}

			$value['ordersn'] = '--';
			if($value['type'] == 1 || $value['type'] == 4 || $value['type'] == 5 || $value['type'] == 6 || $value['type'] == 11 || $value['type'] == 61){//抢单、返佣、分润、订单冻结、抢单返还、订单解冻
				$ordersn = pdo_fetchcolumn(' select ordersn from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $value['rid']));
				if(!empty($ordersn)){
					$value['ordersn'] = $ordersn;
				}
			}

			if(empty($value['realname'])){
				$value['realname'] = '--';
			}
		}
		unset($value);
		
		$total = pdo_fetchcolumn(' select count(log.id) from ' . tablename('wx_shop_sd_gold_log') . ' log ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = log.uid ' . ' where ' . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}

	public function recharge()
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$deduction = 0;//总扣款
		$receivables = 0;//总收款
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;

		$condition = ' l.uniacid = :uniacid ';
		$params = array(':uniacid' => $uniacid);

		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}

		if (!(empty($_GPC['createtime']['start'])) && !(empty($_GPC['createtime']['end']))) {
			$starttime = strtotime($_GPC['createtime']['start']);
			$endtime = strtotime($_GPC['createtime']['end']);
			$condition .= ' AND l.createtime >= :starttime AND l.createtime <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}

		$sql = ' select l.id, l.uid as mid, l.money, l.images, l.createtime, l.status, l.updatetime, m.avatar, m.nickname, m.realname, m.mobile from ' . tablename('wx_shop_sd_recharge_list') . ' l ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = l.uid ' . ' where ' . $condition . ' order by l.status asc, l.createtime desc ';
		$sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;

		$list = pdo_fetchall($sql, $params);
		foreach ($list as $key => &$value) {
			if(empty($value['realname'])){
				$value['realname'] = '--';
			}

			$value['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
			if($value['updatetime'] > 0){
				$value['updatetime'] = date('Y-m-d H:i:s', $value['updatetime']);
			}else{
				$value['updatetime'] = '--';
			}

			if($value['status'] == 1){
				$receivables += $value['money'];
				$value['statusd'] = '通过';
			}else if($value['status'] == 2){
				$deduction += $value['money'];
				$value['statusd'] = '驳回';
			}else{
				$receivables += $value['money'];
				$value['statusd'] = '待审核';
			}
		}
		unset($value);
		$total = pdo_fetchcolumn(' select count(l.id) from ' . tablename('wx_shop_sd_recharge_list') . ' l ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = l.uid ' . ' where ' . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}

	public function rechargeExamine()
	{	
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$id = intval($_GPC['id']);
		$status = intval($_GPC['status']);

		$info = pdo_fetch(' select * from ' . tablename('wx_shop_sd_recharge_list') . ' where uniacid = :uniacid and id = :id and status = 0 ', array(':uniacid' => $uniacid, ':id' => $id));
		if(empty($info)){
			show_json(0, '该记录已审核');
		}

		$fp = fopen("../data/rechargeExamine.txt", "w+");
		if(flock($fp,LOCK_EX | LOCK_NB)){
			if($status == 1){
				if($info['money'] > 0){
					$sd_model = m('sd_model');
					$member = pdo_fetch(' select id, openid from ' . tablename('wx_shop_member') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $info['uid']));
					$result = $sd_model->setGold($member['id'], $member['openid'], 'credit2', $info['money'], 1, $info['id'], 2);
					if($result){
						pdo_update('wx_shop_sd_recharge_list', array('status' => 1, 'updatetime' => time()), array('id' => $info['id']));
						flock($fp,LOCK_UN);
                		fclose($fp);
						show_json(1, array('url' => referer()));
					}else{
						flock($fp,LOCK_UN);
                		fclose($fp);
						show_json(0, '系统繁忙');
					}
				}
			}else{
				pdo_update('wx_shop_sd_recharge_list', array('status' => 2, 'updatetime' => time()), array('id' => $info['id']));
				flock($fp,LOCK_UN);
                fclose($fp);
                show_json(1, array('url' => referer()));
			}
		}
		
		show_json(0, '请勿重复点击');
	}

	public function withdrawal()
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$deduction = 0;//总扣款
		$receivables = 0;//总收款
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;

		$condition = ' l.uniacid = :uniacid and (l.type = 32 or (l.type = 3 and l.budget = 1)) ';
		$params = array(':uniacid' => $uniacid);

		if (!(empty($_GPC['keyword']))) {
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}

		if (!(empty($_GPC['createtime']['start'])) && !(empty($_GPC['createtime']['end']))) {
			$starttime = strtotime($_GPC['createtime']['start']);
			$endtime = strtotime($_GPC['createtime']['end']);
			$condition .= ' AND l.createtime >= :starttime AND l.createtime <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}

		$sql = ' select l.id, l.uid as mid, l.gold, m.avatar, m.nickname, m.mobile, m.realname, l.rid, l.createtime, l.status, l.updatetime from ' . tablename('wx_shop_sd_gold_log') . ' l ' . ' left join ' . tablename('wx_shop_member') . ' m ' . ' on m.id = l.uid ' . ' where ' . $condition . ' order by l.status asc, l.createtime desc ';
		$sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;

		$list = pdo_fetchall($sql, $params);
		foreach ($list as $key => &$value) {
			$value['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
			if($value['status'] == 1){
				$receivables += $value['gold'];
				$value['statusd'] = '已通过';
			}else if($value['status'] == 2){
				$deduction += $value['gold'];
				$value['statusd'] = '已驳回';
			}else{
				$receivables += $value['gold'];
				$value['statusd'] = '待审核';
			}

			if(empty($value['realname'])){
				$value['realname'] = '--';
			}

				
			if(empty($value['updatetime'])){
				$value['updatetime'] = '--';
			}else{
				$value['updatetime'] = date('Y-m-d H:i:s', $value['updatetime']);
			}

			$bank = pdo_fetch(' select bankname, banknum, realname from ' . tablename('wx_shop_sd_bankcard_list') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $value['rid']));

			$value['bankname'] = $bank['bankname'];
			$value['banknum'] = $bank['banknum'];
			$value['brealname'] = $bank['realname'];
		}
		unset($value);
		$total = pdo_fetchcolumn(' select count(l.id) from ' . tablename('wx_shop_sd_gold_log') . ' l ' . ' left join ' . tablename('wx_shop_member') . ' m ' . ' on m.id = l.uid ' . ' where ' . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}

	public function withdrawalExamine()
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$id = intval($_GPC['id']);
		$status = intval($_GPC['status']);

		$info = pdo_fetch(' select * from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and id = :id and status = 0 and type = 32 ', array(':uniacid' => $uniacid, ':id' => $id));
		if(empty($info)){
			show_json(0, '该记录已审核');
		}

		$fp = fopen("../data/withdrawalExamine.txt", "w+");
		if(flock($fp,LOCK_EX | LOCK_NB)){
			$sd_model = m('sd_model');
			$member = pdo_fetch(' select id, openid from ' . tablename('wx_shop_member') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $info['uid']));
			if($status == 1){
				if($info['gold'] > 0){
					/*$log = array(
                        'uniacid'       => $uniacid,
                        'uid'           => $member['id'],
                        'gold'			=> $info['gold'],
                        'budget'		=> 2,//不产生统计
                        'type' 			=> 3,
                        'createtime' 	=> time(),
                        'title' 		=> '卖出',
                        'rid' 			=> $info['id'],
                    );
                  	pdo_insert("wx_shop_sd_gold_log",$log);//钱包记录*/

					pdo_update('wx_shop_sd_gold_log', array('status' => 1, 'updatetime' => time(), 'type' => 3, 'title' => '卖出'), array('id' => $info['id']));
					flock($fp,LOCK_UN);
            		fclose($fp);
					show_json(1, array('url' => referer()));
				}
			}else{
				$result = $sd_model->setGold($member['id'], $member['openid'], 'credit2', $info['gold'], 1, $info['id'], 31);
				if($result){
					pdo_update('wx_shop_sd_gold_log', array('status' => 2, 'updatetime' => time()), array('id' => $info['id']));
					flock($fp,LOCK_UN);
	                fclose($fp);
	                show_json(1, array('url' => referer()));
				}else{
					flock($fp,LOCK_UN);
	                fclose($fp);
	                show_json(1, '系统繁忙');
				}
			}
		}
		
		show_json(0, '请勿重复点击');
	}

	/**
	 * [newsPush 提现充值消息推送]
	 * @return [type] [description]
	 */
	public function newsPush()
	{
		global $_W;
		global $_GPC;
		$uniacid = intval($_W['uniacid']);
		$withdrawal = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and status = 0 and type = 32 ', array(':uniacid' => $uniacid));
		$recharge = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_recharge_list') . ' where uniacid = :uniacid and status = 0 ', array(':uniacid' => $uniacid));
		show_json(1,array('withdrawal'=>$withdrawal,'recharge'=>$recharge));
	}
}
?>