<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Group_WxShopPage extends PluginWebPage
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, intval($_GPC['page']));
		$psize = 10;
		$pstart = $psize * ($page - 1);
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) >' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':uniacid' => $_W['uniacid']));
		$allEnd = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) <' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allStart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) >' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allNostart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE  unix_timestamp(starttime) >' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$pager = pagination2($allStart, $page, $psize);
		include $this->template();
	}
	public function nostart() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, intval($_GPC['page']));
		$psize = 10;
		$pstart = $psize * ($page - 1);
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(starttime) >' . time() . ' AND mode = 6 AND uniacid=:uniacid ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':uniacid' => $_W['uniacid']));
		$allEnd = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) <' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allStart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) >' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allNostart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE  unix_timestamp(starttime) >' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$pager = pagination2($allNostart, $page, $psize);
		include $this->template();
	}
	public function end() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, intval($_GPC['page']));
		$psize = 10;
		$pstart = $psize * ($page - 1);
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) <' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':uniacid' => $_W['uniacid']));
		$allEnd = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) <' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allStart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) >' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allNostart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE  unix_timestamp(starttime) >' . time() . ' AND mode = 6 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$pager = pagination2($allEnd, $page, $psize);
		include $this->template();
	}
	public function post() 
	{
		global $_W;
		global $_GPC;
		$id = $_GPC['id'];
		$t1 = tablename('wx_shop_coupon');
		$t2 = tablename('wx_shop_coupon_category');
		$all = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods') . ' WHERE uniacid = :uniacid AND deleted = 0 ' . "\r\r" . '        AND hasoption = 0', array(':uniacid' => $_W['uniacid']));
		$hasoption = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods') . ' WHERE uniacid = :uniacid AND deleted = 0 ' . "\r\r" . '        AND hasoption = 1', array(':uniacid' => $_W['uniacid']));
		$i = 0;
		foreach ($hasoption as $e => $item ) 
		{
			$option[$i] = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods_option') . ' WHERE goodsid = :id', array(':id' => $item['id']));
			$option[$i][0]['gt'] = $item['title'];
			$option[$i][0]['pic'] = $item['thumb'];
			++$i;
		}
		$loop = count($option);
		if (!(empty($id))) 
		{
			$setting = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE id=:id AND uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		}
		$category = pdo_fetchall('SELECT * FROM ' . $t2 . ' WHERE uniacid = :uniacid', array(':uniacid' => $_W['uniacid']));
		foreach ($category as $key => $value ) 
		{
			$coupon[$key] = pdo_fetchall('SELECT * FROM ' . $t1 . ' WHERE uniacid = :uniacid AND catid = :catid', array(':uniacid' => $_W['uniacid'], ':catid' => $value['id']));
		}
		if (!(empty($id))) 
		{
			$setting = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE id=:id AND uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		}
		include $this->template();
	}
	public function add() 
	{
		global $_W;
		global $_GPC;
		if ($_W['ispost']) 
		{
			$binding = $_GPC['binding'];
			if ($binding == 'on') 
			{
				$binding = 1;
			}
			else 
			{
				$binding = 0;
			}
			$postagetype = intval($_GPC['postagetype']);
			if (!(empty($postagetype))) 
			{
				$postage = 0;
			}
			else 
			{
				$postage = floatval($_GPC['postage']);
			}
			$select = $_GPC['select'];
			$title = $_GPC['title'];
			$endtime = $_GPC['endtime'];
			$starttime = $_GPC['starttime'];
			if (in_array(1, $select)) 
			{
				$no_checkbox = $_GPC['no_checkbox'];
				$has_checkbox = $_GPC['has_checkbox'];
				if (($no_checkbox == false) && ($has_checkbox == false)) 
				{
					show_json(0, '???????????????????????????');
				}
				$goods['goods'] = $no_checkbox;
				$array = array();
				if ($has_checkbox != false) 
				{
					foreach ($has_checkbox as $k => $v ) 
					{
						$temp = explode('_', $v);
						if (!(array_key_exists($temp[0], $array))) 
						{
							$array[$temp[0]][0] = $temp[1];
						}
						else 
						{
							$jianzhi = count($array[$temp[0]]);
							$array[$temp[0]][$jianzhi] = $temp[1];
						}
					}
					$goods['option'] = $array;
				}
				$json_goods = json_encode($goods);
				$type = (int) $_GPC['type'];
				$value = (double) $_GPC['value'];
				$max = intval($_GPC['max']);
			}
			if (in_array(2, $select)) 
			{
				$balance_type = intval($_GPC['balancetype']);
				$balance = floatval($_GPC['balance']);
				$balance_left = floatval($_GPC['balance_left']);
				$balance_right = floatval($_GPC['balance_right']);
				if ($balance_type == 1) 
				{
					if ($balance <= 0) 
					{
						show_json(0, '????????????????????????0');
					}
				}
				else if ($balance_type == 2) 
				{
					if ((intval($balance_left) <= 0) || (intval($balance_right) <= 0)) 
					{
						show_json(0, '????????????????????????0');
					}
				}
			}
			if (in_array(3, $select)) 
			{
				$red_type = intval($_GPC['redtype']);
				$red = floatval($_GPC['red']);
				$red_left = floatval($_GPC['red_left']);
				$red_right = floatval($_GPC['red_right']);
				if ($red_type == 1) 
				{
					if (intval($red) < 1) 
					{
						show_json(0, '????????????????????????1???');
					}
				}
				else if ($red_type == 2) 
				{
					if ((intval($red_left) < 1) || (intval($red_right) < 1)) 
					{
						show_json(0, '????????????????????????1???');
					}
				}
				$sendname = trim($_GPC['sendname']);
				$wishing = trim($_GPC['wishing']);
				$actname = trim($_GPC['actname']);
				$remark = trim($_GPC['remark']);
			}
			if (in_array(4, $select)) 
			{
				$score_type = intval($_GPC['scoretype']);
				$score = intval($_GPC['score']);
				$score_right = intval($_GPC['score_right']);
				$score_left = intval($_GPC['score_left']);
			}
			if (in_array(5, $select)) 
			{
				$coupon_type = intval($_GPC['coupontype']);
				$coupon = $_GPC['checkbox'];
				if (empty($coupon)) 
				{
					show_json(0, '??????????????????????????????');
				}
				$coupon = json_encode($coupon);
			}
			if (!(empty($title)) && !(empty($endtime)) && !(empty($starttime)) && ($select != false)) 
			{
				$data = array('title' => $title, 'endtime' => $endtime, 'starttime' => $starttime, 'type' => $type, 'value' => $value, 'mode' => 6, 'status' => 1, 'uniacid' => $_W['uniacid'], 'score' => $score, 'max' => $max, 'coupon' => $coupon, 'balance' => $balance, 'red' => $red, 'red_left' => $red_left, 'red_right' => $red_right, 'balance_left' => $balance_left, 'balance_right' => $balance_right, 'score_left' => $score_left, 'score_right' => $score_right, 'score_type' => $score_type, 'balance_type' => $balance_type, 'red_type' => $red_type, 'coupon_type' => $coupon_type, 'goods' => $json_goods, 'img' => '../addons/wx_shop/plugin/exchange/static/img/exchange.jpg', 'title_reply' => '????????????', 'content' => '????????????????????????,??????????????????', 'code_type' => intval($_GPC['code_type']), 'binding' => $binding, 'postage' => $postage, 'postage_type' => $postagetype, 'sendname' => $sendname, 'wishing' => $wishing, 'actname' => $actname, 'remark' => $remark);
				pdo_insert('wx_shop_exchange_group', $data);
				$insert_id = pdo_insertid();
				if (!(empty($insert_id))) 
				{
					show_json(1, array('url' => webUrl('exchange/group/setting', array('id' => $insert_id), 1)));
				}
			}
		}
	}
	public function edit() 
	{
		global $_W;
		global $_GPC;
		$id = (int) $_GPC['id'];
		if ($_W['ispost']) 
		{
			$binding = $_GPC['binding'];
			if ($binding == 'on') 
			{
				$binding = 1;
			}
			else 
			{
				$binding = 0;
			}
			$postagetype = intval($_GPC['postagetype']);
			if (!(empty($postagetype))) 
			{
				$postage = 0;
			}
			else 
			{
				$postage = floatval($_GPC['postage']);
			}
			$select = $_GPC['select'];
			if ($select == false) 
			{
				show_json(0, '?????????????????????????????????');
			}
			$title = $_GPC['title'];
			$endtime = $_GPC['endtime'];
			$starttime = $_GPC['starttime'];
			if (in_array(1, $select)) 
			{
				$no_checkbox = $_GPC['no_checkbox'];
				$has_checkbox = $_GPC['has_checkbox'];
				if (($no_checkbox == false) && ($has_checkbox == false)) 
				{
					show_json(0, '???????????????????????????');
				}
				$goods['goods'] = $no_checkbox;
				$array = array();
				if ($has_checkbox != false) 
				{
					foreach ($has_checkbox as $k => $v ) 
					{
						$temp = explode('_', $v);
						if (!(array_key_exists($temp[0], $array))) 
						{
							$array[$temp[0]][0] = $temp[1];
						}
						else 
						{
							$jianzhi = count($array[$temp[0]]);
							$array[$temp[0]][$jianzhi] = $temp[1];
						}
					}
					$goods['option'] = $array;
				}
				$json_goods = json_encode($goods);
				$type = (int) $_GPC['type'];
				$value = (double) $_GPC['value'];
				$max = intval($_GPC['max']);
			}
			if (in_array(2, $select)) 
			{
				$balance_type = intval($_GPC['balancetype']);
				$balance = floatval($_GPC['balance']);
				$balance_left = floatval($_GPC['balance_left']);
				$balance_right = floatval($_GPC['balance_right']);
			}
			if (in_array(3, $select)) 
			{
				$red_type = intval($_GPC['redtype']);
				$red = floatval($_GPC['red']);
				$red_left = floatval($_GPC['red_left']);
				$red_right = floatval($_GPC['red_right']);
				if ($red_type == 1) 
				{
					if (intval($red) < 1) 
					{
						show_json(0, '????????????????????????1???');
					}
				}
				else if ($red_type == 2) 
				{
					if ((intval($red_left) < 1) || (intval($red_right) < 1)) 
					{
						show_json(0, '????????????????????????1???');
					}
				}
				$sendname = trim($_GPC['sendname']);
				$wishing = trim($_GPC['wishing']);
				$actname = trim($_GPC['actname']);
				$remark = trim($_GPC['remark']);
			}
			if (in_array(4, $select)) 
			{
				$score_type = intval($_GPC['scoretype']);
				$score = intval($_GPC['score']);
				$score_right = intval($_GPC['score_right']);
				$score_left = intval($_GPC['score_left']);
			}
			if (in_array(5, $select)) 
			{
				$coupon_type = intval($_GPC['coupontype']);
				$coupon = $_GPC['checkbox'];
				if (empty($coupon)) 
				{
					show_json(0, '??????????????????????????????');
				}
				$coupon = json_encode($coupon);
			}
			if (!(empty($title)) && !(empty($endtime)) && !(empty($starttime)) && ($select != false)) 
			{
				$data = array('title' => $title, 'endtime' => $endtime, 'starttime' => $starttime, 'type' => $type, 'value' => $value, 'mode' => 6, 'status' => 1, 'uniacid' => $_W['uniacid'], 'score' => $score, 'max' => $max, 'coupon' => $coupon, 'balance' => $balance, 'red' => $red, 'red_left' => $red_left, 'red_right' => $red_right, 'balance_left' => $balance_left, 'balance_right' => $balance_right, 'score_left' => $score_left, 'score_right' => $score_right, 'score_type' => $score_type, 'balance_type' => $balance_type, 'red_type' => $red_type, 'coupon_type' => $coupon_type, 'goods' => $json_goods, 'binding' => $binding, 'postage' => $postage, 'postage_type' => $postagetype, 'sendname' => $sendname, 'wishing' => $wishing, 'actname' => $actname, 'remark' => $remark);
				pdo_update('wx_shop_exchange_group', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				show_json(1, '????????????');
			}
		}
	}
	public function creat() 
	{
		global $_GPC;
		global $_W;
		$id = (int) $_GPC['id'];
		$res = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' ' . "\r\r" . '            WHERE id = :id AND uniacid = :uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		@session_start();
		if ((0 < intval($_GPC['ajax'])) && (0 < intval($_GPC['loop']))) 
		{
			$dir_pre = intval($_GPC['dir_pre']);
			if ($_SESSION['dir_prev'] == $dir_pre) 
			{
				$dir_next = $_SESSION['fileMD5'];
			}
			else 
			{
				$dir_next = $this->getRandChar(10);
				$dir_next = md5($dir_next);
				$_SESSION['fileMD5'] = $dir_next;
				$_SESSION['dir_prev'] = $dir_pre;
			}
			$dir_pre .= $dir_next;
			$shuzi = intval($_GPC['shuzi']);
			$daxie = intval($_GPC['daxie']);
			$xiaoxie = intval($_GPC['xiaoxie']);
			$qianzhui = trim($_GPC['qianzhui']);
			$length = intval($_GPC['length']);
			$num = (int) $_GPC['num'];
			$date = (int) $_GPC['date'];
			if ($res['code_type'] == 0) 
			{
				$date = max(1, $date);
				$date = min($date, 30);
			}
			$endtime = ($date * 24 * 60 * 60) + time();
			$endtime = date('Y-m-d H:i:s', $endtime);
			echo intval($_GPC['loop']) . '&' . $dir_pre;
			while (0 < $num) 
			{
				if ($res['code_type'] === 1) 
				{
					$endtime = '2037-12-30 00:00:00';
				}
				pdo_insert('wx_shop_exchange_code', array('groupid' => $id, 'uniacid' => $_W['uniacid'], 'endtime' => $endtime, 'type' => $res['code_type']));
				$rand_id = pdo_insertid();
				$rand = $this->getRandChar($length, $shuzi, $daxie, $xiaoxie);
				$key = $qianzhui . $rand;
				$serial = 'DH' . date('Ymd', time()) . $rand_id;
				if (empty($res['code_type'])) 
				{
					$scene = rand(100001, 2147483647);
				}
				else 
				{
					$scene = rand(1, 100000);
				}
				$exist = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('qrcode') . ' WHERE qrcid = :qrcid AND uniacid = :uniacid', array(':qrcid' => $scene, ':uniacid' => $_W['uniacid']));
				while (!(empty($exist))) 
				{
				}
				pdo_update('wx_shop_exchange_code', array('key' => $key, 'scene' => $scene, 'serial' => $serial), array('id' => $rand_id));
				$insert = array('uniacid' => $_W['uniacid'], 'name' => 'wx_shop:exchange:group', 'module' => 'reply', 'displayorder' => $rand_id, 'status' => 1);
				if (IMS_VERSION == '1.0') 
				{
					$insert['containtype'] = (($res == '0' ? 'news' : 'basic'));
					$insert['module'] = (($res == '0' ? 'news' : 'basic'));
				}
				pdo_insert('rule', $insert);
				$rid = pdo_insertid();
				pdo_query('UPDATE ' . tablename('wx_shop_exchange_group') . ' SET total = total + 1 WHERE uniacid = :uniacid AND id = :id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
				if ($res['reply_type'] == 0) 
				{
					$description = trim($res['content']);
					$description = str_replace('[?????????]', $res['serial'], $description);
					$module = 'news';
					$arr = array('rid' => $rid, 'title' => trim($res['title_reply']), 'author' => 'WX_SHOP_V2', 'description' => $description, 'thumb' => trim($res['img']), 'content' => '', 'displayorder' => $rand_id, 'incontent' => 1, 'createtime' => time(), 'url' => mobileUrl('exchange/index', array('key' => $key, 'codetype' => 1, 'id' => $res['id']), true));
					pdo_insert('news_reply', $arr);
				}
				else 
				{
					$module = 'basic';
					$content = htmlspecialchars_decode($res['basic_content']);
					$content = str_replace('[????????????]', mobileUrl('exchange', array('key' => $key, 'codetype' => 1, 'id' => $res['id']), 1), $content);
					$arr = array('rid' => $rid, 'content' => $content);
					pdo_insert('basic_reply', $arr);
				}
				if (IMS_VERSION == '1.0') 
				{
					$module = 'reply';
				}
				pdo_insert('rule_keyword', array('rid' => $rid, 'uniacid' => $_W['uniacid'], 'module' => $module, 'content' => md5($key), 'type' => 1, 'displayorder' => $rand_id, 'status' => 1));
				if ($res['code_type'] < 2) 
				{
					$expire = $date * 24 * 60 * 60;
					$token = WeAccount::token();
					$customMessageSendUrl = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $token;
					if ($res['code_type'] == 0) 
					{
						$postJosnData = '{"expire_seconds": ' . $expire . ', "action_name": "QR_SCENE", ' . "\r\r" . '                    "action_info": {"scene": {"scene_id": ' . $scene . '}}}';
					}
					else 
					{
						$postJosnData = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": ' . $scene . '}}}';
					}
					$ch = curl_init($customMessageSendUrl);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postJosnData);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
					$data = curl_exec($ch);
					$ticket = json_decode($data, true);
					$qr_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . $ticket['ticket'];
					$dirname = '../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre;
					load()->func('file');
					mkdirs($dirname);
					$fileContents = file_get_contents($qr_url);
					file_put_contents($dirname . '/' . $key . '.png', $fileContents);
					fopen('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.zip', 'wr');
					$zip = new ZipArchive();
					$res = $zip->open('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.zip', ZipArchive::OVERWRITE);
					if ($res === true) 
					{
						$this->addFileToZip('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre, $zip);
						$zip->close();
					}
					else 
					{
						switch ($res) 
						{
							case ZipArchive: exit('File already exists.');
							break;
							case ZipArchive: exit('Zip archive inconsistent.');
							break;
							case ZipArchive: exit('Malloc failure.');
							break;
							case ZipArchive: exit('No such file.');
							break;
							case ZipArchive: exit('Not a zip archive.');
							break;
							case ZipArchive: exit('Can\'t open file.');
							break;
							case ZipArchive: exit('Read error.');
							break;
							case ZipArchive: exit('Seek error.');
							break;
							default: exit('Unknow Error');
							break;
						}
					}
					if (intval($_GPC['end']) == 1) 
					{
						$this->delDirAndFile($dirname);
					}
					pdo_update('wx_shop_exchange_code', array('qrcode_url' => $qr_url), array('key' => $key, 'uniacid' => $_W['uniacid']));
				}
				else 
				{
					$qr_url = webUrl('exchange/goods/qr', array('key' => $key), 1);
					pdo_update('wx_shop_exchange_code', array('qrcode_url' => $qr_url), array('key' => $key, 'uniacid' => $_W['uniacid']));
					if ($res['code_type'] == 2) 
					{
						$content_url = mobileUrl('exchange', array('key' => $key, 'codetype' => 1, 'id' => $res['id']), 1);
						$dirname = '../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre;
						load()->func('file');
						mkdirs($dirname);
						require IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
						QRcode::png($content_url, $dirname . '/' . $serial . '.png', QR_ECLEVEL_L, 10, 3);
						fopen('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.zip', 'wr');
						$zip = new ZipArchive();
						if ($zip->open('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.zip', ZipArchive::OVERWRITE) === true)
						{
							$this->addFileToZip('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre, $zip);
							$zip->close();
						}
						if (intval($_GPC['end']) == 1) 
						{
							$this->delDirAndFile($dirname);
						}
					}
					else 
					{
						$br = "\r\n";
						if (intval($_GPC['end']) == 1) 
						{
							$br = "\r";
						}
						if (!(file_exists('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.txt')))
						{
							$text = fopen('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.txt', 'w');
							fwrite($text, $key . '_' . $serial . $br);
							fclose($text);
						}
						else 
						{
							$text = fopen('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.txt', 'a+');
							fwrite($text, $key . '_' . $serial . $br);
							fclose($text);
						}
						if (intval($_GPC['end']) == 1) 
						{
							require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
							require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/Writer/Excel5.php';
							$excel = new PHPExcel();
							$writer = new PHPExcel_Writer_Excel5($excel);
							$excel->getActiveSheet()->setCellValue('A1', '?????????');
							$excel->getActiveSheet()->setCellValue('B1', '??????');
							$excel->getActiveSheet()->setCellValue('C1', '??????????????????');
							$file = fopen('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.txt', 'r');
							$line = 2;
							if (empty($file)) 
							{
								exit();
							}
							while (!(feof($file))) 
							{
								$v0 = fgets($file);
								$v = explode('_', $v0);
								$excel->getActiveSheet()->setCellValue('A' . $line, ' ' . $v[0])->setCellValue('B' . $line, $v[1])->setCellValue('C' . $line, $res['title']);
								++$line;
							}
							fclose($file);
							$writer->save('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.xls');
							unlink('../addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $dir_pre . '.txt');
						}
					}
				}
				$qrcode = array('uniacid' => $_W['uniacid'], 'acid' => $_W['uniacid'], 'type' => 'scene', 'extra' => 0, 'qrcid' => $scene, 'name' => '????????????', 'keyword' => md5($key), 'model' => 6, 'ticket' => $ticket['ticket'], 'url' => $ticket['url'], 'expire' => $ticket['expire_seconds'], 'subnum' => 0, 'createtime' => time(), 'status' => 1, 'scene_str' => '');
				pdo_insert('qrcode', $qrcode);
				$key = NULL;
				$num -= 1;
			}
		}
		else 
		{
			include $this->template();
		}
	}
	private function getRandChar($length, $shuzi = 0, $daxie = 0, $xiaoxie = 0) 
	{
		$str = NULL;
		$strPol = '';
		if (!(empty($shuzi))) 
		{
			$strPol = '0123456789';
		}
		if (!(empty($daxie))) 
		{
			$strPol .= 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
		}
		if (!(empty($xiaoxie))) 
		{
			$strPol .= 'abcdefghijklmnopqrstuvwxyz';
		}
		$max = strlen($strPol) - 1;
		$i = 0;
		while ($i < $length) 
		{
			$str .= $strPol[rand(0, $max)];
			++$i;
		}
		return $str;
	}
	public function dno() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, $_GPC['page']);
		@session_start();
		$psize = intval($_GPC['psize']);
		if (!(empty($psize))) 
		{
			$_SESSION['psize'] = $psize;
		}
		else if (!(empty($_SESSION['psize']))) 
		{
			$psize = $_SESSION['psize'];
		}
		else 
		{
			$psize = 100;
		}
		$pstart = $psize * ($page - 1);
		$id = $_GPC['id'];
		$res = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' ' . "\r\r" . '            WHERE id = :id AND uniacid = :uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 1 AND unix_timestamp(endtime)>' . time() . ' ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dno = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 1 AND unix_timestamp(endtime)>' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dyet = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 2', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dend = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status!=2 AND unix_timestamp(endtime)<=' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$pager = pagination2($dno, $page, $psize);
		include $this->template();
	}
	public function dyet() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, $_GPC['page']);
		@session_start();
		$psize = intval($_GPC['psize']);
		if (!(empty($psize))) 
		{
			$_SESSION['psize'] = $psize;
		}
		else if (!(empty($_SESSION['psize']))) 
		{
			$psize = $_SESSION['psize'];
		}
		else 
		{
			$psize = 100;
		}
		$pstart = $psize * ($page - 1);
		$id = $_GPC['id'];
		$res = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' ' . "\r\r" . '            WHERE id = :id AND uniacid = :uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 2 ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dno = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 1 AND unix_timestamp(endtime)>' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dyet = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 2', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dend = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status!=2 AND unix_timestamp(endtime)<=' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$pager = pagination2($dyet, $page, $psize);
		include $this->template();
	}
	public function dend() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, $_GPC['page']);
		@session_start();
		$psize = intval($_GPC['psize']);
		if (!(empty($psize))) 
		{
			$_SESSION['psize'] = $psize;
		}
		else if (!(empty($_SESSION['psize']))) 
		{
			$psize = $_SESSION['psize'];
		}
		else 
		{
			$psize = 100;
		}
		$pstart = $psize * ($page - 1);
		$id = $_GPC['id'];
		$res = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' ' . "\r\r" . '            WHERE id = :id AND uniacid = :uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status != 2 AND unix_timestamp(endtime)<' . time() . ' ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dno = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 1 AND unix_timestamp(endtime)>' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dyet = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 2', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dend = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status!=2 AND unix_timestamp(endtime)<=' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$pager = pagination2($dend, $page, $psize);
		include $this->template();
	}
	public function delete() 
	{
		global $_W;
		global $_GPC;
		$id = (int) $_GPC['id'];
		$ids = $_GPC['ids'];
		if (is_array($ids)) 
		{
			foreach ($ids as $value ) 
			{
				$count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid=:id AND status < 2 AND unix_timestamp(endtime)>' . time(), array(':id' => $value));
				if (!(empty($count))) 
				{
					show_json(0, '???????????????<br>?????????????????????????????????????????????????????????');
				}
			}
			$value = NULL;
			foreach ($ids as $value ) 
			{
				pdo_delete('wx_shop_exchange_group', array('id' => $value, 'uniacid' => $_W['uniacid']));
			}
			show_json(1, '????????????!');
		}
		else 
		{
			$count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid=:id AND status < 2 AND unix_timestamp(endtime)>' . time(), array(':id' => $id));
			if (empty($count)) 
			{
				pdo_delete('wx_shop_exchange_group', array('id' => $id, 'uniacid' => $_W['uniacid']));
				show_json(1, '????????????');
			}
			else 
			{
				show_json(0, '???????????????<br>?????????????????????????????????????????????????????????');
			}
		}
	}
	public function stock() 
	{
		global $_W;
		global $_GPC;
		$stock = intval($_GPC['value']);
		$goodsid = intval($_GPC['goodsid']);
		$optionid = intval($_GPC['optionid']);
		if (!(empty($goodsid))) 
		{
			pdo_update('wx_shop_goods', array('exchange_stock' => $stock), array('id' => $goodsid));
		}
		else if (!(empty($optionid))) 
		{
			pdo_update('wx_shop_goods_option', array('exchange_stock' => $stock), array('id' => $optionid));
		}
		else 
		{
			show_json(0, '????????????');
		}
		show_json(1, '????????????');
	}
	public function postage() 
	{
		global $_W;
		global $_GPC;
		$postage = intval($_GPC['value']);
		$goodsid = intval($_GPC['goodsid']);
		$optionid = intval($_GPC['optionid']);
		if (!(empty($goodsid))) 
		{
			pdo_update('wx_shop_goods', array('exchange_postage' => $postage), array('id' => $goodsid));
		}
		else if (!(empty($optionid))) 
		{
			pdo_update('wx_shop_goods_option', array('exchange_postage' => $postage), array('id' => $optionid));
		}
		else 
		{
			show_json(0, '????????????');
		}
		show_json(1, '????????????');
	}
	public function goodspost() 
	{
		global $_W;
		global $_GPC;
		$id = $_GPC['id'];
		$all = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods') . ' WHERE uniacid = :uniacid AND deleted = 0 ' . "\r\r" . '        AND hasoption = 0', array(':uniacid' => $_W['uniacid']));
		$hasoption = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods') . ' WHERE uniacid = :uniacid AND deleted = 0 ' . "\r\r" . '        AND hasoption = 1', array(':uniacid' => $_W['uniacid']));
		$i = 0;
		foreach ($hasoption as $e => $item ) 
		{
			$option[$i] = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods_option') . ' WHERE goodsid = :id', array(':id' => $item['id']));
			$option[$i][0]['gt'] = $item['title'];
			$option[$i][0]['pic'] = $item['thumb'];
			++$i;
		}
		$loop = count($option);
		if (!(empty($id))) 
		{
			$setting = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE id=:id AND uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		}
		include $this->template();
	}
	public function qrcode() 
	{
		global $_GPC;
		global $_W;
		$key = $_GPC['key'];
		$type = $_GPC['type'];
		$id = intval($_GPC['id']);
		$res = pdo_fetch('SELECT * FROM ' . tablename('qrcode') . ' WHERE keyword = :keyword AND uniacid = :uniacid', array(':uniacid' => $_W['uniacid'], ':keyword' => md5($key)));
		$qrcode_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . $res['ticket'];
		include $this->template();
	}
	public function status() 
	{
		global $_W;
		global $_GPC;
		$status = intval($_GPC['status']);
		$newstatus = intval($_GPC['newstatus']);
		$status2 = ($status * -1) + 1;
		$id = intval($_GPC['id']);
		$key = trim($_GPC['key']);
		$ajax = intval($_GPC['ajax']);
		$res = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_code') . ' WHERE `key`=:key AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid'], ':key' => $key));
		if (empty($key) && !(empty($id))) 
		{
			pdo_update('wx_shop_exchange_group', array('status' => $status2), array('id' => $id, 'uniacid' => $_W['uniacid'], 'status' => $status));
			show_json(1, '??????');
		}
		else if (!(empty($key)) && empty($id) && !(empty($ajax))) 
		{
			pdo_update('wx_shop_exchange_code', array('status' => $newstatus), array('key' => $key, 'status' => $status));
			if ($newstatus == 1) 
			{
				pdo_update('wx_shop_exchange_record', array('key' => $key . 'plus' . time()), array('key' => $key, 'uniacid' => $_W['uniacid']));
				$group = pdo_fetch('SELECT groupid FROM ' . tablename('wx_shop_exchange_code') . ' WHERE `key`= :key AND uniacid = :uniacid', array(':key' => $key, ':uniacid' => $_W['uniacid']));
				pdo_query('UPDATE ' . tablename('wx_shop_exchange_group') . ' SET `total` = `total`+1 WHERE id = :id AND uniacid = :uniacid', array(':id' => $group['groupid'], ':uniacid' => $_W['uniacid']));
			}
			show_json(1, '????????????');
		}
		else 
		{
			include $this->template();
		}
	}
	public function select() 
	{
		global $_GPC;
		global $_W;
		include $this->template();
	}
	public function page() 
	{
		global $_W;
		global $_GPC;
		include $this->template();
	}
	public function destroy() 
	{
		global $_GPC;
		global $_W;
		$id = intval($_GPC['id']);
		$ids = $_GPC['ids'];
		if (is_array($ids)) 
		{
		}
		else 
		{
			$ids[0] = $id;
		}
		foreach ($ids as $k => $value ) 
		{
			$res_arr = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_code') . ' WHERE id = :id AND uniacid = :uniacid', array(':id' => $value, ':uniacid' => $_W['uniacid']));
			$key = $res_arr['key'];
			if (!(empty($key)) && !(empty($value))) 
			{
				$a = pdo_delete('wx_shop_exchange_code', array('id' => $value, 'key' => $key, 'uniacid' => $_W['uniacid']));
				$t1 = tablename('qrcode');
				$t2 = tablename('qrcode_stat');
				$res = pdo_query('DELETE ' . $t1 . ',' . $t2 . ' FROM ' . $t1 . ' LEFT JOIN ' . $t2 . ' ON ' . $t1 . '.id = ' . $t2 . '.qid ' . "\r\r" . '                    WHERE ' . $t1 . '.keyword = :key', array(':key' => md5($key)));
				$b = pdo_delete('rule', array('displayorder' => $value, 'uniacid' => $_W['uniacid']));
				$c = pdo_delete('rule_keyword', array('content' => $key, 'uniacid' => $_W['uniacid']));
				$d = pdo_delete('news_reply', array('displayorder' => $value));
				if ($res_arr['status'] == 1) 
				{
					pdo_query('UPDATE ' . tablename('wx_shop_exchange_group') . ' SET `total` = `total` - 1 WHERE id = :id AND uniacid = :uniacid', array(':id' => $res_arr['groupid'], ':uniacid' => $_W['uniacid']));
				}
			}
		}
		show_json(1, '????????????');
	}
	public function setting() 
	{
		global $_W;
		global $_GPC;
		$id = $_GPC['id'];
		if ($_W['ispost']) 
		{
			$reply_type = intval($_GPC['reply']);
			if ($reply_type == 0) 
			{
				$title = trim($_GPC['balancetitle']);
				$img = trim($_GPC['balanceimg']);
				$content = trim($_GPC['balancecontent']);
				$data = array('title_reply' => $title, 'img' => $img, 'content' => $content, 'reply_type' => $reply_type);
			}
			else 
			{
				$basic_content = trim($_GPC['content']);
				$data = array('basic_content' => $basic_content, 'reply_type' => $reply_type);
			}
			pdo_update('wx_shop_exchange_group', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
			show_json(1, '????????????');
		}
		else 
		{
			$t1 = tablename('wx_shop_coupon');
			$allcoupon = pdo_fetchall('SELECT * FROM ' . $t1 . ' WHERE uniacid = :uniacid', array(':uniacid' => $_W['uniacid']));
			if (!(empty($id))) 
			{
				$setting = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE id=:id AND uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
				$coupon = json_decode($setting['coupon'], true);
			}
			$all = array();
			$hasoption = array();
			if (!(empty($id))) 
			{
				$setting = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE id=:id AND uniacid=:uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
				$goods = json_decode($setting['goods'], true);
				$banner = json_decode($setting['banner'], 1);
				if (!(empty($banner))) 
				{
					foreach ($banner as $k => $v ) 
					{
						$banner[$k] = urldecode($v);
					}
				}
				if ($goods['goods'] != false) 
				{
					foreach ($goods['goods'] as $k => $v ) 
					{
						$all[$k] = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods') . ' WHERE uniacid = :uniacid AND deleted = 0 ' . "\r\r" . '        AND hasoption = 0 AND id = :id', array(':id' => $v, ':uniacid' => $_W['uniacid']));
					}
				}
				if ($goods['option'] != false) 
				{
					foreach ($goods['option'] as $ke => $v ) 
					{
						$hasoption[$ke] = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_goods') . ' WHERE uniacid = :uniacid AND deleted = 0 AND hasoption = 1 AND id = :id', array(':id' => $ke, ':uniacid' => $_W['uniacid']));
					}
				}
			}
			if (p('diypage')) 
			{
				$exchangePages = p('diypage')->getPageList('allpage', ' and type=8 ');
				$exchangePages = $exchangePages['list'];
			}
		}
		include $this->template();
	}
	public function down() 
	{
		global $_W;
		global $_GPC;
		$ids = $_GPC['ids'];
		$key = $_GPC['key'];
		$res = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_code') . ' WHERE `key`=:key AND `uniacid`=:uniacid', array(':key' => $key, ':uniacid' => $_W['uniacid']));
		$filename = $res['qrcode_url'];
		header('Content-type:  application/octet-stream ');
		$date = date('Ymd-H:i:m');
		header('Cache-Control: max-age=0');
		header('Content-Disposition:  attachment;  filename= ' . $key . '.jpg');
		$size = readfile($filename);
		header('Accept-Length: ' . $size);
	}
	public function beautify() 
	{
		global $_W;
		global $_GPC;
		$id = $_GPC['id'];
		$detail = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 0 AND unix_timestamp(endtime)>' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dno = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 1 AND unix_timestamp(endtime)>' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dyet = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 2', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dend = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status!=2 AND unix_timestamp(endtime)<=' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		include $this->template();
	}
	public function search() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, intval($_GPC['page']));
		$psize = 20;
		$pstart = $psize * ($page - 1);
		$like = '';
		$keyword = trim($_GPC['keyword']);
		$like = 'AND `title` LIKE \'%' . $keyword . '%\'';
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_group') . ' WHERE mode = 6 AND uniacid=:uniacid  ' . $like . ' ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':uniacid' => $_W['uniacid']));
		$count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE mode = 6 AND uniacid=:uniacid  ' . $like, array(':uniacid' => $_W['uniacid']));
		$allEnd = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) <' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 2 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allStart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE unix_timestamp(endtime) >' . time() . ' AND unix_timestamp(starttime) <' . time() . ' AND mode = 2 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$allNostart = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_group') . ' WHERE  unix_timestamp(starttime) >' . time() . ' AND mode = 2 AND uniacid=:uniacid', array(':uniacid' => $_W['uniacid']));
		$pager = pagination2($count, $page, $psize);
		include $this->template();
	}
	public function codesearch() 
	{
		global $_W;
		global $_GPC;
		$page = max(1, $_GPC['page']);
		@session_start();
		$psize = intval($_GPC['psize']);
		if (!(empty($psize))) 
		{
			$_SESSION['psize'] = $psize;
		}
		else if (!(empty($_SESSION['psize']))) 
		{
			$psize = $_SESSION['psize'];
		}
		else 
		{
			$psize = 100;
		}
		$pstart = $psize * ($page - 1);
		$id = $_GPC['id'];
		$keyword = trim($_GPC['keyword']);
		$start = trim($_GPC['start']);
		$end = trim($_GPC['end']);
		if (!(empty($keyword))) 
		{
			$condition = 'AND `key` LIKE \'%' . $keyword . '%\'';
		}
		if (!(empty($start)) && !(empty($end))) 
		{
			$start = strtotime($start . ' 00:00:00');
			$end = strtotime($end . ' 23:59:59');
			$condition .= ' AND unix_timestamp(endtime) >=' . $start . ' AND unix_timestamp(endtime) <=' . $end;
		}
		$res = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_exchange_group') . 'WHERE id = :id AND uniacid = :uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid ' . $condition . ' ORDER BY id DESC LIMIT ' . $pstart . ',' . $psize, array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid ' . $condition, array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dno = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 1 AND unix_timestamp(endtime)>' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dyet = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status = 2', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$dend = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_exchange_code') . ' WHERE groupid = :id AND uniacid=:uniacid AND status!=2 AND unix_timestamp(endtime)<=' . time(), array(':id' => $id, ':uniacid' => $_W['uniacid']));
		$pager = pagination2($count, $page, $psize);
		include $this->template();
	}
	public function qr() 
	{
		global $_W;
		global $_GPC;
		$key = trim($_GPC['key']);
		$id = intval($_GPC['id']);
		$url = mobileUrl('exchange', array('key' => $key, 'codetype' => 1, 'id' => $id), 1);
		require IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
		QRcode::png($url, false, QR_ECLEVEL_L, 10, 3);
	}
	public function addFileToZip($path, $zip) 
	{
		$handler = opendir($path);
		while (($filename = readdir($handler)) !== false) 
		{
			if (($filename != '.') && ($filename != '..')) 
			{
				if (is_dir($path . '/' . $filename)) 
				{
					$this->addFileToZip($path . '/' . $filename, $zip);
				}
				else 
				{
					$zip->addFile($path . '/' . $filename);
				}
			}
		}
		@closedir($path);
	}
	public function delDirAndFile($dirName) 
	{
		if ($handle = opendir($dirName)) 
		{
			while (false !== $item = readdir($handle)) 
			{
				if (($item != '.') && ($item != '..')) 
				{
					if (is_dir($dirName . '/' . $item)) 
					{
						delDirAndFile($dirName . '/' . $item);
					}
					else 
					{
						unlink($dirName . '/' . $item);
					}
				}
			}
			@closedir($handle);
			rmdir($dirName);
		}
	}
	public function delzip() 
	{
		global $_GPC;
		global $_W;
		$filename = trim($_GPC['filename']);
		if (unlink(IA_ROOT . '/addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $filename . '.zip'))
		{
			exit('1');
		}
	}
	public function code_type() 
	{
		global $_GPC;
		global $_W;
		$id = intval($_GPC['id']);
		$res = pdo_fetch('SELECT code_type FROM ' . tablename('wx_shop_exchange_group') . ' WHERE id = :id AND uniacid = :uniacid', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		echo $res['code_type'];
	}
	public function deltxt() 
	{
		global $_GPC;
		global $_W;
		$filename = trim($_GPC['filename']);
		dump($filename);
		$title = trim($_GPC['title']);
		if (unlink(IA_ROOT . '/addons/wx_shop/data/qrcode/' . $_W['uniacid'] . '/exchange/' . $filename . '.xls'))
		{
			exit('1');
		}
	}
	public function banner() 
	{
		global $_GPC;
		global $_W;
		$banner = $_GPC['banner'];
		$id = intval($_GPC['id']);
		if (6 < count($banner)) 
		{
			show_json(0, '??????????????????6????????????');
		}
		if (empty($banner)) 
		{
			$jsonBanner = '';
		}
		else 
		{
			foreach ($banner as $k => $v ) 
			{
				$banner[$k] = urlencode($v);
			}
			$jsonBanner = json_encode($banner);
		}
		pdo_update('wx_shop_exchange_group', array('banner' => $jsonBanner), array('uniacid' => $_W['uniacid'], 'id' => $id));
		show_json(1, '????????????');
	}
}
?>