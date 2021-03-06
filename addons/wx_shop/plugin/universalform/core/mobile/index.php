<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_WxShopPage extends PluginMobilePage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);

		if (empty($id)) {
			$this->message('请求参数错误！', mobileUrl());
		}
		$item = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_universalform_type') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$fields = iunserializer($item['fields']);
		
		$_W['shopshare'] = array('title' => $item['title'], 'imgUrl' => tomedia($item['adpic']), 'desc' => $item['title'], 'link' => mobileUrl('universalform', array('id' => $item['id']),true));
		include $this->template();
	}

	public function tranf($universalformdata)
	{
		$temp = array();
		if($universalformdata)
		{
			foreach ($universalformdata as $vv)
			{
				if(is_array($vv))
				{
					foreach ($vv as $v )
					{
						$temp[] = $v;
					}
				}
				else {
					$temp[] = $vv;
				}
			}
		}
		return $temp;
	}
	public function post()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_universalform_type') . ' WHERE id=:id and uniacid=:uniacid ', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		
		$universalformdata = explode('&', trim($_GPC['universalformdata']));
		$new_arr = array();
		foreach ($universalformdata as $k => $v) {
			$a = explode('=', $v);
			$m = strstr($a[0], '[]');
			$b = $a[0];
			if ($m) {
				$key = str_replace("[]","",$a[0]);
				$new_arr[$key][] = $a[1];

			} else {
				$new_arr[$b] = $a[1];
			}
		}
		$fields = iunserializer($item['fields']);
		$insert_data = $this->model->getInsertData( iunserializer($item['fields']), $new_arr);
		$insert = array(
				'typeid' => $item['id'],
				'fields' => implode('',$this->tranf($universalformdata)),
				'universalformfields' => $insert_data['data'],
				'uniacid' => $_W['uniacid'],
				'openid'=>$_W['openid']
		);
		pdo_insert('wx_shop_universalform_data', $insert);
		show_json(1, "保存成功");
	}
	
	public function ok()
	{
		include $this->template();
	}
	
	
}


?>