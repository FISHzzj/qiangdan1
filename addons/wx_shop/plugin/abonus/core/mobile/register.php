<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
require WX_SHOP_PLUGIN . 'abonus/core/page_login_mobile.php';
class Register_WxShopPage extends AbonusMobileLoginPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$openid = $_GPC['openid'];
		$set = set_medias($this->set, 'regbg');
		$member = m('member')->getMember($openid);
		if (($member['isaagent'] == 1) && ($member['aagentstatus'] == 1)) 
		{
			header('location: ' . mobileUrl('abonus'));
			exit();
		}
		if ($member['agentblack'] || $member['aagentblack']) 
		{
			include $this->template();
			exit();
		}
		
		$apply_set = array();
		$apply_set['open_protocol'] = $set['open_protocol'];
		if (empty($set['applytitle'])) 
		{
			$apply_set['applytitle'] = '区域代理申请协议';
		}
		else 
		{
			$apply_set['applytitle'] = $set['applytitle'];
		}
		$template_flag = 0;
		$diyform_plugin = p('diyform');
		if ($diyform_plugin) 
		{
			$set_config = $diyform_plugin->getSet();
			$abonus_diyform_open = $set_config['abonus_diyform_open'];
			if ($abonus_diyform_open == 1) 
			{
				$template_flag = 1;
				$diyform_id = $set_config['abonus_diyform'];
				if (!(empty($diyform_id))) 
				{
					$formInfo = $diyform_plugin->getDiyformInfo($diyform_id);
					$fields = $formInfo['fields'];
					$diyform_data = iunserializer($member['diyaagentdata']);
					$f_data = $diyform_plugin->getDiyformData($diyform_data, $fields, $member);
				}
			}
		}
		if ($_W['ispost']) 
		{

			if ($set['become'] != '1') 
			{
				show_json(0, '未开启' . $set['texts']['agent'] . '注册!');
			}

			if ($template_flag == 1) 
			{
				$memberdata = $_GPC['memberdata'];
				$insert_data = $diyform_plugin->getInsertData($fields, $memberdata);
				$data = $insert_data['data'];
				$m_data = $insert_data['m_data'];
				$mc_data = $insert_data['mc_data'];
				$m_data['diyaagentid'] = $diyform_id;
				$m_data['diyaagentfields'] = iserializer($fields);
				$m_data['diyaagentdata'] = $data;
				$m_data['isaagent'] = 1;
				$m_data['aagentstatus'] = 0;
				$m_data['aagenttime'] = 0;
				unset($m_data['credit1']);
				unset($m_data['credit2']);
				pdo_update('wx_shop_member', $m_data, array('id' => $member['id']));
				if (!(empty($member['uid']))) 
				{
					if (!(empty($mc_data))) 
					{
						unset($mc_data['credit1']);
						unset($mc_data['credit2']);
						m('member')->mc_update($member['uid'], $mc_data);
					}
				}
			}
			else 
			{
			// var_dump($_GPC);die;
				$province = trim(str_replace(' ', '', $_GPC['province']));
				$city = trim(str_replace(' ', '', $_GPC['city']));

				// var_dump($province);die;

				$dls = pdo_fetchall('SELECT id,aagentprovinces,aagentcitys FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND aagentstatus=1 ',[':uniacid'=>$_W['uniacid']]);
				// var_dump($dls);die;
				foreach ($dls as $k => $v) {					
					if($city){
						//市代
						$sdl = iunserializer($v['aagentcitys']);

						if($city == $sdl[0]){

							show_json(0,'该地区已存在市代理');
						}
					}
					if($province){
						//省代
						$provinces = iunserializer($v['aagentprovinces']);

					
						if($province == $provinces[0]){
							// var_dump(111);
							show_json(0,'该地区已存在省代理');
						}
					}

				}
				
				$provinces = ((!(empty($province)) ? iserializer(array($province)) : iserializer(array())));
				$citys = ((!(empty($city)) ? iserializer(array(str_replace(' ', '', $city))) : iserializer(array())));
				$area = trim(str_replace(' ', '', $_GPC['area']));
				$areas = ((!(empty($area)) ? iserializer(array($area)) : iserializer(array())));
				//查询用户押金
				$yajin = pdo_fetch('SELECT id,credit2,credit3 FROM'.tablename('wx_shop_member').'WHERE uniacid=:uniacid AND id=:id ',[':uniacid'=>$_W['uniacid'],':id'=>$member['id']]);
				//后台押金设置
				$data = m('common')->getSysset('grabsingle');
				if($city){
					//市代押金
					$sdyj = $data['sdyj1'];
					$type = '2';
					if($yajin['credit2']<$sdyj){

						show_json(0,'你的余额不够开通市区代理押金');
					}

				}else if($province){
					//省代押金
					$sdyj = $data['sdyj2'];
					$type = '1';
					if($yajin['credit2']<$sdyj){

						show_json(0,'你的余额不够开通省区代理押金');
					}

				}
				//扣除余额为押金
				m('member')->setCredit($member['openid'], 'credit2', -$sdyj, array($_W['uid'], '申请代理扣除余额为押金' .'余额'));
				//记录
				pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$member['openid'],'orderid'=>0,'money'=>-$sdyj,'type'=>5,'createtime'=>time()));
				//加押金
				m('member')->setCredit($member['openid'], 'credit3', $sdyj, array($_W['uid'], '申请代理扣除余额为押金' .'押金'));
				//记录
				pdo_insert('wx_shop_member_credit_log',array('uniacid'=>$_W['uniacid'],'openid'=>$member['openid'],'orderid'=>0,'money'=>$sdyj,'type'=>6,'createtime'=>time()));

				pdo_insert('7033_yjjiedong',['uniacid'=>$_W['uniacid'],'uid'=>$member['id'],'money'=>$sdyj,'status'=>'0','type'=>$type]);

				 //记录
            	$this->credit2_log($openid,-$sdyj,['title'=>'代理保证金','rechargetype'=>'dlbzj'],0);

				$data = array('isaagent' => 1, 'aagentstatus' => 0, 'realname' => trim($_GPC['realname']), 'mobile' => trim($_GPC['mobile']), 'weixin' => trim($_GPC['weixin']), 'aagenttime' => 0, 'aagenttype' => intval($_GPC['aagenttype']), 'aagentprovinces' => $provinces, 'aagentcitys' => $citys, 'aagentareas' => $areas,'deposit'=>$sdyj,'sqtime'=>time());
				pdo_update('wx_shop_member', $data, array('id' => $member['id']));
				if (!(empty($member['uid']))) 
				{
					m('member')->mc_update($member['uid'], array('realname' => $data['realname'], 'mobile' => $data['mobile']));
				}
			}
			show_json(1);
		}
		
		include $this->template();
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
}
?>