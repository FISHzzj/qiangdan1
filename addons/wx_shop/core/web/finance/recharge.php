<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Recharge_WxShopPage extends WebPage 
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$type = trim($_GPC['type']);
		if (!(cv('finance.recharge.' . $type))) 
		{
			$this->message('你没有相应的权限查看');
		}
		$id = intval($_GPC['id']);
		$profile = m('member')->getMember($id, true);
		if ($_W['ispost']) 
		{

			$typestr = (($type == 'credit2' ? '余额' : '押金'));
			$num = floatval($_GPC['num']);
			$remark = trim($_GPC['remark']);
			if ($num <= 0) 
			{
				show_json(0, array('message' => '请填写大于0的数字!'));
			}
			$changetype = intval($_GPC['changetype']);
			$paytype = 21;
			if ($changetype == 2) 
			{
				$num -= $profile[$type];
			}
			else if ($changetype == 1) 
			{	
				$paytype = 22;
				$num = -$num;
			}
			// var_dump($type);die;
			if($type =='credit3'){
				if($changetype == 0){
					$nums = -floatval($_GPC['num']);
					m('member')->setCredit($profile['openid'], 'credit2', $nums, array($_W['uid'], '后台会员充值' . $typestr . ' ' . $remark));
				}else if($changetype == 1){
					$nums = floatval($_GPC['num']);
					// var_dump($nums);
					m('member')->setCredit($profile['openid'], 'credit2', $nums, array($_W['uid'], '后台会员充值' . $typestr . ' ' . $remark));
				}

			}
			// var_dump($num);die;
			// m('member')->setCredit($profile['openid'], $type, $num, array($_W['uid'], '后台会员充值' . $typestr . ' ' . $remark));
			$sd_model = m('sd_model');
			$sd_model->setGold($profile['id'], $$profile['openid'], $type, $num, 1, 0, $paytype);
			
			$changetype = 0;
			$changenum = 0;
			if (0 <= $num) 
			{
				$changetype = 0;
				$changenum = $num;
			}
			else 
			{
				$changetype = 1;
				$changenum = -$num;
			}
			if ($type == 'credit1') 
			{
				m('notice')->sendMemberPointChange($profile['openid'], $changenum, $changetype);
			}
			if ($type == 'credit2') 
			{
				$set = m('common')->getSysset('shop');
				$logno = m('common')->createNO('member_log', 'logno', 'RC');
				$data = array('openid' => $profile['openid'], 'logno' => $logno, 'uniacid' => $_W['uniacid'], 'type' => '0', 'createtime' => TIMESTAMP, 'status' => '1', 'title' => $set['name'] . '会员充值', 'money' => $num, 'remark' => $remark, 'rechargetype' => 'system');
				pdo_insert('wx_shop_member_log', $data);
				$logid = pdo_insertid();
				m('notice')->sendMemberLogMessage($logid, 0, true);
			}else if($type == 'credit3'){

				$set = m('common')->getSysset('shop');
				$logno = m('common')->createNO('member_log', 'logno', 'RC');
				$data = array('openid' => $profile['openid'], 'logno' => $logno, 'uniacid' => $_W['uniacid'], 'type' => '0', 'createtime' => TIMESTAMP, 'status' => '1', 'title' => '余额转换押金', 'money' => $num, 'remark' => $remark, 'rechargetype' => 'yjsystem');
				pdo_insert('wx_shop_member_log', $data);
				$logid = pdo_insertid();
				m('notice')->sendMemberLogMessage($logid, 0, true);

			}
			plog('finance.recharge.' . $type, '充值' . $typestr . ': ' . $_GPC['num'] . ' <br/>会员信息: ID: ' . $profile['id'] . ' /  ' . $profile['openid'] . '/' . $profile['nickname'] . '/' . $profile['realname'] . '/' . $profile['mobile']);
			show_json(1, array('url' => referer()));
		}
		include $this->template();
	}
}
?>