<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Log_WxShopPage extends WebPage
{
	protected function main($type = 0) 
	{
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and log.uniacid=:uniacid and log.type=:type and log.money<>0';
		$condition1 = '';
		$condition2 = '';
		$params = array(':uniacid' => $_W['uniacid'], ':type' => $type);

		$title = pdo_fetchall('SELECT title,rechargetype FROM'.tablename('wx_shop_member_log')."WHERE uniacid=:uniacid GROUP BY title ",[':uniacid'=>$_W['uniacid']]);
		// var_dump($title);die;
		if (!(empty($_GPC['keyword']))) 
		{
			$_GPC['keyword'] = trim($_GPC['keyword']);
			if ($_GPC['searchfield'] == 'logno') 
			{
				$condition .= ' and log.logno like :keyword';
			}
			else if ($_GPC['searchfield'] == 'member') 
			{
				$condition1 .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
			}
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}
		if (empty($starttime) || empty($endtime)) 
		{
			$starttime = strtotime('-1 month');
			$endtime = time();
		}
		if (!(empty($_GPC['time']['start'])) && !(empty($_GPC['time']['end']))) 
		{
			$starttime = strtotime($_GPC['time']['start']);
			$endtime = strtotime($_GPC['time']['end']);
			$condition .= ' AND log.createtime >= :starttime AND log.createtime <= :endtime ';
			$condition2 .= ' AND createtime >= :starttime AND createtime <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
			$params1[':starttime'] = $starttime;
			$params1[':endtime'] = $endtime;
		}
		if (!(empty($_GPC['level']))) 
		{
			$condition1 .= ' and m.level=' . intval($_GPC['level']);
		}

		if (!(empty($_GPC['groupid']))) 
		{
			$condition1 .= ' and m.groupid=' . intval($_GPC['groupid']);
		}
		$member_sql = '';
		if ($condition1 != '') 
		{
			$member_sql = ' and openid IN (SELECT openid FROM ims_wx_shop_member WHERE uniacid = :uniacid ' . $condition1 . ') OR openid IN (SELECT CONCAT(\'sns_wa_\',openid_wa) FROM ims_wx_shop_member WHERE uniacid = :uniacid ' . $condition1 . ')';
		}
		if (!(empty($_GPC['rechargetype']))) 
		{
			$_GPC['rechargetype'] = trim($_GPC['rechargetype']);
			if ($_GPC['rechargetype'] == 'system1') 
			{
				$condition .= ' AND log.rechargetype=\'system\' and log.money<0';
			}
			else 
			{
				$condition .= ' AND log.rechargetype=:rechargetype';
				$params[':rechargetype'] = $_GPC['rechargetype'];
			}
		}
		if ($_GPC['status'] != '') 
		{
			$condition .= ' and log.status=' . intval($_GPC['status']);
		}
		if ($_GPC['genre'] != '') 
		{	
			$condition .= ' and log.genre=' . intval($_GPC['genre']);
		}


		$listd = pdo_fetch('select sum(if(status=0,money,0)) as money0,sum(if(status=1,money,0)) as money1,sum(if(status=3,money,0)) as money3,sum(if(status=-1,money,0)) as money4 from '.tablename('wx_shop_member_log').' where 1 '.$condition2,$params1);
		


		$sql = 'select log.id,log.openid,log.title,log.genre,log.weixin,log.logno,log.type,log.status,log.rechargetype,log.sendmoney,log.money,log.createtime,log.realmoney,log.deductionmoney,log.charge,log.remark,log.alipay,log.bankname,log.bankcard,log.realname as applyrealname,log.applytype,log.weixin as weixin_log,m.nickname,m.id as mid,m.avatar,m.level,m.groupid,m.realname,m.mobile,g.groupname,l.levelname,log.imgs from ' . tablename('wx_shop_member_log') . ' log ' . ' left join ' . tablename('wx_shop_member') . ' m on m.openid = log.openid ' . ' left join ' . tablename('wx_shop_member_group') . ' g on g.id = m.groupid ' . ' left join ' . tablename('wx_shop_member_level') . ' l on l.id = m.level ' . ' where 1 ' . $condition . ' ' . $condition1 . ' GROUP BY log.id ORDER BY log.createtime DESC ';
		if (empty($_GPC['export'])) 
		{
			$sql .= 'LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		}
		$list = pdo_fetchall($sql, $params);
		$apply_type = array(0 => '微信', 2 => '支付宝', 3 => '银行卡');
		if (!(empty($list))) 
		{
			$openids = array();
			$czmoney = 0;
			$czmoney1 = 0;  
			foreach ($list as $key => &$value ) 
			{	
				
				$list[$key]['typestr'] = $apply_type[$value['applytype']];
				if ($value['deductionmoney'] == 0) 
				{
					$list[$key]['realmoney'] = $value['money'];
				}
				if (!(strexists($value['openid'], 'sns_wa_'))) 
				{
					array_push($openids, $value['openid']);
				}
				else 
				{
					array_push($openids, substr($value['openid'], 7));
				}

				if($value['money']>0){

					$czmoney += $value['money'];

				}

				if($value['money']<0){

					$czmoney1 += $value['money'];

				}


			}
			$members_sql = 'select id as mid, realname,avatar,weixin,nickname,mobile,openid,openid_wa from ' . tablename('wx_shop_member') . ' where uniacid=:uniacid and openid IN (\'' . implode('\',\'', array_unique($openids)) . '\') OR openid_wa IN (\'' . implode('\',\'', array_unique($openids)) . '\')';
			$members = pdo_fetchall($members_sql, array(':uniacid' => $_W['uniacid']), 'openid');
			$rs = array();
			if (!(empty($members))) 
			{
				foreach ($members as $key => &$row ) 
				{
					if (!(empty($row['openid_wa']))) 
					{
						$rs['sns_wa_' . $row['openid_wa']] = $row;
					}
					else 
					{
						$rs[] = $row;
					}
				}
			}
			$member_openids = array_keys($members);
			foreach ($list as $key => $value ) 
			{
				if (in_array($list[$key]['openid'], $member_openids)) 
				{
					$list[$key] = array_merge($list[$key], $members[$list[$key]['openid']]);
				}
				else 
				{
					$list[$key] = array_merge($list[$key], (isset($rs[$list[$key]['openid']]) ? $rs[$list[$key]['openid']] : array()));
				}
			}
		}
		if ($_GPC['export'] == 1) 
		{
			if ($_GPC['type'] == 1) 
			{
				plog('finance.log.withdraw.export', '导出提现记录');
			}
			else 
			{
				plog('finance.log.recharge.export', '导出充值记录');
			}
			foreach ($list as &$row ) 
			{
				$row['createtime'] = date('Y-m-d H:i', $row['createtime']);
				$row['groupname'] = ((empty($row['groupname']) ? '无分组' : $row['groupname']));
				$row['levelname'] = ((empty($row['levelname']) ? '普通会员' : $row['levelname']));
				$row['typestr'] = $apply_type[$row['applytype']];
				if ($row['status'] == 0) 
				{
					if ($row['type'] == 0) 
					{
						$row['status'] = '未充值';
					}
					else 
					{
						$row['status'] = '申请中';
					}
				}
				else if ($row['status'] == 1) 
				{
					if ($row['type'] == 0) 
					{
						$row['status'] = '充值成功';
					}
					else 
					{
						$row['status'] = '完成';
					}
				}
				else if ($row['status'] == -1) 
				{
					if ($row['type'] == 0) 
					{
						$row['status'] = '';
					}
					else 
					{
						$row['status'] = '失败';
					}
				}
				if ($row['rechargetype'] == 'system') 
				{
					$row['rechargetype'] = '后台';
				}
				else if ($row['rechargetype'] == 'wechat') 
				{
					$row['rechargetype'] = '微信';
				}
				else if ($row['rechargetype'] == 'alipay') 
				{
					$row['rechargetype'] = '支付宝';
				}
			}
			unset($row);
			$columns = array();
			$columns[] = array('title' => '昵称', 'field' => 'nickname', 'width' => 12);
			$columns[] = array('title' => '姓名', 'field' => 'realname', 'width' => 12);
			$columns[] = array('title' => '手机号', 'field' => 'mobile', 'width' => 12);
			$columns[] = array('title' => '会员等级', 'field' => 'levelname', 'width' => 12);
			$columns[] = array('title' => '会员分组', 'field' => 'groupname', 'width' => 12);
			$columns[] = array('title' => (empty($type) ? '充值金额' : '提现金额'), 'field' => 'money', 'width' => 12);
			if (!(empty($type))) 
			{
				$columns[] = array('title' => '到账金额', 'field' => 'realmoney', 'width' => 12);
				$columns[] = array('title' => '手续费金额', 'field' => 'deductionmoney', 'width' => 12);
				$columns[] = array('title' => '提现方式', 'field' => 'typestr', 'width' => 12);
				$columns[] = array('title' => '提现姓名', 'field' => 'applyrealname', 'width' => 24);
				$columns[] = array('title' => '支付宝', 'field' => 'alipay', 'width' => 24);
				$columns[] = array('title' => '银行', 'field' => 'bankname', 'width' => 24);
				$columns[] = array('title' => '银行卡号', 'field' => 'bankcard', 'width' => 24);
				$columns[] = array('title' => '申请时间', 'field' => 'applytime', 'width' => 24);
			}
			$columns[] = array('title' => (empty($type) ? '充值时间' : '提现申请时间'), 'field' => 'createtime', 'width' => 12);
			if (empty($type)) 
			{
				$columns[] = array('title' => '充值方式', 'field' => 'rechargetype', 'width' => 12);
			}
			$columns[] = array('title' => '备注', 'field' => 'remark', 'width' => 24);
			m('excel')->export($list, array('title' => ((empty($type) ? '会员充值数据-' : '会员提现记录')) . date('Y-m-d-H-i', time()), 'columns' => $columns));
		}
		$total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_member_log') . ' log ' . ' where 1 ' . $condition . ' ' . $member_sql, $params);
		$pager = pagination2($total, $pindex, $psize);
		$groups = m('member')->getGroups();
		$levels = m('member')->getLevels();
		include $this->template();
	}
	public function refund($tid = 0, $fee = 0, $reason = '') 
	{
		global $_W;
		global $_GPC;
		$set = $_W['shopset']['shop'];
		$id = intval($_GPC['id']);
		$log = pdo_fetch('select * from ' . tablename('wx_shop_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (empty($log)) 
		{
			show_json(0, '未找到记录!');
		}
		if (!(empty($log['type']))) 
		{
			show_json(0, '非充值记录!');
		}
		if ($log['rechargetype'] == 'system') 
		{
			show_json(0, '后台充值无法退款!');
		}
		$current_credit = m('member')->getCredit($log['openid'], 'credit2');
		if ($current_credit < $log['money']) 
		{
			show_json(0, '会员账户余额不足，无法进行退款!');
		}
		$out_refund_no = 'RR' . substr($log['logno'], 2);
		if ($log['rechargetype'] == 'wechat') 
		{
			if (empty($log['isborrow'])) 
			{
				$result = m('finance')->refund($log['openid'], $log['logno'], $out_refund_no, $log['money'] * 100, $log['money'] * 100, (!(empty($log['apppay'])) ? true : false));
			}
			else 
			{
				$result = m('finance')->refundBorrow($log['openid'], $log['logno'], $out_refund_no, $log['money'] * 100, $log['money'] * 100);
			}
		}
		else if ($log['rechargetype'] == 'alipay') 
		{
			$sec = m('common')->getSec();
			$sec = iunserializer($sec['sec']);
			if (!(empty($log['apppay']))) 
			{
				if (empty($sec['app_alipay']['private_key']) || empty($sec['app_alipay']['appid'])) 
				{
					show_json(0, '支付参数错误，私钥为空或者APPID为空!');
				}
				$params = array('out_trade_no' => $log['logno'], 'refund_amount' => $log['money'], 'refund_reason' => '会员充值退款: ' . $log['money'] . '元 订单号: ' . $log['logno'] . '/' . $out_refund_no);
				$config = array('app_id' => $sec['app_alipay']['appid'], 'privatekey' => $sec['app_alipay']['private_key'], 'publickey' => '', 'alipublickey' => '');
				$result = m('finance')->newAlipayRefund($params, $config);
			}
			else 
			{
				if (empty($log['transid'])) 
				{
					show_json(0, '仅支持 升级后此功能后退款的订单!');
				}
				$setting = uni_setting($_W['uniacid'], array('payment'));
				if (!(is_array($setting['payment']))) 
				{
					return error(1, '没有设定支付参数');
				}
				$alipay_config = $setting['payment']['alipay'];
				$batch_no_money = $log['money'] * 100;
				$batch_no = date('Ymd') . 'RC' . $log['id'] . 'MONEY' . $batch_no_money;
				$res = m('finance')->AlipayRefund(array('trade_no' => $log['transid'], 'refund_price' => $log['money'], 'refund_reason' => '会员充值退款: ' . $log['money'] . '元 订单号: ' . $log['logno'] . '/' . $out_refund_no), $batch_no, $alipay_config);
				if (is_error($res)) 
				{
					show_json(0, $res['message']);
				}
				show_json(1, array('url' => $res));
			}
		}
		else 
		{
			$result = m('finance')->pay($log['openid'], 1, $log['money'] * 100, $out_refund_no, $set['name'] . '充值退款');
		}
		if (is_error($result)) 
		{
			show_json(0, $result['message']);
		}
		pdo_update('wx_shop_member_log', array('status' => 3), array('id' => $id, 'uniacid' => $_W['uniacid']));
		$refundmoney = $log['money'] + $log['gives'];
		m('member')->setCredit($log['openid'], 'credit2', -$refundmoney, array(0, $set['name'] . '充值退款'));
		$money = com_run('sale::getCredit1', $log['openid'], (double) $log['money'], 21, 2, 1);
		if (0 < $money) 
		{
			m('notice')->sendMemberPointChange($log['openid'], $money, 1);
		}
		m('notice')->sendMemberLogMessage($log['id']);
		$member = m('member')->getMember($log['openid']);
		plog('finance.log.refund', '充值退款 ID: ' . $log['id'] . ' 金额: ' . $log['money'] . ' <br/>会员信息:  ID: ' . $member['id'] . ' / ' . $member['openid'] . '/' . $member['nickname'] . '/' . $member['realname'] . '/' . $member['mobile']);
		show_json(1, array('url' => referer()));
	}
	public function wechat() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$log = pdo_fetch('select * from ' . tablename('wx_shop_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (empty($log)) 
		{
			show_json(0, '未找到记录!');
		}
		if ($log['deductionmoney'] == 0) 
		{
			$realmoney = $log['money'];
		}
		else 
		{
			$realmoney = $log['realmoney'];
		}
		$set = $_W['shopset']['shop'];
		$data = m('common')->getSysset('pay');
		if (!(empty($data['paytype']['withdraw']))) 
		{
			$result = m('finance')->payRedPack($log['openid'], $realmoney * 100, $log['logno'], $log, $set['name'] . '余额提现', $data['paytype']);
			pdo_update('wx_shop_member_log', array('sendmoney' => $result['sendmoney'], 'senddata' => json_encode($result['senddata'])), array('id' => $log['id']));
			if ($result['sendmoney'] == $realmoney) 
			{
				$result = true;
			}
			else 
			{
				$result = $result['error'];
			}
		}
		else 
		{
			$result = m('finance')->pay($log['openid'], 1, $realmoney * 100, $log['logno'], $set['name'] . '余额提现');
		}
		if (is_error($result)) 
		{
			show_json(0, array('message' => $result['message']));
		}
		pdo_update('wx_shop_member_log', array('status' => 1), array('id' => $id, 'uniacid' => $_W['uniacid']));
		m('notice')->sendMemberLogMessage($log['id']);
		$member = m('member')->getMember($log['openid']);
		plog('finance.log.wechat', '余额提现 ID: ' . $log['id'] . ' 方式: 微信 提现金额: ' . $log['money'] . ' ,到账金额: ' . $realmoney . ' ,手续费金额 : ' . $log['deductionmoney'] . '<br/>会员信息:  ID: ' . $member['id'] . ' / ' . $member['openid'] . '/' . $member['nickname'] . '/' . $member['realname'] . '/' . $member['mobile']);
		show_json(1);
	}
	public function alipay() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$log = pdo_fetch('select * from ' . tablename('wx_shop_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (empty($log)) 
		{
			show_json(0, '未找到记录!');
		}
		if ($log['deductionmoney'] == 0) 
		{
			$realmoeny = $log['money'];
		}
		else 
		{
			$realmoeny = $log['realmoney'];
		}
		$set = $_W['shopset']['shop'];
		$sec = m('common')->getSec();
		$sec = iunserializer($sec['sec']);
		if (!(empty($sec['alipay_pay']['open']))) 
		{
			$batch_no_money = $realmoeny * 100;
			$batch_no = 'D' . date('Ymd') . 'RW' . $log['id'] . 'MONEY' . $batch_no_money;
			$res = m('finance')->AliPay(array('account' => $log['alipay'], 'name' => $log['realname'], 'money' => $realmoeny), $batch_no, $sec['alipay_pay'], $log['title']);
			if (is_error($res)) 
			{
				show_json(0, $res['message']);
			}
			show_json(1, array('url' => $res));
		}
		show_json(0, '未开启,支付宝打款!');
	}
	public function manual() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$log = pdo_fetch('select * from ' . tablename('wx_shop_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (empty($log)) 
		{
			show_json(0, '未找到记录!');
		}
		$member = m('member')->getMember($log['openid']);
		pdo_update('wx_shop_member_log', array('status' => 1), array('id' => $id, 'uniacid' => $_W['uniacid']));
		m('notice')->sendMemberLogMessage($log['id']);
		plog('finance.log.manual', '余额提现 方式: 手动 ID: ' . $log['id'] . ' <br/>会员信息: ID: ' . $member['id'] . ' / ' . $member['openid'] . '/' . $member['nickname'] . '/' . $member['realname'] . '/' . $member['mobile']);
		show_json(1);
	}
	public function refuse() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$log = pdo_fetch('select * from ' . tablename('wx_shop_member_log') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (empty($log)) 
		{
			show_json(0, '未找到记录!');
		}

		$redis = redis();
        $key = 'tx1'.$openid;
        if(empty($redis->get($key))){
            $setex = $redis -> setex($key,2,1);
        }else if(!empty($redis->get($key))){
            show_json(0,'请勿快速点击');
        }

		pdo_update('wx_shop_member_log', array('status' => -1), array('id' => $id, 'uniacid' => $_W['uniacid']));
		if (0 < $log['money']) 
		{
			if($log['genre'] == 1){
				m('member')->setCredit($log['openid'], 'credit_commission', $log['money'], array(0, $set['name'] . '佣金提现退回'));
			}else{
				m('member')->setCredit($log['openid'], 'credit2', $log['money'], array(0, $set['name'] . '余额提现退回'));
			}
		}
		$this->credit2_log($log['openid'],$log['money'],['title'=>'提现失败退款','rechargetype'=>'txsb'],0,$level);
		m('notice')->sendMemberLogMessage($log['id']);
		plog('finance.log.refuse', '拒绝余额度提现 ID: ' . $log['id'] . ' 金额: ' . $log['money'] . ' <br/>会员信息:  ID: ' . $member['id'] . ' / ' . $member['openid'] . '/' . $member['nickname'] . '/' . $member['realname'] . '/' . $member['mobile']);
		show_json(1);
	}
	public function recharge() 
	{
		$this->main(0);
	}
	public function withdraw() 
	{
		$this->main(1);
	}

	public function countwithdraw(){
		global $_W;
		global $_GPC;

		// file_put_contents(dirname(__FILE__).'/dsads1',json_encode($_GPC));

		$txcount = pdo_fetchcolumn('SELECT count(id) FROM'.tablename('wx_shop_member_log').'WHERE uniacid=:uniacid AND type=1 AND status= 0 ',[':uniacid'=>$_W['uniacid']]);

		$czcount = pdo_fetchcolumn('SELECT COUNT(id) FROM'.tablename('wx_shop_topup_check').'WHERE uniacid=:uniacid AND status=0 ',[':uniacid'=>$_W['uniacid']]);

		$dlcount = pdo_fetchcolumn('SELECT COUNT(id) FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND isaagent=1 AND aagentstatus=0 ',[':uniacid'=>$_W['uniacid']]);

		$yjcount = pdo_fetchcolumn('SELECT COUNT(id) FROM'.tablename('7033_yjjiedong').'WHERE uniacid=:uniacid AND status = 1 ',[':uniacid'=>$_W['uniacid']]);


		show_json(1,['txcount'=>$txcount,'czcount'=>$czcount,'dlcount'=>$dlcount,'yjcount'=>$yjcount]);

	}

	// public function chushihua(){
	// 	global $_W;
	// 	global $_GPC;

	// 	$txcount = pdo_fetchcolumn('SELECT count(id) FROM'.tablename('wx_shop_member_log').'WHERE uniacid=:uniacid AND type=1 AND status= 0 ',[':uniacid'=>$_W['uniacid']]);

	// 	show_json(1,['txcount'=>$txcount]);
	// }

	public function check(){
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and c.uniacid=:uniacid ';
		$condition1 = '';
		$condition2 = 'and uniacid=:uniacid ';
		$params = array(':uniacid' => $_W['uniacid']);

		if (!(empty(intval($_GPC['status'])))) 
		{
			$condition1 .= ' and c.status=:status';
			$condition2 .= ' and status=:status';
			$params[':status'] = intval($_GPC['status']);
		}
		if (!(empty($_GPC['createtime']['start'])) && !(empty($_GPC['createtime']['end']))) 
		{
			$starttime = strtotime($_GPC['createtime']['start']);
			$endtime = strtotime($_GPC['createtime']['end']);
			$condition1 .= ' AND c.createtime >= :starttime AND c.createtime <= :endtime ';
			$condition2 .= ' AND createtime >= :starttime AND createtime <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}

		if (!(empty($_GPC['check_time']['start'])) && !(empty($_GPC['check_time']['end']))) 
		{
			$starttime1 = strtotime($_GPC['check_time']['start']);
			$endtime1 = strtotime($_GPC['check_time']['end']);
			$condition1 .= ' AND c.check_time >= :starttime1 AND c.check_time <= :endtime1 ';
			$condition2 .= ' AND check_time >= :starttime1 AND check_time <= :endtime1 ';
			$params[':starttime1'] = $starttime1;
			$params[':endtime1'] = $endtime1;
		}


		$listd = pdo_fetch('select sum(if(status=0,money,0)) as money0,sum(if(status=1,money,0)) as money1,sum(if(status=2,money,0)) as money2 from '.tablename('wx_shop_topup_check').' where 1 '.$condition2,$params);


		if (!(empty($_GPC['keyword']))) 
		{
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition1 .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}


		$sql = 'select c.id,c.openid,c.type,c.bankname,c.realname,c.branch,c.bankcard,c.money,c.image,c.status,c.remark,c.check_time,c.createtime,m.nickname,m.id as mid,m.avatar,m.level,m.groupid,m.realname,m.mobile from '. tablename('wx_shop_topup_check') . ' c left join '.tablename('wx_shop_member').' m on c.openid=m.openid where 1 '.$condition.' '.$condition1.' order by c.id desc';
		$sql .= ' LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		$list = pdo_fetchall($sql,$params);
		$total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_topup_check') . ' c ' . ' where 1 ' . $condition . ' ' .$condition1, $params);
		$pager = pagination2($total, $pindex, $psize);

		include $this->template();
	}

	public function check_credit(){
		global $_W;
		global $_GPC;
		$id =  intval($_GPC['id']);
		$status =  intval($_GPC['status']);
		$check = pdo_fetch('select c.*,m.agentid,m.effective from '. tablename('wx_shop_topup_check') .'c left join ' .tablename('wx_shop_member'). ' m on c.openid=m.openid where c.id = :id and c.status = 0 limit 1',array(':id'=>$id));
		$data = m('common')->getSysset('grabsingle');

		$redis = redis();
        $key = 'tx1'.$openid;
        if(empty($redis->get($key))){
            $setex = $redis -> setex($key,2,1);
        }else if(!empty($redis->get($key))){
            show_json(0,'请勿快速点击');
        }

		if($check['status']==1){
			show_json(0,'该订单已经审核过了');
		}

		if(!$check){
			show_json(0,'未找到该充值订单');
		}

		if($check){
			if($status == 2){
				pdo_update('wx_shop_topup_check',array('status'=>2,'check_time'=>time()),array('id'=>$id));
			}else{
				if(pdo_update('wx_shop_topup_check',array('status'=>1,'check_time'=>time()),array('id'=>$id))){
					if($check['money'] > 0){
						// m('member')->setCredit($check['openid'],'credit2', $check['money'], array($_W['uid'], '用户审核通过充值'));
						pdo_update('wx_shop_member',array('credit2 +='=>$check['money'],'effective'=>1),array('openid'=>$check['openid']));
						 //充值记录
                    	$this->credit2_log($check['openid'],$check['money'],['title'=>'充值成功','rechargetype'=>'cczcg'],0,$level);

						if($check['agentid'] and $check['effective'] == 0){
							$add_limit = pdo_fetchcolumn('select add_limit from '.tablename('wx_shop_member').' where id = '.$check['agentid']);
							if($add_limit+$data['add_limit'] < $data['max_number']){
								pdo_update('wx_shop_member',array('add_limit +='=>$data['add_limit'],'effective'=>1),array('id'=>$check['agentid']));
							}else{
								$add_limit1 = $data['max_number']-$add_limit;
								pdo_update('wx_shop_member',array('add_limit +='=>$add_limit1,'effective'=>1),array('id'=>$check['agentid']));
							}
						}
					}
				}
			}

		}
		m('member')->setonline("123456",'tixian');
		show_json(1, array('url' => referer()));
	}
	//押金解冻
	public function bzjjd(){
		global $_W;
		global $_GPC;

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and y.uniacid=:uniacid AND y.status > 0 ';
		$params = array(':uniacid' => $_W['uniacid']);

		$sql = 'SELECT y.*,m.realname,m.mobile,m.aagentprovinces,m.aagentcitys FROM'.tablename('7033_yjjiedong').'y left join '.tablename('wx_shop_member').' m on m.id=y.uid '.'WHERE 1 '.$condition.'order by tjtime DESC';
		$sql .= ' LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;

		$list = pdo_fetchall($sql,$params);
		$money = 0;
		$money1 = 0;
		foreach ($list as $key => &$value) {
			if($value['status']==2){
				$money += $value['money'];
			}elseif($value['status']==1){

				$money1 += $value['money'];
			}

			if($value['type']==1){
				$value['dlcs'] = unserialize($value['aagentprovinces']);
			}else if($value['type']==2){
				$value['dlcs'] = unserialize($value['aagentcitys']);
			}

		}
		// var_dump($list);die;
		
		include $this->template();
		
	}

	//理财明显
	public function lcmx(){
		global $_W;
		global $_GPC;

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and y.uniacid=:uniacid ';
		$params = array(':uniacid' => $_W['uniacid']);
		$sql = 'SELECT y.*,m.realname,m.mobile,m.aagentprovinces,m.aagentcitys FROM'.tablename('7202_licaisy').'y left join '.tablename('wx_shop_member').' m on m.id=y.uid '.'WHERE 1 '.$condition.'order by id DESC';
		$sql .= ' LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;

		$list = pdo_fetchall($sql,$params);

		foreach ($list as $key => &$value) {
			
			$dqtime = $value['tjtime']+($value['syts']+60*60*24);

			$value['dqtime'] = date('Y-m-d H:i:s',$dqtime); 

		// var_dump($dqtime);
		}

		$total = count($list);
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();

	}

	//押金解冻审核
	public function shbzjjd(){
		global $_W;
		global $_GPC;
		
		$id = $_GPC['id'];

		$yjjiedong = pdo_fetch('SELECT id,uid,money,type FROM'.tablename('7033_yjjiedong').'WHERE uniacid=:uniacid AND id=:id AND status = 1 ',[':uniacid'=>$_W['uniacid'],':id'=>$id]);

		$member = pdo_fetch('SELECT id,openid,credit3,deposit,account FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND id=:id ',[':uniacid'=>$_W['uniacid'],':id'=>$yjjiedong['uid']]);

		if(!$yjjiedong){

			show_json(0,'未找到该解冻申请');
		}

		if($_GPC['status']==2){

			pdo_update('7033_yjjiedong',['status'=>'2','uptime'=>time()],['id'=>$id]);
			if($yjjiedong['type']==1){

				pdo_update('wx_shop_member',['credit3'=>$member['credit3']-$yjjiedong['money'],'deposit'=>$member['deposit']-$yjjiedong['money'],'isaagent' => 0, 'aagentstatus' => 0,'aagentprovinces'=>''],['id'=>$member['id']]);

			}else if($yjjiedong['type']==2){

				pdo_update('wx_shop_member',['credit3'=>$member['credit3']-$yjjiedong['money'],'deposit'=>$member['deposit']-$yjjiedong['money'],'isaagent' => 0, 'aagentstatus' => 0,'aagentcitys'=>''],['id'=>$member['id']]);

			}else if($yjjiedong['type']==3){

				pdo_update('wx_shop_member',['account'=>$member['account']-$yjjiedong['money']],['id'=>$member['id']]);

			}

			//扣押金
			m('member')->setCredit($member['openid'], 'credit2', $yjjiedong['money'], array($_W['uid'], '保证金解冻' .'保证金'));

			//记录
            $this->credit2_log($member['openid'],$yjjiedong['money'],['title'=>'保证金解冻','rechargetype'=>'bzjjd'],0);

		}

		m('member')->setonline("123456",'tixian');

		show_json(1,'审核成功');

	}

	public function credit2_log($openid,$num,$arr=[],$genre,$level){
        global $_W;
        $ordersn = m('common')->createNO('order', 'ordersn', 'RC');

        $data= 
        [
            'uniacid'=>$_W['uniacid'],
            'openid' =>$openid,
            'type' => 0,
            'logno'=>$ordersn,
            'title'=>$arr['title'],
            'createtime'=>time(),
            'status'=>1,
            'money'=>$num,
            'rechargetype'=>$arr['rechargetype'],
            'genre'=>$genre,
            'level'=>$level,

        ];

        pdo_insert('wx_shop_member_log',$data);

    }

	public function credit2(){
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and c.uniacid=:uniacid ';
		$condition1 = '';
		$params = array(':uniacid' => $_W['uniacid']);
		if (!(empty($_GPC['keyword']))) 
		{
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition1 .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword )';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}
		if (!(empty(intval($_GPC['type'])))) 
		{
			$condition1 .= ' and c.type=:type';
			$params[':type'] = intval($_GPC['type']);
		}
		if (!(empty($_GPC['createtime']['start'])) && !(empty($_GPC['createtime']['end']))) 
		{
			$starttime = strtotime($_GPC['createtime']['start']);
			$endtime = strtotime($_GPC['createtime']['end']);
			$condition1 .= ' AND c.createtime >= :starttime AND c.createtime <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}


		$sql = 'select c.id,c.openid,c.type,c.orderid,c.money,c.createtime,m.nickname,m.id as mid,m.avatar,m.level,m.groupid,m.realname,m.mobile,o.ordersn from '. tablename('wx_shop_member_credit_log') . ' c left join '.tablename('wx_shop_member').' m on c.openid=m.openid left join '.tablename('wx_shop_order').' o on o.id = c.orderid where 1 '.$condition.' '.$condition1.' order by c.id desc';
		$sql .= ' LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;
		$list = pdo_fetchall($sql,$params);
		$money = 0;
		$money1 = 0;
		foreach ($list as $key => $value) {
			if($value['money']<0){
				$money1 += $value['money'];
			}
			if($value['money']>0){
				$money += $value['money'];
			}

		}


		$total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_member_credit_log') . ' c left join '.tablename('wx_shop_member').' m on c.openid = m.openid' . ' where 1 ' . $condition . ' ' .$condition1, $params);
		$pager = pagination2($total, $pindex, $psize);

		include $this->template();
	}

	public function credit_commission(){
		global $_W;
		global $_GPC;

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = ' and c.uniacid=:uniacid ';
		$condition1 = '';
		$params = array(':uniacid' => $_W['uniacid']);
		if (!(empty($_GPC['issuetime']['start'])) && !(empty($_GPC['issuetime']['end']))) 
		{
			$starttime = strtotime($_GPC['issuetime']['start']);
			$endtime = strtotime($_GPC['issuetime']['end']);
			$condition1 .= ' AND c.issuetime >= :starttime AND c.issuetime <= :endtime ';
			$params[':starttime'] = $starttime;
			$params[':endtime'] = $endtime;
		}
		if (!(empty($_GPC['keyword']))) 
		{
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition1 .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
		}

		$sql = 'select c.money,FROM_UNIXTIME(c.issuetime,"%Y-%m-%d") as day,c.openid,m.nickname,m.id as mid,m.avatar,m.level,m.groupid,m.realname,m.mobile from '.tablename('wx_shop_member_commission').'c left join '.tablename('wx_shop_member').' m on c.openid = m.openid where c.issue = 1 '.$condition.' '.$condition1 .' order by c.issuetime desc ';
		// $sql .= ' LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize;

		$list = pdo_fetchall($sql,$params);

		// var_dump($list);
		// $total = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_member_commission') . ' c left join '.tablename('wx_shop_member').' m on c.openid = m.openid' . ' where 1 ' . $condition . ' ' .$condition1, $params);

		

		$data = array();
		foreach($list as $key=>$val){
			$data[$val['openid']][$key] = $val;
		}
		$data1 = array();
		foreach($data as $key=>$val){
			foreach($val as $k=>$v){
				$data1[$key][$v['day']] = $v;

				$data1[$key][$v['day']]['money'] += $v['money'];
			}
		}
		$data2 = array();
		foreach($data1 as $value){  
			foreach($value as $v){  
				 $data2[]=$v;  
			}  
		}
		$money =0;
		foreach ($data2 as $a => $b) {
			
			$money += $b['money'];

		}
		$total = count($data2);
		// var_dump($data2);die;
		$pager = pagination2($total, $pindex, $psize);
		include $this->template();
	}
}
?>