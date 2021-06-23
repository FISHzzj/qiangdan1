<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class set3_WxShopPage extends WebPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql  = 'SELECT id,tips FROM'.tablename('7033_set3').' WHERE uniacid=:uniacid '; 
		$params[':uniacid'] = $_W['uniacid'];
		$sql .= ' limit ' . (($pindex - 1) * $psize) . ',' . $psize;
		$bank = pdo_fetchall($sql,$params);
		$total = count($bank);	
		$pager = pagination2($total, $pindex, $psize);
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
		$group = pdo_fetch('SELECT * FROM ' . tablename('7033_set3') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if ($_W['ispost']) 
		{

			// var_dump($_GPC);die;
			// $data = array('uniacid' => $_W['uniacid'], 'name' => trim($_GPC['groupname']));
			$data['tips'] = $_GPC['tips'];
			$data['uniacid'] = $_W['uniacid'];
			if (!(empty($id))) 
			{
				pdo_update('7033_set3', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				plog('member.group.edit', '修改抢单提示 ID: ' . $id);
			}
			else 
			{
				pdo_insert('7033_set3', $data);
				$id = pdo_insertid();
				plog('member.group.add', '添加抢单提示 ID: ' . $id);
			}
			show_json(1, array('url' => webUrl('grabsingle/set3', array('op' => 'display'))));
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
		$items = pdo_fetchall('SELECT id FROM ' . tablename('7033_set3') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
		foreach ($items as $item ) 
		{
			pdo_delete('7033_set3', array('id' => $item['id']));
			plog('member.group.delete', '删除抢单提示 ID: ' . $item['id'] . ' 名称: ' . $item['groupname'] . ' ');
		}
		show_json(1, array('url' => referer()));
	}
}
?>