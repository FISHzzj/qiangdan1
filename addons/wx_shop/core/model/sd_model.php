<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Sd_Model_WxShopModel
{	
	/**
	 * [$type 资金收支记录类型]
	 * @var array
	 */
	public $type = array(
		'1' 	=> '匹配',
		'11' 	=> '匹配返还',

		'2' 	=> '买入',//（充值）
		'21' 	=> '后台买入',//（后台充值）
		'22' 	=> '后台扣除',

		'3'		=> '卖出',//（提现）
		'31' 	=> '提现退还',//（提现失败）
		'32' 	=> '提现冻结',//（提现中）

		'4'		=> '返佣',//(任务佣金)

		'5'		=> '分润',//(分销佣金/代理佣金)

		'6'		=> '匹配冻结',//未提交订单冻结
		'61'	=> '匹配解冻',//冻结订单解冻

		'7'	 	=> '定期理财转入',//
		'71'	=> '定期理财结息',//
		// '72'	=> '本金返还',//

		'8'		=> '彩金',//
	);

	/**
     * [更改用户资金]
     * @param  [type] $uid      [用户id]
     * @param  [type] $openid   [用户唯一标识]
     * @param  [type] $field    [钱包字段（credit2可用余额， credit_assets锁仓资产）]
     * @param  [type] $money    [金额]
     * @param  string $title    [备注]
     * @param  string $statusid [关联表id]
     * @param  [type] $type     [来源类型]
     * @return [type] $result   [返回结果]
     */
    public  function setGold($uid, $openid, $field, $money, $title = 0, $statusid="0", $type = 0)
    {
        global $_W;
        $uniacid = intval($_W['uniacid']);
        $fp = fopen("../data/userlock/".$uid.".txt", "w+");

        $result = false;
        if(flock($fp,LOCK_EX)){
            $nowmoney = pdo_fetchcolumn(" select " . $field . " from " . tablename("wx_shop_member") . " where id = :id ", array(":id" => $uid));
            $nowmoney = floatval($nowmoney + $money);
            if($nowmoney < 0){
              $result = false;
        	}else{
        		$budget = 0;
        		if($money < 0){
        			$budget = 1;
        		}
                pdo_update("wx_shop_member",array($field => $nowmoney),array("id" => $uid));
                if($title == 1){
                    $log = array(
                        'uniacid'       => $uniacid,
                        'uid'           => $uid,
                        'gold'			=> abs($money),
                        'budget'		=> $budget,
                        'type' 			=> $type,
                        'createtime' 	=> time(),
                        'title' 		=> $this->type[$type],
                        'rid' 			=> $statusid,
                    );
                  	pdo_insert("wx_shop_sd_gold_log",$log);//钱包记录
                }
                $result = true;

                if($type == 2 || $type == 21){
                	$this->upgrade($uid);
                }
            }
        }

        flock($fp,LOCK_UN);
        fclose($fp);
        return $result;
    }

	/**
	 * [substr_cut 格式化字符（隐藏部分改为***标记）]
	 * @param  [type]  $user_name [格式化的字符串]
	 * @param  integer $head      [开头保留几位]
	 * @param  integer $foot      [尾部保留几位]
	 */
	public function substr_cut($user_name,$head = 1,$foot = 1)
	{
	    $strlen     = mb_strlen($user_name, 'utf-8');
	    $firstStr     = mb_substr($user_name, 0, $head, 'utf-8');
	    $lastStr     = mb_substr($user_name, -$foot, $foot, 'utf-8');
	    return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - ($head+$foot)) . $lastStr;
	}

	/**
	 * [upgrade 升级]
	 * @param  [type] $uid [充值账户ID]
	 */
	public function upgrade($uid)
	{
		global $_W;
		$uniacid = intval($_W['uniacid']);

		$agentid = pdo_fetchcolumn(' select agentid from ' . tablename('wx_shop_member') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $uid));//是否存在上级
		if(empty($agentid) || $agentid <= 0){//不存在返回
			return;
		}

		$member = pdo_fetch(' select m.id, ml.level from ' . tablename('wx_shop_member') . ' m ' . ' left join ' . tablename('wx_shop_sd_member_level') . ' ml on ml.level = m.level ' . ' where m.uniacid = :uniacid and m.id = :id ', array(':uniacid' => $uniacid, ':id' => $agentid));//上级当前等级信息
		if(empty($member)){
			return;
		}
		$thisLevel = empty($member['level']) ? 0 : $member['level'];

		$upgradeLevel = pdo_fetch(' select level, invitations_num, recharge from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level > :level order by level asc limit 1 ', array(':uniacid' => $uniacid, ':level' => $thisLevel));//下一等级等级信息
		if(empty($upgradeLevel)){
			return;
		}

		//升级账户->邀请的账户和邀请账户累计充值
		$InvitationNum = pdo_fetchall(' select m.id, sum(gl.gold) as recharge from ' . tablename('wx_shop_member') . ' m ' . ' left join ' . tablename('wx_shop_sd_gold_log') . ' gl on gl.uid = m.id ' . ' where m.uniacid = :uniacid and m.agentid = :id and gl.type in(2,21) group by gl.uid order by sum(gl.gold) desc ', array(':uniacid' => $uniacid, ':id' => $member['id']));
		if(empty($InvitationNum)){
			return;
		}

		//筛选符合条件的邀请的账户
		$newInvitationNum = array();
		foreach ($InvitationNum as $key => $value) {
			if($value['recharge'] >= $upgradeLevel['recharge']){//个人累计充值满足升级条件
				$newInvitationNum[] = $value;
			}
			unset($InvitationNum[$key]);
		}

		if(empty($newInvitationNum)){
			return;
		}

		$upgrade = false;
		$newInvitationCount = count($newInvitationNum);//满足条件的下级账户数量
		if($newInvitationCount > 0 && $newInvitationCount >= $upgradeLevel['invitations_num']){
			$upgrade = true;//升级
		}

		if($upgrade){//修改升级账户信息
			pdo_update('wx_shop_member', array('level' => $upgradeLevel['level']), array('id' => $member['id']));
		}

		return;
	}

	/**
	 * [getDown 查找下级]
	 * @param  string  $agentid [账户id]
	 * @param  [type]  &$arr    [递归数组]
	 * @param  integer $i       [当前层数]
	 * @param  integer $ceng    [查找层数]
	 * @return [type]           [description]
	 */
	public function getDown($agentid = '', &$arr, $i=0, $ceng = 15)
	{
		global $_W;
		if($i == $ceng){
			return false;
		}

		$sql = "SELECT id, agentid, nickname, rcode, avatar from " . tablename('wx_shop_member') . " where agentid in(".$agentid.")";
		$getmyl = pdo_fetchall($sql);

		$i++;
		foreach ($getmyl as $k => $v) {
			$v['i'] = $i;
			if($v['id']){
				$cc .= $v['id'] . ',';
				$arr[] = $v;
			}
		}

		$cc = substr($cc, 0, -1);

		if($cc){
			$this->getDown($cc, $arr, $i);
		}
	}

	/**
	 * [getDown 查找上级]
	 * @param  string  $mid     [账户id]
	 * @param  [type]  &$arr    [递归数组]
	 * @param  integer $i       [当前层数]
	 * @param  integer $ceng    [查找层数]
	 * @return [type]           [description]
	 */
	public function getUp($mid = '', &$arr, $i=0, $ceng = 15)
	{
		global $_W;
		$uniacid = intval($_W['uniacid']);
		if($i == $ceng){
			return false;
		}

		$member = pdo_fetch(' select id, agentid, openid from ' . tablename('wx_shop_member') . ' where uniacid = :uniacid and id = :id ', array(':uniacid' => $uniacid, ':id' => $mid));
	
		$i++;
		if(empty($member)){
			return;
		}

		$member['i'] = $i;
		$arr[] = $member;

		if($member['agentid'] > 0){
			$this->getUp($member['agentid'], $arr, $i, $ceng);
		}
	}

	/**
	 * [createNO 生成唯一编码]
	 * @param  [type] $table  [数据表后缀]
	 * @param  [type] $field  [表字段]
	 * @param  [type] $prefix [唯一编码开头标识]
	 * @return [type]         [description]
	 */
	public function createNO($table, $field, $prefix)
    {
        $billno = date('YmdHis') . random(6, true);
        while (1) {
            $count = pdo_fetchcolumn('select count(*) from ' . tablename('wx_shop_' . $table) . ' where ' . $field . '=:billno limit 1', array(':billno' => $billno));
            if ($count <= 0) {
                break;
            }
            $billno = date('YmdHis') . random(6, true);
        }
        return $prefix . $billno;
    }

    /**
     * [distribution 分润（旧分销佣金）]
     * @param  [type] $orderid [订单id]
     * @return [type]          [description]
     */
    public function distribution($orderid)
    {	
    	global $_W;
    	$uniacid = intval($_W['uniacid']);

    	$set = pdo_fetch(' select price1, price2, price3 from ' . tablename('wx_shop_sd_distribution_set') . ' where uniacid = :uniacid ', array(':uniacid' => $uniacid));
    	if(empty($set)){
    		return;
    	}

    	$order = pdo_fetch(' select o.id, o.commission, m.agentid from ' . tablename('wx_shop_sd_order') . ' o ' . ' left join ' . tablename('wx_shop_member') . ' m on m.id = o.uid ' . ' where o.uniacid = :uniacid and o.id = :id and o.status = 2 ', array(':uniacid' => $uniacid, ':id' => $orderid));
    	if(empty($order)){
    		return;
    	}
    	
    	if($order['agentid'] <= 0){
    		return;
    	}

    	$superior = array();
    	$this->getUp($order['agentid'], $superior, 0, 3);
    	foreach ($superior as $key => $value) {
    		$money = floatval($set['price'.$value['i']] / 100 * $order['commission']);
    		if($money > 0){
    			$result = $this->setGold($value['id'], $value['openid'], 'credit2', $money, 1, $order['id'], 5);//抢单本金退还
    		}
    	}
    	return;
    }

    //推送
	public function setonline($to,$content)
	{ 
		global $_W;
	    $url=$_W['config']['socketiohttp']."/?type=publish&content=".$content."&to=".$to;
	    $ch = curl_init();
	  	//设置选项，包括URL
	  	curl_setopt($ch, CURLOPT_URL,$url);
	  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  	curl_setopt($ch, CURLOPT_HEADER, 0);

	  	//执行并获取HTML文档内容
	  	$output = curl_exec($ch);

	  	//释放curl句柄
	  	curl_close($ch);
		//返回处理josn
	}
}
?>