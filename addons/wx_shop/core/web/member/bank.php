<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class bank_WxShopPage extends WebPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		
		$bank = pdo_fetchall('SELECT id,name FROM'.tablename('6925_bank_list').'WHERE uniacid=:uniacid ',[':uniacid'=>$_W['uniacid']]);	

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
		$group = pdo_fetch('SELECT * FROM ' . tablename('6925_bank_list') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if ($_W['ispost']) 
		{
			$data = array('uniacid' => $_W['uniacid'], 'name' => trim($_GPC['groupname']));
			if (!(empty($id))) 
			{
				pdo_update('6925_bank_list', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				plog('member.group.edit', '修改银行名称 ID: ' . $id);
			}
			else 
			{
				pdo_insert('6925_bank_list', $data);
				$id = pdo_insertid();
				plog('member.group.add', '添加银行名称 ID: ' . $id);
			}
			show_json(1, array('url' => webUrl('member/bank', array('op' => 'display'))));
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
		$items = pdo_fetchall('SELECT id,name FROM ' . tablename('6925_bank_list') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) 
		{
			pdo_delete('6925_bank_list', array('id' => $item['id']));
			plog('member.group.delete', '删除银行名称 ID: ' . $item['id'] . ' 名称: ' . $item['groupname'] . ' ');
		}
		show_json(1, array('url' => referer()));
	}
}
?>