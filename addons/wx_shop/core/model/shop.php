<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Shop_WxShopModel
{
	public function getCategory($refresh = false) 
	{
		global $_W;
		$allcategory = m('cache')->getArray('allcategory');
		if (empty($allcategory) || $refresh) 
		{
			$parents = array();
			$children = array();
			$category = pdo_fetchall('SELECT * FROM ' . tablename('wx_shop_category') . ' WHERE uniacid =:uniacid AND enabled=1 ORDER BY parentid ASC, displayorder DESC', array(':uniacid' => $_W['uniacid']));
			foreach ($category as $index => $row ) 
			{
				if (!(empty($row['parentid']))) 
				{
					if ($row[$row['parentid']]['parentid'] == 0) 
					{
						$row[$row['parentid']]['level'] = 2;
					}
					else 
					{
						$row[$row['parentid']]['level'] = 3;
					}
					$children[$row['parentid']][] = $row;
					unset($category[$index]);
				}
				else 
				{
					$row['level'] = 1;
					$parents[] = $row;
				}
			}
			$allcategory = array('parent' => $parents, 'children' => $children);
			m('cache')->set('allcategory', $allcategory);
		}
		return $allcategory;
	}
	public function getFullCategory($fullname = false, $enabled = false) 
	{
		global $_W;
		$allcategorynames = m('cache')->getArray('allcategorynames');
		$shopset = m('common')->getSysset('shop');
		$allcategory = array();
		$sql = 'SELECT * FROM ' . tablename('wx_shop_category') . ' WHERE uniacid=:uniacid ';
		if ($enabled) 
		{
			$sql .= ' AND enabled=1';
		}
		$sql .= ' ORDER BY parentid ASC, displayorder DESC';
		$category = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']));
		$category = set_medias($category, array('thumb', 'advimg'));
		if (empty($category)) 
		{
			return array();
		}
		foreach ($category as &$c ) 
		{
			if (empty($c['parentid'])) 
			{
				$allcategory[] = $c;
				foreach ($category as &$c1 ) 
				{
					if ($c1['parentid'] != $c['id']) 
					{
						continue;
					}
					if ($fullname) 
					{
						$c1['name'] = $c['name'] . '-' . $c1['name'];
					}
					$allcategory[] = $c1;
					foreach ($category as &$c2 ) 
					{
						if ($c2['parentid'] != $c1['id']) 
						{
							continue;
						}
						if ($fullname) 
						{
							$c2['name'] = $c1['name'] . '-' . $c2['name'];
						}
						$allcategory[] = $c2;
						foreach ($category as &$c3 ) 
						{
							if ($c3['parentid'] != $c2['id']) 
							{
								continue;
							}
							if ($fullname) 
							{
								$c3['name'] = $c2['name'] . '-' . $c3['name'];
							}
							$allcategory[] = $c3;
						}
						unset($c3);
					}
					unset($c2);
				}
				unset($c1);
			}
			unset($c);
		}
		return $allcategory;
	}
	public function checkClose() 
	{
		if (strexists($_SERVER['REQUEST_URI'], '/web/')) 
		{
			return;
		}
		global $_S;
		global $_W;
		if ($_W['plugin'] == 'mmanage') 
		{
			return;
		}
		$close = $_S['close'];
		if (!(empty($close['flag']))) 
		{
			if (!(empty($close['url']))) 
			{
				header('location: ' . $close['url']);
				exit();
			}
			exit('<!DOCTYPE html>' . "\r\n\t\t\t\t\t" . '<html>' . "\r\n\t\t\t\t\t\t" . '<head>' . "\r\n\t\t\t\t\t\t\t" . '<meta name=\'viewport\' content=\'width=device-width, initial-scale=1, user-scalable=0\'>' . "\r\n\t\t\t\t\t\t\t" . '<title>???????????????????????????</title><meta charset=\'utf-8\'><meta name=\'viewport\' content=\'width=device-width, initial-scale=1, user-scalable=0\'><link rel=\'stylesheet\' type=\'text/css\' href=\'https://res.wx.qq.com/connect/zh_CN/htmledition/style/wap_err1a9853.css\'>' . "\r\n\t\t\t\t\t\t" . '</head>' . "\r\n\t\t\t\t\t\t" . '<body>' . "\r\n\t\t\t\t\t\t" . '<style type=\'text/css\'>' . "\r\n\t\t\t\t\t\t" . 'body { background:#fbfbf2; color:#333;}' . "\r\n\t\t\t\t\t\t" . 'img { display:block; width:100%;}' . "\r\n\t\t\t\t\t\t" . '.header {' . "\r\n\t\t\t\t\t\t" . 'width:100%; padding:10px 0;text-align:center;font-weight:bold;}' . "\r\n\t\t\t\t\t\t" . '</style>' . "\r\n\t\t\t\t\t\t" . '<div class=\'page_msg\'>' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t" . '<div class=\'inner\'><span class=\'msg_icon_wrp\'><i class=\'icon80_smile\'></i></span>' . $close['detail'] . '</div></div>' . "\r\n\t\t\t\t\t\t" . '</body>' . "\r\n\t\t\t\t\t" . '</html>');
		}
	}
	public function getAllCategory($refresh = false) 
	{
		global $_W;
		$allcategory = m('cache')->getArray('allcategoryarr');
		if (empty($allcategory) || $refresh) 
		{
			$allcategory = pdo_fetchall('SELECT id,parentid,uniacid,name,thumb FROM ' . tablename('wx_shop_category') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\'', array(), 'id');
			m('cache')->set('allcategoryarr', $allcategory);
		}
		return $allcategory;
	}
}
?>