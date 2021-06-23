<?php
global $_W;
global $_GPC;
$uniacid = intval($_W['uniacid']);
$id = intval($_GPC['id']);
$redis = redis();
$item = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_goods') . ' WHERE id = :id and uniacid = :uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));

//等级大厅7244追加
	$levelHall = pdo_fetchall(' select levelname, level from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid order by level asc ', array(':uniacid' => $_W['uniacid']));

if ($_W['ispost']) 
{
	$data = array(
		'uniacid' 		=> intval($_W['uniacid']), 
		'displayorder' 	=> intval($_GPC['displayorder']), 
		'title' 		=> trim($_GPC['goodsname']),
		'guishu'		=> trim($_GPC['guishu']),
		'unit' 			=> trim($_GPC['unit']), 
		'createtime' 	=> TIMESTAMP, 
		'marketprice' 	=> floatval($_GPC['marketprice']), 
		'marketprice2'	=> floatval($_GPC['marketprice2']),
		'status' 		=> empty($_GPC['status']) ? 0 : intval($_GPC['status']), 
		'type' 			=> empty($_GPC['type']) ? 0 : intval($_GPC['type']),
		'thumb'			=> $_GPC['thumbs'],
	);
	
	// if (is_array($_GPC['thumbs'])) {
	// 	$thumbs = $_GPC['thumbs'];
	// 	$thumb_url = array();
	// 	foreach ($thumbs as $th ) {
	// 		$thumb_url[] = trim($th);
	// 	}
	// 	$data['thumb'] = save_media($thumb_url[0]);
	// 	unset($thumb_url[0]);
	// 	$data['thumb_url'] = serialize(m('common')->array_images($thumb_url));
	// }
	

	$data['sd_hall'] = intval($_GPC['sd_hall']);

	if (empty($id)) {
		pdo_insert('wx_shop_goods', $data);
		$id = pdo_insertid();
		plog('goods.add', '添加商品 ID: ' . $id);
	}else{
		unset($data['createtime']);
		pdo_update('wx_shop_goods', $data, array('id' => $id));
		plog('goods.edit', '编辑商品 ID: ' . $id);
	}

	$goodsid =  $redis->lRange('goodsid_5812',0,-1);
	if(!in_array($id,$goodsid)){
		$redis->lPush('goodsid_5812',$id);
	}
	$redis->set('goods_'.$id,$data['marketprice']);

	show_json(1, array('url' => webUrl('goods/edit', array('id' => $id, 'tab' => str_replace('#tab_', '', $_GPC['tab'])))));
}

include $this->template('goods/post');
exit();
?>