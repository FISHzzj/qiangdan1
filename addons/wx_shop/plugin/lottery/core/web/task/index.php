<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
@session_start();
class Index_WxShopPage extends PluginWebPage
{
	private $new = false;
	public function __construct() 
	{
		parent::__construct();
		global $_GPC;
		global $_W;
		// $this->new = $this->model->isnew();
		$this->new = p('task')->isnew();
		$this->model = p('task');
	}
	public function main() 
	{
		if ($this->new)
		{
			$this->main_new();
			exit();
		}
		global $_W;
		global $_GPC;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;
		$params = array(':uniacid' => $_W['uniacid']);
		$condition = ' and uniacid=:uniacid and `is_delete`=0 ';
		if (!(empty($_GPC['keyword']))) 
		{
			$_GPC['keyword'] = trim($_GPC['keyword']);
			$condition .= ' AND `title` LIKE :title';
			$params[':title'] = '%' . trim($_GPC['keyword']) . '%';
		}
		$list = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_task_poster') . ' WHERE 1 ' . $condition . ' ORDER BY createtime desc LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
		unset($row);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_task_poster') . ' where 1 ' . $condition . ' ', $params);
		$pager = pagination2($total, $pindex, $psize);
		foreach ($list as $key => $val ) 
		{
			$viewcount = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('wx_shop_task_joiner') . ' where uniacid=:uniacid and task_id=:task_id and task_type=' . $val['poster_type'], array(':uniacid' => $_W['uniacid'], ':task_id' => $val['id']));
			$list[$key]['viewcount'] = $viewcount;
		}
		include $this->template();
	}
	public function add() 
	{
		global $_GPC;
		if ($_GPC['task_type'] == 1) 
		{
			$this->post();
		}
		else if ($_GPC['task_type'] == 2) 
		{
			$this->rankpost();
		}
	}
	public function edit() 
	{
		global $_GPC;
		if ($_GPC['task_type'] == 1) 
		{
			$this->post();
		}
		else if ($_GPC['task_type'] == 2) 
		{
			$this->rankpost();
		}
	}
	public function post() 
	{
		if ($this->new) 
		{
			$this->post_new();
			exit();
		}
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_task_poster') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (!(empty($item))) 
		{
			$data = json_decode(str_replace('&quot;', '\'', $item['data']), true);
		}
		if ($_W['ispost']) 
		{
			if (!(empty($id))) 
			{
				if (intval($_GPC['needcount']) < $item['needcount']) 
				{
					$task_count = pdo_fetchcolumn('select COUNT(*) from ' . tablename('wx_shop_task_join') . ' where uniacid=:uniacid and task_id=:task_id and task_type=1 and failtime>' . time(), array(':uniacid' => $_W['uniacid'], ':task_id' => $id));
					if ($task_count) 
					{
						show_json(0, '????????????????????????????????????????????????????????????????????????');
						exit();
					}
				}
			}
			load()->model('account');
			$data = array('uniacid' => $_W['uniacid'], 'days' => intval($_GPC['days']) * 24 * 3600, 'reward_days' => intval($_GPC['reward_days']) * 24 * 3600, 'title' => trim($_GPC['title']), 'titleicon' => trim($_GPC['titleicon']), 'poster_banner' => trim($_GPC['poster_banner']), 'keyword' => trim($_GPC['keyword']), 'bg' => save_media($_GPC['bg']), 'data' => htmlspecialchars_decode($_GPC['data']), 'resptype' => trim($_GPC['resptype']), 'resptext' => trim($_GPC['resptext']), 'resptitle' => trim($_GPC['resptitle']), 'respthumb' => trim($_GPC['respthumb']), 'respdesc' => trim($_GPC['respdesc']), 'respurl' => trim($_GPC['respurl']), 'createtime' => time(), 'oktext' => trim($_GPC['oktext']), 'waittext' => trim($_GPC['waittext']), 'bedown' => intval($_GPC['bedown']), 'beagent' => intval($_GPC['beagent']), 'getposter' => trim($_GPC['getposter']), 'timestart' => strtotime($_GPC['time']['start']), 'timeend' => strtotime($_GPC['time']['end']), 'is_repeat' => intval($_GPC['is_repeat']), 'status' => intval($_GPC['status']), 'is_goods' => intval($_GPC['is_goods']), 'autoposter' => intval($_GPC['autoposter']), 'starttext' => trim($_GPC['starttext']), 'endtext' => trim($_GPC['endtext']), 'needcount' => intval($_GPC['needcount']), 'poster_type' => (isset($_GPC['poster_type']) ? intval($_GPC['poster_type']) : 1));
			$reward = array();
			$rec_reward = htmlspecialchars_decode($_GPC['rec_reward_data']);
			$rec_reward = json_decode($rec_reward, 1);
			$rec_data = array();
			if (!(empty($rec_reward))) 
			{
				foreach ($rec_reward as $val ) 
				{
					if ($val['type'] == 1) 
					{
						$rec_data['credit'] = intval($val['num']);
					}
					else if ($val['type'] == 2) 
					{
						$rec_data['money']['num'] = intval($val['num']);
						$rec_data['money']['type'] = intval($val['moneytype']);
					}
					else if ($val['type'] == 3) 
					{
						$rec_data['bribery'] = intval($val['num']);
					}
					else if ($val['type'] == 4) 
					{
						$goods_id = intval($val['goods_id']);
						$goods_name = trim($val['goods_name']);
						$goods_price = floatval($val['goods_price']);
						$goods_total = intval($val['goods_total']);
						$goods_spec = intval($val['goods_spec']);
						$goods_specname = trim($val['goods_specname']);
						if (isset($rec_data['goods'][$goods_id]['spec'])) 
						{
							$oldspec = $rec_data['goods'][$goods_id]['spec'];
						}
						else 
						{
							$oldspec = array();
						}
						$rec_data['goods'][$goods_id] = array('id' => $goods_id, 'title' => $goods_name, 'marketprice' => $goods_price, 'total' => $goods_total, 'spec' => $oldspec);
						if (0 < $goods_spec) 
						{
							$rec_data['goods'][$goods_id]['spec'][$goods_spec] = array('goods_spec' => $goods_spec, 'goods_specname' => $goods_specname, 'marketprice' => $goods_price, 'total' => $goods_total);
						}
						else 
						{
							$rec_data['goods'][$goods_id]['spec'] = '';
						}
					}
					else if ($val['type'] == 5) 
					{
						$coupon_id = intval($val['coupon_id']);
						$coupon_name = trim($val['coupon_name']);
						$coupon_num = intval($val['coupon_num']);
						$rec_data['coupon'][$coupon_id] = array('id' => $coupon_id, 'couponname' => $coupon_name, 'couponnum' => $coupon_num);
						if (isset($rec_data['coupon']['total'])) 
						{
							$rec_data['coupon']['total'] += $coupon_num;
						}
						else 
						{
							$rec_data['coupon']['total'] = 0;
							$rec_data['coupon']['total'] += $coupon_num;
						}
					}
				}
			}
			$sub_reward = htmlspecialchars_decode($_GPC['sub_reward_data']);
			$sub_reward = json_decode($sub_reward, 1);
			$sub_data = array();
			if (!(empty($sub_reward))) 
			{
				foreach ($sub_reward as $val ) 
				{
					if ($val['type'] == 1) 
					{
						$sub_data['credit'] = intval($val['num']);
					}
					else if ($val['type'] == 2) 
					{
						$sub_data['money']['num'] = intval($val['num']);
						$sub_data['money']['type'] = intval($val['moneytype']);
					}
					else if ($val['type'] == 3) 
					{
						$sub_data['bribery'] = intval($val['num']);
					}
					else if ($val['type'] == 5) 
					{
						$coupon_id = intval($val['coupon_id']);
						$coupon_name = trim($val['coupon_name']);
						$coupon_num = intval($val['coupon_num']);
						$sub_data['coupon'][$coupon_id] = array('id' => $coupon_id, 'couponname' => $coupon_name, 'couponnum' => $coupon_num);
						if (isset($sub_data['coupon']['total'])) 
						{
							$sub_data['coupon']['total'] += $coupon_num;
						}
						else 
						{
							$sub_data['coupon']['total'] = 0;
							$sub_data['coupon']['total'] += $coupon_num;
						}
					}
				}
			}
			$reward['rec'] = $rec_data;
			$reward['sub'] = $sub_data;
			$data['reward_data'] = serialize($reward);
			$keyword = m('common')->keyExist($data['keyword']);
			if (($item['keyword'] != $data['keyword']) && !(empty($keyword))) 
			{
				if ($keyword['name'] != 'wx_shop:task:' . $id)
				{
					show_json(0, '??????????????????!');
				}
			}
			if (!(empty($id))) 
			{
				pdo_update('wx_shop_task_poster', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				$updatesql = 'UPDATE ' . tablename('wx_shop_task_join') . ' SET  failtime = addtime+' . $data['days'] . ',needcount=:needcount WHERE uniacid = :uniacid AND task_id=:task_id AND task_type=1 AND failtime>' . time();
				pdo_query($updatesql, array(':needcount' => $data['needcount'], ':uniacid' => $_W['uniacid'], ':task_id' => $id));
				plog('task.edit', '?????????????????? ID: ' . $id . '<br>' . (($data['isopen'] ? '??????????????????????????????????????? -- ???<br>' : '??????????????????????????????????????? -- ???<br>')) . (($data['bedown'] ? '???????????????????????? -- ???<br>' : '???????????????????????? -- ???<br>')) . (($data['beagent'] ? '??????????????????????????? -- ???' : '??????????????????????????? -- ???')));
			}
			else 
			{
				pdo_insert('wx_shop_task_poster', $data);
				$id = pdo_insertid();
				plog('task.add', '?????????????????? ID: ' . $id . '<br>' . (($data['isopen'] ? '???????????????????????????????????????<br>' : '??????????????????????????????????????????<br>')) . (($data['bedown'] ? '???????????????????????? -- ???<br>' : '???????????????????????? -- ???<br>')) . (($data['beagent'] ? '??????????????????????????? -- ???' : '??????????????????????????? -- ???')));
			}
			$rule = pdo_fetch('select * from ' . tablename('rule') . ' where uniacid=:uniacid and module=:module and name=:name  limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'wx_shop', ':name' => 'wx_shop:task:' . $id));
			$rule_data = array('uniacid' => $_W['uniacid'], 'name' => 'wx_shop:task:' . $id, 'module' => 'wx_shop', 'displayorder' => 0, 'status' => $data['status']);
			$keyword_data = array('uniacid' => $_W['uniacid'], 'module' => 'wx_shop', 'content' => trim($data['keyword']), 'type' => 1, 'displayorder' => 0, 'status' => $data['status']);
			if (empty($rule)) 
			{
				pdo_insert('rule', $rule_data);
				$keyword_data['rid'] = pdo_insertid();
				pdo_insert('rule_keyword', $keyword_data);
			}
			else 
			{
				pdo_update('rule_keyword', $keyword_data, array('rid' => $rule['id']));
			}
			$ruleauto = pdo_fetch('select * from ' . tablename('rule') . ' where uniacid=:uniacid and module=:module and name=:name  limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'wx_shop', ':name' => 'wx_shop:task:auto'));
			if (empty($ruleauto)) 
			{
				$rule_data = array('uniacid' => $_W['uniacid'], 'name' => 'wx_shop:task:auto', 'module' => 'wx_shop', 'displayorder' => 0, 'status' => 1);
				pdo_insert('rule', $rule_data);
				$rid = pdo_insertid();
				$keyword_data = array('uniacid' => $_W['uniacid'], 'rid' => $rid, 'module' => 'wx_shop', 'content' => 'WX_SHOP_TASK', 'type' => 1, 'displayorder' => 0, 'status' => 1);
				pdo_insert('rule_keyword', $keyword_data);
			}
			show_json(1, array('url' => webUrl('task')));
		}
		$imgroot = $_W['attachurl'];
		if (empty($_W['setting']['remote'])) 
		{
			setting_load('remote');
		}
		if (!(empty($_W['setting']['remote']['type']))) 
		{
			$imgroot = $_W['attachurl_remote'];
		}
		if (empty($item['timestart'])) 
		{
			$starttime = time();
			$endtime = strtotime(date('Y-m-d H:i', $starttime) . '+30 days');
		}
		else 
		{
			$type = $item['coupontype'];
			$starttime = $item['timestart'];
			$endtime = $item['timeend'];
		}
		if (!(empty($item))) 
		{
			$reward = unserialize($item['reward_data']);
			$rec_reward = $reward['rec'];
			$sub_reward = $reward['sub'];
		}
		else 
		{
			$rec_reward = '';
			$sub_reward = '';
		}
		$default_text = pdo_fetchcolumn('SELECT `data` FROM ' . tablename('wx_shop_task_default') . ' WHERE uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
		if (!(empty($default_text))) 
		{
			$default_text = unserialize($default_text);
			if (empty($item['starttext'])) 
			{
				$item['starttext'] = $default_text['poster']['starttext'];
			}
			if (empty($item['endtext'])) 
			{
				$item['endtext'] = $default_text['poster']['endtext'];
			}
			if (empty($item['waittext'])) 
			{
				$item['waittext'] = $default_text['poster']['waittext'];
			}
			if (empty($item['opentext'])) 
			{
				$item['opentext'] = $default_text['poster']['opentext'];
			}
		}
		include $this->template();
	}
	protected function rankpost() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$item = pdo_fetch('SELECT * FROM ' . tablename('wx_shop_task_poster') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (!(empty($item))) 
		{
			$data = json_decode(str_replace('&quot;', '\'', $item['data']), true);
		}
		if ($_W['ispost']) 
		{
			load()->model('account');
			$data = array('uniacid' => $_W['uniacid'], 'days' => intval($_GPC['days']) * 24 * 3600, 'reward_days' => intval($_GPC['reward_days']) * 24 * 3600, 'title' => trim($_GPC['title']), 'titleicon' => trim($_GPC['titleicon']), 'poster_banner' => trim($_GPC['poster_banner']), 'keyword' => trim($_GPC['keyword']), 'bg' => save_media($_GPC['bg']), 'data' => htmlspecialchars_decode($_GPC['data']), 'resptype' => trim($_GPC['resptype']), 'resptext' => trim($_GPC['resptext']), 'resptitle' => trim($_GPC['resptitle']), 'respthumb' => trim($_GPC['respthumb']), 'respdesc' => trim($_GPC['respdesc']), 'respurl' => trim($_GPC['respurl']), 'createtime' => time(), 'oktext' => trim($_GPC['oktext']), 'waittext' => trim($_GPC['waittext']), 'bedown' => intval($_GPC['bedown']), 'beagent' => intval($_GPC['beagent']), 'getposter' => trim($_GPC['getposter']), 'timestart' => strtotime($_GPC['time']['start']), 'timeend' => strtotime($_GPC['time']['end']), 'is_repeat' => intval($_GPC['is_repeat']), 'status' => intval($_GPC['status']), 'is_goods' => intval($_GPC['is_goods']), 'autoposter' => intval($_GPC['autoposter']), 'starttext' => trim($_GPC['starttext']), 'endtext' => trim($_GPC['endtext']), 'needcount' => 0, 'poster_type' => (isset($_GPC['poster_type']) ? intval($_GPC['poster_type']) : 1));
			$reward = array();
			$rec_reward = htmlspecialchars_decode($_GPC['rec_reward_data']);
			$rec_reward_rank = htmlspecialchars_decode($_GPC['rec_reward_rank']);
			$rec_reward = json_decode($rec_reward, 1);
			$rec_reward_rank = json_decode($rec_reward_rank, 1);
			$rec_data = array();
			if (!(empty($rec_reward))) 
			{
				foreach ($rec_reward as $val ) 
				{
					$rank = intval($val['rank']);
					if ($val['type'] == 1) 
					{
						$rec_data[$rank]['credit'] = intval($val['num']);
					}
					else if ($val['type'] == 2) 
					{
						$rec_data[$rank]['money']['num'] = intval($val['num']);
						$rec_data[$rank]['money']['type'] = intval($val['moneytype']);
					}
					else if ($val['type'] == 3) 
					{
						$rec_data[$rank]['bribery'] = intval($val['num']);
					}
					else if ($val['type'] == 4) 
					{
						$goods_id = intval($val['goods_id']);
						$goods_name = trim($val['goods_name']);
						$goods_price = floatval($val['goods_price']);
						$goods_total = intval($val['goods_total']);
						$goods_spec = intval($val['goods_spec']);
						$goods_specname = trim($val['goods_specname']);
						if (isset($rec_data[$rank]['goods'][$goods_id]['spec'])) 
						{
							$oldspec = $rec_data[$rank]['goods'][$goods_id]['spec'];
						}
						else 
						{
							$oldspec = array();
						}
						$rec_data[$rank]['goods'][$goods_id] = array('id' => $goods_id, 'title' => $goods_name, 'marketprice' => $goods_price, 'total' => $goods_total, 'spec' => $oldspec);
						if (0 < $goods_spec) 
						{
							$rec_data[$rank]['goods'][$goods_id]['spec'][$goods_spec] = array('goods_spec' => $goods_spec, 'goods_specname' => $goods_specname, 'marketprice' => $goods_price, 'total' => $goods_total);
						}
						else 
						{
							$rec_data[$rank]['goods'][$goods_id]['spec'] = '';
						}
					}
					else if ($val['type'] == 5) 
					{
						$coupon_id = intval($val['coupon_id']);
						$coupon_name = trim($val['coupon_name']);
						$coupon_num = intval($val['coupon_num']);
						$rec_data[$rank]['coupon'][$coupon_id] = array('id' => $coupon_id, 'couponname' => $coupon_name, 'couponnum' => $coupon_num);
						if (isset($rec_data[$rank]['coupon']['total'])) 
						{
							$rec_data[$rank]['coupon']['total'] += $coupon_num;
						}
						else 
						{
							$rec_data[$rank]['coupon']['total'] = 0;
							$rec_data[$rank]['coupon']['total'] += $coupon_num;
						}
					}
				}
			}
			if (!(empty($rec_reward_rank))) 
			{
				$rank_count = 1;
				foreach ($rec_reward_rank as $key => $value ) 
				{
					$rank_state = intval($value['rank_state']);
					if ($rank_state == 0) 
					{
						unset($rec_data[$value['rank']]);
					}
					else 
					{
						if ($rank_count < intval($value['rank'])) 
						{
							$rank_count = intval($value['rank']);
						}
						$needcount = intval($value['needcount']);
						if (0 < $needcount) 
						{
							$rec_data[$value['rank']]['needcount'] = $needcount;
							$rec_data[$value['rank']]['rank'] = intval($value['rank']);
						}
						else 
						{
							unset($rec_data[$value['rank']]);
						}
					}
				}
				$i = 1;
				while ($i <= $rank_count) 
				{
					if (!(isset($rec_data[$i]))) 
					{
						$rec_data[$i] = array();
					}
					++$i;
				}
			}
			if (!(empty($rec_data))) 
			{
				ksort($rec_data);
			}
			$sub_reward = htmlspecialchars_decode($_GPC['sub_reward_data']);
			$sub_reward = json_decode($sub_reward, 1);
			$sub_data = array();
			if (!(empty($sub_reward))) 
			{
				foreach ($sub_reward as $val ) 
				{
					if ($val['type'] == 1) 
					{
						$sub_data['credit'] = intval($val['num']);
					}
					else if ($val['type'] == 2) 
					{
						$sub_data['money']['num'] = intval($val['num']);
						$sub_data['money']['type'] = intval($val['moneytype']);
					}
					else if ($val['type'] == 3) 
					{
						$sub_data['bribery'] = intval($val['num']);
					}
					else if ($val['type'] == 5) 
					{
						$coupon_id = intval($val['coupon_id']);
						$coupon_name = trim($val['coupon_name']);
						$coupon_num = intval($val['coupon_num']);
						$sub_data['coupon'][$coupon_id] = array('id' => $coupon_id, 'couponname' => $coupon_name, 'couponnum' => $coupon_num);
						if (isset($sub_data['coupon']['total'])) 
						{
							$sub_data['coupon']['total'] += $coupon_num;
						}
						else 
						{
							$sub_data['coupon']['total'] = 0;
							$sub_data['coupon']['total'] += $coupon_num;
						}
					}
				}
			}
			$reward['rec'] = $rec_data;
			$reward['sub'] = $sub_data;
			$data['reward_data'] = serialize($reward);
			$keyword = m('common')->keyExist($data['keyword']);
			if (($item['keyword'] != $data['keyword']) && !(empty($keyword))) 
			{
				if ($keyword['name'] != 'wx_shop:task:' . $id)
				{
					show_json(0, '??????????????????!');
				}
			}
			if (!(empty($id))) 
			{
				pdo_update('wx_shop_task_poster', $data, array('id' => $id, 'uniacid' => $_W['uniacid']));
				$updatesql = 'UPDATE ' . tablename('wx_shop_task_join') . ' SET  failtime = addtime+' . $data['days'] . ',needcount=:needcount WHERE uniacid = :uniacid AND task_id=:task_id AND task_type=1 AND failtime>' . time();
				pdo_query($updatesql, array(':needcount' => $data['needcount'], ':uniacid' => $_W['uniacid'], ':task_id' => $id));
				plog('task.edit', '?????????????????? ID: ' . $id . '<br>' . (($data['isopen'] ? '??????????????????????????????????????? -- ???<br>' : '??????????????????????????????????????? -- ???<br>')) . (($data['bedown'] ? '???????????????????????? -- ???<br>' : '???????????????????????? -- ???<br>')) . (($data['beagent'] ? '??????????????????????????? -- ???' : '??????????????????????????? -- ???')));
			}
			else 
			{
				pdo_insert('wx_shop_task_poster', $data);
				$id = pdo_insertid();
				plog('task.add', '?????????????????? ID: ' . $id . '<br>' . (($data['isopen'] ? '???????????????????????????????????????<br>' : '??????????????????????????????????????????<br>')) . (($data['bedown'] ? '???????????????????????? -- ???<br>' : '???????????????????????? -- ???<br>')) . (($data['beagent'] ? '??????????????????????????? -- ???' : '??????????????????????????? -- ???')));
			}
			$rule = pdo_fetch('select * from ' . tablename('rule') . ' where uniacid=:uniacid and module=:module and name=:name  limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'wx_shop', ':name' => 'wx_shop:task:' . $id));
			$rule_data = array('uniacid' => $_W['uniacid'], 'name' => 'wx_shop:task:' . $id, 'module' => 'wx_shop', 'displayorder' => 0, 'status' => $data['status']);
			$keyword_data = array('uniacid' => $_W['uniacid'], 'module' => 'wx_shop', 'content' => trim($data['keyword']), 'type' => 1, 'displayorder' => 0, 'status' => $data['status']);
			if (empty($rule)) 
			{
				pdo_insert('rule', $rule_data);
				$keyword_data['rid'] = pdo_insertid();
				pdo_insert('rule_keyword', $keyword_data);
			}
			else 
			{
				pdo_update('rule_keyword', $keyword_data, array('rid' => $rule['id']));
			}
			$ruleauto = pdo_fetch('select * from ' . tablename('rule') . ' where uniacid=:uniacid and module=:module and name=:name  limit 1', array(':uniacid' => $_W['uniacid'], ':module' => 'wx_shop', ':name' => 'wx_shop:task:auto'));
			if (empty($ruleauto)) 
			{
				$rule_data = array('uniacid' => $_W['uniacid'], 'name' => 'wx_shop:task:auto', 'module' => 'wx_shop', 'displayorder' => 0, 'status' => 1);
				pdo_insert('rule', $rule_data);
				$rid = pdo_insertid();
				$keyword_data = array('uniacid' => $_W['uniacid'], 'rid' => $rid, 'module' => 'wx_shop', 'content' => 'WX_SHOP_TASK', 'type' => 1, 'displayorder' => 0, 'status' => 1);
				pdo_insert('rule_keyword', $keyword_data);
			}
			show_json(1, array('url' => webUrl('task')));
		}
		$imgroot = $_W['attachurl'];
		if (empty($_W['setting']['remote'])) 
		{
			setting_load('remote');
		}
		if (!(empty($_W['setting']['remote']['type']))) 
		{
			$imgroot = $_W['attachurl_remote'];
		}
		if (empty($item['timestart'])) 
		{
			$starttime = time();
			$endtime = strtotime(date('Y-m-d H:i', $starttime) . '+30 days');
		}
		else 
		{
			$type = $item['coupontype'];
			$starttime = $item['timestart'];
			$endtime = $item['timeend'];
		}
		if (!(empty($item))) 
		{
			$reward = unserialize($item['reward_data']);
			$rec_reward = $reward['rec'];
			$sub_reward = $reward['sub'];
		}
		else 
		{
			$rec_reward = '';
			$sub_reward = '';
		}
		$default_text = pdo_fetchcolumn('SELECT `data` FROM ' . tablename('wx_shop_task_default') . ' WHERE uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid']));
		if (!(empty($default_text))) 
		{
			$default_text = unserialize($default_text);
			if (empty($item['starttext'])) 
			{
				$item['starttext'] = $default_text['poster']['starttext'];
			}
			if (empty($item['endtext'])) 
			{
				$item['endtext'] = $default_text['poster']['endtext'];
			}
			if (empty($item['waittext'])) 
			{
				$item['waittext'] = $default_text['poster']['waittext'];
			}
			if (empty($item['opentext'])) 
			{
				$item['opentext'] = $default_text['poster']['opentext'];
			}
		}
		include $this->template('lottery/task/rankpost');
	}
	public function delete() 
	{
		if ($this->new) 
		{
			$this->delete_new();
			exit();
		}
		global $_GPC;
		global $_W;
		$id = intval($_GPC['id']);
		if (empty($id)) 
		{
			$id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
		}
		$posters = pdo_fetchall('SELECT id,title,keyword FROM ' . tablename('wx_shop_task_poster') . ' WHERE id in ( ' . $id . ' ) and uniacid=' . $_W['uniacid']);
		foreach ($posters as $poster ) 
		{
			$rule = pdo_fetchall('SELECT id,rid FROM ' . tablename('rule_keyword') . ' WHERE uniacid=:uniacid AND content IN (\'' . $poster['keyword'] . '\')', array(':uniacid' => $_W['uniacid']), 'rid');
			$rule = array_keys($rule);
			m('common')->delrule($rule);
			pdo_delete('wx_shop_task_poster', array('id' => $poster['id'], 'uniacid' => $_W['uniacid']));
			pdo_delete('wx_shop_task_log', array('taskid' => $poster['id'], 'task_type' => 1, 'uniacid' => $_W['uniacid']));
			pdo_delete('wx_shop_task_join', array('taskid' => $poster['id'], 'task_type' => 1, 'uniacid' => $_W['uniacid']));
			plog('task.delete', '?????????????????? ID: ' . $id . ' ????????????: ' . $poster['title']);
		}
		show_json(1, array('url' => webUrl('task')));
	}
	public function clear() 
	{
		global $_W;
		global $_GPC;
		load()->func('file');
		@rmdirs(IA_ROOT . '/addons/wx_shop/data/task/poster/' . $_W['uniacid']);
		@rmdirs(IA_ROOT . '/addons/wx_shop/data/task/qrcode/' . $_W['uniacid']);
		$acid = pdo_fetchcolumn('SELECT acid FROM ' . tablename('account_wechats') . ' WHERE `uniacid`=:uniacid LIMIT 1', array(':uniacid' => $_W['uniacid']));
		pdo_update('wx_shop_task_poster_qr', array('mediaid' => ''), array('acid' => $acid));
		plog('task.clear', '????????????????????????');
		show_json(1, array('url' => webUrl('task', array('op' => 'display'))));
	}
	public function delreward() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = intval($_GPC['del_type']);
		$datatype = intval($_GPC['data_type']);
		$data = $_GPC['data_value'];
		if ($type == 1) 
		{
			$item = pdo_fetch('SELECT `id`,`reward_data` FROM ' . tablename('wx_shop_task_poster') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
			$item['reward_data'] = unserialize($item['reward_data']);
			if ($datatype == 1) 
			{
				$item['reward_data']['rec']['credit'] = 0;
			}
			if ($datatype == 2) 
			{
				$item['reward_data']['rec']['money']['num'] = 0;
			}
			if ($datatype == 3) 
			{
				$item['reward_data']['rec']['bribery'] = 0;
			}
			if ($datatype == 4) 
			{
				$is_spec = strpos($data, '-');
				if ($is_spec) 
				{
					$data = explode('_', $data);
					if (isset($item['reward_data']['rec']['goods'][$data[0]]['spec'][$data[1]])) 
					{
						unset($item['reward_data']['rec']['goods'][$data[0]]['spec'][$data[1]]);
					}
					if (isset($item['reward_data']['rec']['goods'][$data[0]]['spec']) && empty($item['reward_data']['rec']['goods'][$data[0]]['spec'])) 
					{
						unset($item['reward_data']['rec']['goods'][$data[0]]);
					}
				}
				else if (isset($item['reward_data']['rec']['goods'][$data[0]])) 
				{
					unset($item['reward_data']['rec']['goods'][$data[0]]);
				}
			}
			if ($datatype == 5) 
			{
				if (isset($item['reward_data']['rec']['coupon'][$data])) 
				{
					unset($item['reward_data']['rec']['coupon'][$data]);
				}
			}
			$item['reward_data'] = serialize($item['reward_data']);
			pdo_update('wx_shop_task_poster', array('reward_data' => $item['reward_data']), array('id' => $id, 'uniacid' => $_W['uniacid']));
			$item['reward_data'] = unserialize($item['reward_data']);
			echo json_encode(array('status' => 1, 'info' => $item['reward_data']['rec']));
			exit();
		}
		else if ($type == 2) 
		{
			$item = pdo_fetch('SELECT `id`,`reward_data` FROM ' . tablename('wx_shop_task_poster') . ' WHERE id =:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
			$item['reward_data'] = unserialize($item['reward_data']);
			if ($datatype == 1) 
			{
				$item['reward_data']['sub']['credit'] = 0;
			}
			if ($datatype == 2) 
			{
				$item['reward_data']['sub']['money']['num'] = 0;
			}
			if ($datatype == 3) 
			{
				$item['reward_data']['sub']['bribery'] = 0;
			}
			if ($datatype == 5) 
			{
				if (isset($item['reward_data']['sub']['coupon'][$data])) 
				{
					unset($item['reward_data']['sub']['coupon'][$data]);
				}
			}
			$item['reward_data'] = serialize($item['reward_data']);
			pdo_update('wx_shop_task_poster', array('reward_data' => $item['reward_data']), array('id' => $id, 'uniacid' => $_W['uniacid']));
			$item['reward_data'] = unserialize($item['reward_data']);
			echo json_encode(array('status' => 1, 'info' => $item['reward_data']['sub']));
			exit();
		}
		else 
		{
			echo json_encode(array('status' => 0, 'info' => '?????????????????????'));
			exit();
		}
	}
	public function main_new() 
	{
		global $_W;
		global $_GPC;
		$date = date('Y-m-d H:i:s');
		$taskS = array();
		$taskS[0] = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_task_record') . ' where uniacid = ' . $_W['uniacid']);
		$taskS[1] = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_task_record') . ' where uniacid = ' . $_W['uniacid'] . ' and finishtime > \'0000-00-00 00:00:00\' ');
		$taskS[2] = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_task_record') . ' where uniacid = ' . $_W['uniacid'] . ' and finishtime = \'0000-00-00 00:00:00\' and stoptime < \'' . $date . '\'');
		$taskS[3] = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_task_record') . ' where uniacid = ' . $_W['uniacid'] . ' and finishtime = \'0000-00-00 00:00:00\' and stoptime > \'' . $date . '\'');
		$rewardS = array();
		$rewardS[0] = (int) pdo_fetchcolumn('select sum(reward_data) from ' . tablename('wx_shop_task_reward') . ' where uniacid = ' . $_W['uniacid'] . ' and `get` = 1 and reward_type = \'credit\'');
		$rewardS[1] = (double) pdo_fetchcolumn('select sum(reward_data) from ' . tablename('wx_shop_task_reward') . ' where uniacid = ' . $_W['uniacid'] . ' and `get` = 1 and reward_type = \'redpacket\'');
		$rewardS[2] = (double) pdo_fetchcolumn('select sum(reward_data) from ' . tablename('wx_shop_task_reward') . ' where uniacid = ' . $_W['uniacid'] . ' and `get` = 1 and reward_type = \'balance\'');
		$rewardS[3] = (int) pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_task_reward') . ' where uniacid = ' . $_W['uniacid'] . ' and `get` = 1 and reward_type = \'coupon\'');
		include $this->template('lottery/task/new/index');
	}
	public function tasklist() 
	{
		global $_GPC;
		$page = (int) $_GPC['page'];
		// $list = $this->model->getAllTask($page);
		$list = p('task')->getAllTask($page);
		// var_dump($this->template($page));die;
		include $this->template('lottery/task/new/tasklist');
	}
	public function record() 
	{
		global $_W;
		global $_GPC;
		$page = (int) $_GPC['page'];
		$records = $this->model->getAllRecords($page);
		include $this->template('lottery/task/new/record');
	}
	public function reward() 
	{
		global $_W;
		global $_GPC;
		$page = (int) $_GPC['page'];
		$rewards = $this->model->getAllRewards($page);
		include $this->template('lottery/task/new/reward');
	}
	public function notice() 
	{
		global $_W;
		global $_GPC;
		if ($_W['ispost']) 
		{
			$msg = $_GPC['msg'];
			$data['msg_pick'] = $msg['pick'];
			$data['msg_progress'] = $msg['progress'];
			$data['msg_finish'] = $msg['finish'];
			$data['msg_follow'] = $msg['follow'];
			$saveRet = $this->model->taskSave('wx_shop_task_set', $data);
			empty($saveRet) && show_json(0, '????????????');
			show_json(1);
		}
		$msg = $this->model->getMessageSet();
		include $this->template('lottery/task/new/notice');
	}
	public function setting() 
	{
		global $_W;
		global $_GPC;
		$set = pdo_get('wx_shop_task_set', array('uniacid' => $_W['uniacid']));
		$data = $this->getset();
		if ($_W['ispost']) 
		{
			$set['entrance'] = intval($_GPC['entrance']);
			$set['keyword'] = trim($_GPC['keyword']);
			$set['cover_title'] = trim($_GPC['cover_title']);
			$set['cover_img'] = trim($_GPC['cover_img']);
			$set['bg_img'] = trim($_GPC['bg_img']);
			$set['cover_desc'] = trim($_GPC['cover_desc']);

            m('common')->updatePluginset(array('lottery' => array('on_show_wxapp'=>$_GPC['data']['on_show_wxapp'])));

			$saveCover = $this->saveCover($set['keyword'], $set['cover_img'], $set['cover_desc'], $set['cover_title']);
			empty($saveCover) && show_json(0, '??????????????????');
			$saveRet = $this->model->taskSave('wx_shop_task_set', $set);
			empty($saveRet) && show_json(0, '????????????');
			show_json(1);
		}
		include $this->template('lottery/task/new/setting');
	}
	protected function saveCover($keyword, $img, $desc, $title) 
	{
		global $_W;
		$entranceName = 'wx_shop:????????????????????????';
		$rid = pdo_fetchcolumn('select id from ' . tablename('rule') . ' where uniacid = ' . $_W['uniacid'] . ' and `name` = \'' . $entranceName . '\'');
		if (empty($rid)) 
		{
			if (pdo_insert('rule', array('uniacid' => $_W['uniacid'], 'name' => $entranceName, 'module' => 'cover', 'status' => 1))) 
			{
				$rid = pdo_insertid();
			}
		}
		if (pdo_fetchcolumn('select count(1) from ' . tablename('rule_keyword') . ' where content = \'' . $keyword . '\' and uniacid = ' . $_W['uniacid'] . ' and rid <> ' . $rid)) 
		{
			show_json(0, '??????????????????????????????');
		}
		$kid = pdo_fetchcolumn('select id from ' . tablename('rule_keyword') . ' where rid = ' . $rid);
		if (empty($kid)) 
		{
			pdo_insert('rule_keyword', array('rid' => $rid, 'uniacid' => $_W['uniacid'], 'module' => 'cover', 'content' => $keyword, 'type' => 1, 'status' => 1));
		}
		else 
		{
			pdo_update('rule_keyword', array('rid' => $rid, 'uniacid' => $_W['uniacid'], 'module' => 'cover', 'content' => $keyword, 'type' => 1, 'status' => 1), array('id' => $kid));
		}
		$cid = pdo_fetchcolumn('select id from ' . tablename('cover_reply') . ' where rid = ' . $rid . ' and uniacid = ' . $_W['uniacid']);
		if (empty($cid)) 
		{
			pdo_insert('cover_reply', array('uniacid' => $_W['uniacid'], 'rid' => $rid, 'module' => 'wx_shop', 'title' => $title, 'description' => $desc, 'thumb' => $img, 'url' => mobileUrl('task', NULL, 1)));
		}
		else 
		{
			pdo_update('cover_reply', array('uniacid' => $_W['uniacid'], 'rid' => $rid, 'module' => 'wx_shop', 'title' => $title, 'description' => $desc, 'thumb' => $img, 'url' => mobileUrl('task', NULL, 1)), array('id' => $cid));
		}
		return true;
	}
	public function post_new() 
	{
		global $_W;
		global $_GPC;
		$id = (int) $_GPC['id'];
		!(empty($id)) && ($task = $this->model->getThisTask($id));
		if (empty($task) && !(empty($id))) 
		{
			header('location:' . webUrl('task.post'));
			exit();
		}
		if (!(empty($task['requiregoods']))) 
		{
			$task['requiregoods'] = trim($task['requiregoods'], ',');
			$goods = pdo_fetchall('select id,title,thumb from ' . tablename('wx_shop_goods') . ' where id in (' . $task['requiregoods'] . ') and status=1 and deleted=0 and uniacid=' . $_W['uniacid'] . ' order by instr(\'' . $task['requiregoods'] . '\',id)');
		}
		if ($_W['ispost']) 
		{
			$diy = $_GPC['diy'];
			if (empty($diy['verb']) || empty($diy['unit'])) 
			{
				show_json(0, '???????????????????????????');
			}
			pdo_update('wx_shop_task_type', array('verb' => $diy['verb'], 'unit' => $diy['unit']), array('type_key' => 'poster'));
			$rewardgoods = $_GPC['rewardgoods'];
			$native_data = htmlspecialchars_decode($rewardgoods);
			$rewardgoods = json_decode(htmlspecialchars_decode($rewardgoods), 1);
			if (is_array($rewardgoods)) 
			{
				foreach ($rewardgoods as $key => $val ) 
				{
					if (empty($val['column']) || empty($val['column']['title']) || empty($val['column']['num'])) 
					{
						show_json(0, '??????????????????????????????????????????');
					}
					if (is_array($val['column'])) 
					{
						foreach ($val['column'] as $k => $v ) 
						{
							$temp_rewardgoods[$k] = $v;
							$temp_rewardgoods['id'] = $val['id'];
						}
					}
					$to_rewardgoods[] = $temp_rewardgoods;
					$temp_rewardgoods = NULL;
				}
			}
			$rewardgoods = $_GPC['rewardgoods2'];
			$native_data2 = htmlspecialchars_decode($rewardgoods);
			$rewardgoods = json_decode(htmlspecialchars_decode($rewardgoods), 1);
			if (is_array($rewardgoods)) 
			{
				foreach ($rewardgoods as $key => $val ) 
				{
					if (empty($val['column']) || empty($val['column']['title']) || empty($val['column']['num'])) 
					{
						show_json(0, '??????????????????????????????????????????');
					}
					if (is_array($val['column'])) 
					{
						foreach ($val['column'] as $k => $v ) 
						{
							$temp_rewardgoods[$k] = $v;
							$temp_rewardgoods['id'] = $val['id'];
						}
					}
					$to_rewardgoods2[] = $temp_rewardgoods;
					$temp_rewardgoods = NULL;
				}
			}
			$rewardgoods = $_GPC['rewardgoods3'];
			$native_data3 = htmlspecialchars_decode($rewardgoods);
			$rewardgoods = json_decode(htmlspecialchars_decode($rewardgoods), 1);
			if (is_array($rewardgoods)) 
			{
				foreach ($rewardgoods as $key => $val ) 
				{
					if (empty($val['column']) || empty($val['column']['title']) || empty($val['column']['num'])) 
					{
						show_json(0, '??????????????????????????????????????????');
					}
					if (is_array($val['column'])) 
					{
						foreach ($val['column'] as $k => $v ) 
						{
							$temp_rewardgoods[$k] = $v;
							$temp_rewardgoods['id'] = $val['id'];
						}
					}
					$to_rewardgoods3[] = $temp_rewardgoods;
					$temp_rewardgoods = NULL;
				}
			}
			if ($id) 
			{
				$data['id'] = $id;
			}
			$data['native_data'] = $native_data;
			$data['native_data2'] = $native_data2;
			$data['native_data3'] = $native_data3;
			$posttype = trim($_GPC['posttype']);
			$data['title'] = trim($_GPC['title']);
			empty($data['title']) && show_json(0, '???????????????');
			$data['image'] = trim($_GPC['image']);
			empty($data['image']) && show_json(0, '??????????????????');
			$data['type'] = trim($_GPC['type']);
			empty($data['type']) && show_json(0, '?????????????????????');
			$taskType = $this->model->getTaskType($data['type']);
			empty($taskType) && show_json(0, '??????????????????');
			if ($taskType['type_key'] == 'goods') 
			{
				$data['requiregoods'] = $_GPC['requiregoods'];
			}
			if (is_array($data['requiregoods'])) 
			{
				$data['requiregoods'] = implode(',', $data['requiregoods']);
			}
			$opentime = $_GPC['opentime'];
			$data['starttime'] = $opentime['start'];
			empty($data['starttime']) && show_json(0, '?????????????????????');
			$data['endtime'] = $opentime['end'];
			empty($data['endtime']) && show_json(0, '?????????????????????');
			$interval = strtotime($data['endtime']) - strtotime($data['starttime']);
			if (0 < ($interval - (86400 * 30))) 
			{
			}
			$data['demand'] = max(intval($_GPC['requirenumber']), 1);
			if (empty($taskType['unit'])) 
			{
				$data['demand'] = 1;
			}
			$data['picktype'] = intval($_GPC['picktype']);
			if ($data['picktype'] != '1') 
			{
				$data['stop_type'] = intval($_GPC['stoptype']);
				switch ($data['stop_type']) 
				{
					case 1: $data['stop_limit'] = max(3600, 3600 * (int) $_GPC['stoplimit']);
					break;
					case 2: $data['stop_time'] = $_GPC['stoptime'];
					empty($data['stop_time']) && show_json(0, '?????????????????????');
					break;
					case 3: $data['stop_cycle'] = intval($_GPC['stopcycle']);
					break;
				}
				$data['repeat_type'] = intval($_GPC['repeattype']);
				switch ($data['repeat_type']) 
				{
					case 2: $data['repeat_interval'] = max(3600, 3600 * (int) $_GPC['repeatinterval']);
					break;
					case 3: $data['repeat_cycle'] = intval($_GPC['repeatcycle']);
					break;
				}
			}
			$reward['credit'] = max(0, intval($_GPC['rewardcredit']));
			$reward['balance'] = max(0, floatval($_GPC['rewardbalance']));
			$reward['redpacket'] = floatval($_GPC['rewardredpacket']);
			$reward['coupon'] = json_decode(htmlspecialchars_decode($_GPC['rewardcoupon']), 1);
			$reward['goods'] = $to_rewardgoods;
			if (empty($reward['credit']) && empty($reward['balance']) && empty($reward['redpacket']) && empty($reward['coupon']) && empty($reward['goods'])) 
			{
				show_json(0, '????????????????????????');
			}
			$data['reward'] = json_encode($reward);
			$level2 = intval($_GPC['level_2']);
			if ($level2) 
			{
				if ($level2 <= $data['demand']) 
				{
					show_json(0, '????????????????????????????????????');
				}
				$reward2['credit'] = max(0, intval($_GPC['rewardcredit2']));
				$reward2['balance'] = max(0, floatval($_GPC['rewardbalance2']));
				$reward2['redpacket'] = floatval($_GPC['rewardredpacket2']);
				$reward2['coupon'] = json_decode(htmlspecialchars_decode($_GPC['rewardcoupon2']), 1);
				$reward2['goods'] = $to_rewardgoods2;
				if (empty($reward2['credit']) && empty($reward2['balance']) && empty($reward2['redpacket']) && empty($reward2['coupon']) && empty($reward2['goods'])) 
				{
					show_json(0, '????????????????????????');
				}
				$data['level2'] = $level2;
				$data['reward2'] = json_encode($reward2);
				$level3 = intval($_GPC['level_3']);
				if ($level3) 
				{
					$data['level3'] = $level3;
					if (($level3 <= $data['demand']) || ($level3 <= $level2)) 
					{
						show_json(0, '?????????????????????????????????????????????');
					}
					$reward3['credit'] = max(0, intval($_GPC['rewardcredit3']));
					$reward3['balance'] = max(0, floatval($_GPC['rewardbalance3']));
					$reward3['redpacket'] = floatval($_GPC['rewardredpacket3']);
					$reward3['coupon'] = json_decode(htmlspecialchars_decode($_GPC['rewardcoupon3']), 1);
					$reward3['goods'] = $to_rewardgoods3;
					if (empty($reward3['credit']) && empty($reward3['balance']) && empty($reward3['redpacket']) && empty($reward3['coupon']) && empty($reward3['goods'])) 
					{
						show_json(0, '????????????????????????');
					}
					$data['reward3'] = json_encode($reward3);
				}
				else 
				{
					$data['level3'] = 0;
					$data['reward3'] = '';
					$data['native_data3'] = '';
				}
			}
			else 
			{
				$data['level2'] = 0;
				$data['reward2'] = '';
				$data['native_data2'] = '';
				$data['level3'] = 0;
				$data['reward3'] = '';
				$data['native_data3'] = '';
			}
			$followreward['credit'] = intval($_GPC['followrewardcredit']);
			$followreward['balance'] = floatval($_GPC['followrewardbalance']);
			$followreward['redpacket'] = floatval($_GPC['followrewardredpacket']);
			$followreward['coupon'] = json_decode(htmlspecialchars_decode($_GPC['followrewardcoupon']), 1);
			if (($data['type'] == 'poster') && empty($followreward['credit']) && empty($followreward['balance']) && empty($followreward['redpacket']) && empty($followreward['coupon'])) 
			{
				show_json(0, '????????????????????????');
			}
			$data['followreward'] = json_encode($followreward);
			$data['design_bg'] = trim($_GPC['design_bg']);
			$data['design_data'] = htmlspecialchars_decode($_GPC['design_data']);
			if (($data['type'] == 'poster') && (($data['design_data'] == '[]') || empty($data['design_data']))) 
			{
				show_json(0, '????????????????????????');
			}
			$saveRet = $this->model->taskSave('wx_shop_task_list', $data);
			empty($saveRet) && show_json(0, '??????????????????????????????');
			show_json(1, array('message' => '????????????', 'url' => webUrl('task.post', array('id' => $saveRet))));
		}
		else 
		{
			!(empty($task['followreward'])) && ($followreward = json_decode($task['followreward'], 1));
			!(empty($task['reward'])) && ($reward = json_decode($task['reward'], 1));
			!(empty($task['reward2'])) && ($reward2 = json_decode($task['reward2'], 1));
			!(empty($task['reward3'])) && ($reward3 = json_decode($task['reward3'], 1));
			empty($reward['coupon']) && ($reward['coupon'] = array());
			empty($reward2['coupon']) && ($reward2['coupon'] = array());
			empty($reward3['coupon']) && ($reward3['coupon'] = array());
			!(empty($task['design_data'])) && ($design_data = json_decode(str_replace('&quot;', '\'', $task['design_data']), true));
			if (empty($task)) 
			{
				$task['starttime'] = date('Y-m-d H:i:s');
				$task['endtime'] = date('Y-m-d H:i:s', time() + (86400 * 7));
			}
			$poster_text = pdo_get('wx_shop_task_type', array('type_key' => 'poster'), array('verb', 'unit'));
			include $this->template('lottery/task/new/post');
		}
	}
	public function preview() 
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$sql = 'select rc.*,rw.* from ' . tablename('wx_shop_task_record') . ' rc left join ' . tablename('wx_shop_task_reward') . ' rw on rc.id = rw.recordid where rc.id = ' . $id . ' and rc.uniacid = ' . $_W['uniacid'];
		$data = pdo_fetchall($sql);
		include $this->template('lottery/task/new/preview');
	}
	public function delete_new() 
	{
		global $_W;
		global $_GPC;
		$ids = $_GPC['ids'];
		$this->model->deleteTask($ids);
		show_json(1);
	}
	public function selectlist() 
	{
		global $_GPC;
		$type = $_GPC['type'];
		$page = max(1, (int) $_GPC['page']);
		$keyword = trim($_GPC['keyword']);
		if ($type) 
		{
			$this->model->getGoods_new($keyword, $page);
		}
		else 
		{
			$this->model->getCoupon($keyword, $page);
		}
	}
	public function setdisplayorder() 
	{
		global $_W;
		global $_GPC;
		$id = (int) $_GPC['id'];
		$value = (int) $_GPC['value'];
		pdo_update('wx_shop_task_list', array('displayorder' => $value), array('id' => $id, 'uniacid' => $_W['uniacid']));
		show_json(1);
	}
	private function whatType($type) 
	{
		if (empty($type)) 
		{
			return '??????';
		}
		$tasktype = $this->model->getTaskType($type);
		$typeText = $tasktype['type_name'];
		$color = $tasktype['theme'];
		$return = '<span class=\'label label-' . $color . '\'>' . $typeText . '</span>';
		return $return;
	}
	private function whatStatus($task) 
	{
		$color = ' label-primary';
		$statusText = '?????????';
		$time = time();
		if (strtotime($task['endtime']) < $time) 
		{
			$statusText = '?????????';
			$color = ' label-default';
		}
		else if ($time < strtotime($task['starttime'])) 
		{
			$statusText = '?????????';
			$color = ' label-warning';
		}
		$return = '<span class=\'label' . $color . '\'>' . $statusText . '</span>';
		return $return;
	}
	private function whatProgress($record) 
	{
		$color = ' label-primary';
		if ($record['task_demand'] <= $record['task_process']) 
		{
			$statusText = '?????????';
		}
		else 
		{
			$statusText = '?????? ' . $record['task_progress'] . '/' . $record['task_demand'];
		}
		$return = '<span class=\'label' . $color . '\'>' . $statusText . '</span>';
		return $return;
	}
	private function whatRewardType($reward) 
	{
		switch ($reward) 
		{
			case 'goods': $color = ' label-success';
			$statusText = '????????????';
			break;
			case 'coupon': $color = ' label-info';
			$statusText = '?????????';
			break;
			case 'balance': $color = ' label-primary';
			$statusText = '??????';
			break;
			case 'credit': $color = ' label-warning';
			$statusText = '??????';
			break;
			case 'redpacket': $color = ' label-danger';
			$statusText = '????????????';
			break;
		}
		$return = '<span class=\'label' . $color . '\'>' . $statusText . '</span>';
		return $return;
	}
	private function whatRewardStatus($reward) 
	{
		if ($reward['sent'] == 1) 
		{
			$color = ' label-primary';
			$statusText = '?????????';
		}
		else if (($reward['get'] == 1) && ($reward['sent'] != 1)) 
		{
			$color = ' label-warning';
			$statusText = '?????????';
		}
		else if ($reward['get'] == 0) 
		{
			$color = ' label-defalt';
			$statusText = '?????????';
		}
		$return = '<a class=\'label' . $color . '\'>' . $statusText . '</a>';
		return $return;
	}
	public function version() 
	{
		global $_W;
		$new = intval($this->model->isnew());
		$new = 1;
		pdo_update('wx_shop_task_set', array('isnew' => $new), array('uniacid' => $_W['uniacid']));
		$type = array('INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'1\', \'poster\', \'????????????\', \'??????????????????????????????????????????????????????????????????????????????????????????\', \'?????????????????????\', \'1\', \'?????????\', \'0\', \'primary\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'2\', \'info_phone\', \'????????????\', \'????????????????????????????????????????????????????????????????????????\', \'????????????\', \'0\', \'\', \'0\', \'warning\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'3\', \'order_first\', \'????????????\', \'?????????????????????????????????????????????????????????????????????\', \'??????????????????????????????\', \'0\', \'\', \'0\', \'warning\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'4\', \'recharge_full\', \'??????????????????\', \'?????????????????????????????????????????????????????????????????????\', \'???????????????\', \'1\', \'???\', \'0\', \'success\', \'1\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'5\', \'order_full\', \'????????????\', \'???????????????????????????????????????????????????????????????????????????\', \'???????????????\', \'1\', \'???\', \'0\', \'success\', \'1\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'6\', \'order_all\', \'????????????\', \'?????????????????????????????????????????????????????????????????????????????????\', \'????????????????????????\', \'1\', \'???\', \'0\', \'success\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'7\', \'pyramid_money\', \'????????????\', \'?????????????????????????????????????????????????????????????????????????????????\', \'??????????????????????????????\', \'1\', \'???\', \'0\', \'primary\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'8\', \'pyramid_num\', \'????????????\', \'?????????????????????????????????????????????????????????????????????????????????\', \'??????????????????????????????\', \'1\', \'???\', \'0\', \'primary\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'9\', \'comment\', \'????????????\', \'?????????????????????????????????????????????????????????????????????\', \'???????????????\', \'0\', \'\', \'0\', \'warning\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'10\', \'post\', \'????????????\', \'?????????????????????????????????????????????????????????????????????\', \'??????????????????\', \'1\', \'?????????\', \'0\', \'warning\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'11\', \'goods\', \'??????????????????\', \'???????????????????????????????????????????????????????????????\', \'??????????????????\', \'0\', \'\', \'1\', \'info\', \'0\');', 'INSERT INTO ' . tablename('wx_shop_task_type') . ' (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES (\'12\', \'recharge_count\', \'??????????????????\', \'?????????????????????????????????????????????????????????????????????\', \'???????????????\', \'1\', \'???\', \'0\', \'success\', \'0\');');
		foreach ($type as $t ) 
		{
			pdo_query($t);
		}
		pdo_delete('wx_shop_task_poster', array('uniacid' => $_W['uniacid']));
		pdo_delete('wx_shop_task_join', array('uniacid' => $_W['uniacid']));
		pdo_delete('wx_shop_task_joiner', array('uniacid' => $_W['uniacid']));
		pdo_delete('wx_shop_task_extension_join', array('uniacid' => $_W['uniacid']));
		header('location:' . webUrl('task'));
		exit();
	}
}
?>