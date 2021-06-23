<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Sd_Level_WxShopPage extends WebPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$set = array();
		$set = m('common')->getSysset();
		$shopset = array();
		$shopset = $set['shop'];
		$default = array(
			'id' 			=> 'default', 
			'levelname' 	=> (empty($set['shop']['levelname']) ? '普通等级' : $set['shop']['levelname']),
			'hallname'		=> (empty($set['shop']['hallname']) ? '--' : $set['shop']['hallname']), //默认大厅名称
			'c_proportion'	=> (empty($set['shop']['c_proportion']) ? 0 : $set['shop']['c_proportion']),//等级大厅的佣金比例，该大厅接取任务，按照此佣金比例计算佣金
			'gs_probability'=> (empty($set['shop']['gs_probability']) ? 0 : $set['shop']['gs_probability']),//抢单几率，只供显示，无功能
			'details' 		=> (empty($set['shop']['details']) ? '' : $set['shop']['details']),//福利说明
			'picture' 		=> (empty($set['shop']['picture']) ? '' : $set['shop']['picture']),//大厅图片
		);
		$condition = ' and uniacid=:uniacid';
		$params = array(':uniacid' => $_W['uniacid']);

		if (!(empty($_GPC['keyword']))) 
		{
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' and ( levelname like :levelname)';
			$params[':levelname'] = '%' . $_GPC['keyword'] . '%';
		}

		$others = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_sd_member_level') . ' WHERE 1 ' . $condition . ' ORDER BY level asc', $params);
		foreach ($others as $key => &$row) {
			if(empty($row['hallname'])){
				$row['hallname'] = '--';
			}
		}
		unset($row);
		if (empty($_GPC['keyword'])) 
		{
			$list = array_merge(array($default), $others);
		}
		else 
		{
			$list = $others;
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
		$id = trim($_GPC['id']);
		$set = m('common')->getSysset();
		$setdata = pdo_fetch('select * from ' . tablename('wx_shop_sysset') . ' where uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
		if ($id == 'default') //默认等级大厅
		{
			$level = array(
				'id' 			=> 'default', 
				'levelname' 	=> (empty($set['shop']['levelname']) ? '普通等级' : $set['shop']['levelname']), 
				'hallname'		=> (empty($set['shop']['hallname']) ? '--' : $set['shop']['hallname']), //默认大厅名称
				'c_proportion'	=> (empty($set['shop']['c_proportion']) ? 0 : $set['shop']['c_proportion']),//等级大厅的佣金比例，该大厅接取任务，按照此佣金比例计算佣金
				'gs_probability'=> (empty($set['shop']['gs_probability']) ? 0 : $set['shop']['gs_probability']),//抢单几率，只供显示，无功能
				'details' 		=> (empty($set['shop']['details']) ? '' : $set['shop']['details']),//福利说明
				'picture' 		=> (empty($set['shop']['picture']) ? '' : $set['shop']['picture']),//福利说明
			);
		}else{
			$level = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_sd_member_level') . ' WHERE id=:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => intval($id)));
		}

		if ($_W['ispost']) 
		{
			
			$data = array(
				'level' 			=> intval($_GPC['level']),
				'levelname' 		=> trim($_GPC['levelname']), 
				'hallname'			=> trim($_GPC['hallname']),
				'c_proportion'		=> floatval($_GPC['c_proportion']),
				'gs_probability'	=> floatval($_GPC['gs_probability']),
				'invitations_num'	=> intval($_GPC['invitations_num']),//邀请人数
				'recharge' 			=> floatval($_GPC['recharge']),//邀请人数单个充值累计
				'details' 			=> trim($_GPC['details']),//福利说明
				'picture' 			=> $_GPC['picture'],
			);

			if ($id != 'default'){
				$hasLevel = pdo_fetchcolumn(' select id from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level = :level ', array(':uniacid' => $_W['uniacid'], ':level' => $data['level']));
				if(!empty($hasLevel)){
					if($hasLevel != $level['id']){
						show_json(0, '该等级已存在,请重新选择等级');
					}
				}
			}
			
			if (!(empty($id))) 
			{
				if ($id == 'default') 
				{
					$updatecontent = '<br/>等级名称: ' . $set['shop']['levelname'] . '->' . $data['levelname'] . '<br/>佣金比例: ' . $set['shop']['c_proportion'] . '->' . $data['c_proportion'] . '<br/>抢单几率: ' . $set['shop']['gs_probability'] . '->' . $data['gs_probability'] . '<br/>大厅名称: ' . $set['shop']['hallname'] . '->' . $data['hallname'];
					$set['shop']['levelname'] 		= $data['levelname'];
					$set['shop']['c_proportion'] 	= $data['c_proportion'];
					$set['shop']['gs_probability'] 	= $data['gs_probability'];
					$set['shop']['details'] 		= $data['details'];
					$set['shop']['picture'] 		= $data['picture'];
					$set['shop']['hallname'] 		= $data['hallname'];
					m('common')->updateSysset($set);
					plog('member.level.edit', '修改会员默认等级大厅' . $updatecontent);
				}
				else 
				{
					$updatecontent = '<br/>等级名称: ' . $level['levelname'] . '->' . $data['levelname'] . '<br/>佣金比例: ' . $level['c_proportion'] . '->' . $data['c_proportion'] . '<br/>抢单几率: ' . $level['gs_probability'] . '->' . $data['gs_probability'] . '<br/>升级条件: 邀请 ' . $level['invitations_num'] . '->' . $data['invitations_num'] . '人<br/>单个累计充值: ' . $level['recharge'] . '->' . $data['recharge'] . '<br/>大厅名称: ' . $level['hallname'] . '->' . $data['hallname'];
					pdo_update('wx_shop_sd_member_level', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
					plog('member.level.edit', '修改会员等级大厅 ID: ' . $id . $updatecontent);
				}
			}
			else 
			{
				$data['uniacid'] = intval($_W['uniacid']);
				pdo_insert('wx_shop_sd_member_level', $data);
				$id = pdo_insertid();
				plog('member.level.add', '添加会员等级大厅 ID: ' . $id);
			}
			show_json(1, array('url' => webUrl('member/sd_level')));
		}
		$level_array = array();
		$i = 1;
		while ($i < 101)
		{
			$level_array[$i] = $i;
			++$i;
		}
		include $this->template();
	}
	public function delete() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		if (empty($id)) 
		{
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$items = pdo_fetchall('SELECT id,levelname FROM ' . tablename('wx_shop_sd_member_level') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) 
		{
			pdo_delete('wx_shop_sd_member_level', array('id' => $item['id']));
			plog('member.level.delete', '删除等级大厅 ID: ' . $item['id'] . ' 大厅名称: ' . $item['levelname'] . ' ');
		}
		show_json(1, array('url' => referer()));
	}
}
?>