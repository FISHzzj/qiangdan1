<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}

class Sd_Center_WxShopPage extends MobilePage
{   
    protected $member;

    public function __construct() 
	{
		global $_W;
		global $_GPC;
		parent::__construct();
        $openid = base64_decode($_GPC['openid']);
        $this->member = m('member')->getMember($openid);
        if(!$this->member){
            show_json(0, '请登录');
		}

		if($this->member['isblack'] == 1){
			$key = '__wx_shop_member_session_' . $_W['uniacid'];
            isetcookie($key, false, -100);
			show_json(999, '账号已被封号');
		}
    }

    /**
     * [main 我的（个人中心）]
     * @return [array] [description]
     */
	public function main()
	{ 
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
	   
        $levelId = $this->member['level'];
        $level = pdo_fetch(' select level, levelname from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level = :level ', array(':uniacid' => $uniacid, ':level' => $levelId));
        if(empty($level)){
            $levelset = m('common')->getSysset('shop');
            $level = array(
                'level'     => 0,
                'levelname' => $levelset['levelname'],
            );
        }
        
        $info = array(
            'avatar'    => $this->member['avatar'],
            'mobile'    => $this->member['mobile'],
            'level'     => $level,
            'gold'      => $this->member['credit2'],
            'nickname'  => $this->member['nickname'],
            'invitation'=> $this->member['rcode'],
        );
        show_json(1, $info);
    }
    
    /**
     * [welfare 会员福利]
     * @return [array] [description]
     */
    public function welfare()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $levelset = m('common')->getSysset('shop');//默认等级设置

        $levelId = $this->member['level'];//当前账户等级
        $level = pdo_fetch(' select level, levelname, c_proportion, gs_probability, details from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid and level = :level ', array(':uniacid' => $uniacid, ':level' => $levelId));//账户等级详情

        if(empty($level)){
            $level = array(
                'level'         => 0,
                'levelname'     => $levelset['levelname'],
                'hallname' 		=> (empty($levelset['hallname']) 		? '普通大厅' : $levelset['hallname']),
                'c_proportion'  => (empty($levelset['c_proportion']) 	? 0 		 : $levelset['c_proportion']),//等级大厅的佣金比例，该大厅接取任务，按照此佣金比例计算佣金
                'gs_probability'=> (empty($levelset['gs_probability']) 	? 0 		 : $levelset['gs_probability']),//抢单几率，只供显示，无功能
                'details'       => (empty($levelset['details']) 		? '' 		 : $levelset['details']),//福利说明
            );
        }

        $passageway = array();//专属通道
        $passageway[0]['name']      = $levelset['levelname'];//默认等级专属通道
        $passageway[0]['hallname']  = $levelset['hallname'];//默认等级专属通道
        $passageway[0]['picture']   = tomedia($levelset['picture']);//默认等级专属通道图片
        $passageway[0]['status']    = true;//默认等级专属通道，默认开启

        $unlock = true;//解锁下一等级状态
        //所有等级
        $levelAll = pdo_fetchall(' select level, levelname, invitations_num, recharge, picture from ' . tablename('wx_shop_sd_member_level') . ' where uniacid = :uniacid order by level asc ', array(':uniacid' => $uniacid));
        foreach ($levelAll as $key => $value) {
            //专属通道
                $passageway[intval($key+1)]['name']      = $value['levelname'];
                $passageway[intval($key+1)]['hallname']  = $value['hallname'];
                $passageway[intval($key+1)]['picture']   = tomedia($value['picture']);
                $passageway[intval($key+1)]['status']    = false;
                if($level['level'] >= $value['level']){
                    $passageway[intval($key+1)]['status'] = true;
                }

            //升级下一级条件
                if($level['level'] < $value['level']){
                    if($unlock){
                        $unlock = false;//锁定下一等级
                        $unlock_info = "距离下一级还需要邀请".$value['invitations_num'].'人，单个账户累计充值需要达到'.$value['recharge'];
                    }
                }
        }
        
        if($unlock){
            $unlock_info = '您已经是最高等级';
        }

        $level['passageway']  = $passageway;
        $level['unlock_info'] = $unlock_info;
        show_json(1, $level);
    }

    /**
     * [wallet 我的钱包]
     * @return [type] [description]
     */
    public function wallet()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $info = array(
            'gold' => $this->member['credit2'],
        );
        show_json(1, $info);
    }

    /**
     * [address 地址管理(显示和保存)]
     * @return [type] [description]
     */
    public function address()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $op = !empty($_GPC['op']) ? trim($_GPC['op']) : 'display';

        $address = pdo_fetch('select realname, mobile, province, city, area, address from ' . tablename('wx_shop_member_address') . ' where openid = :openid and uniacid = :uniacid limit 1 ', array(':uniacid' => $uniacid, ':openid' => $this->member['openid']));
        if($op == 'update'){
            $data = array(
            	'openid' 	=> $this->member['openid'],
                'realname'  => trim($_GPC['realname']),
                'mobile'    => trim($_GPC['mobile']),
                'province'  => trim($_GPC['province']),
                'city'      => trim($_GPC['city']),
                'area'      => trim($_GPC['area']),
                'address'   => trim($_GPC['address'])
            );

            if(empty($address)){
                $data['uniacid'] = $uniacid;
                pdo_insert('wx_shop_member_address', $data);
            }else{
                pdo_update('wx_shop_member_address', $data, array('openid' => $this->member['openid'], 'uniacid' => $uniacid));
            }

            show_json(1, '保存成功');
        }
        show_json(1,array('address'=>$address));
    }

    /**
     * [invitation 邀请好友]
     * @return [type] [description]
     */
    public function invitation()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        if ($_W['ispost']) {
            $path = IA_ROOT . '/addons/wx_shop/data/qrcode/' . $_W['uniacid'];
            if (!(is_dir($path))) {
                load()->func('file');
                mkdirs($path);
            }
            $url = mobileUrl('account/register', array('mid' => $this->member['id']), true);

            $file = 'myshop_invitation_' . $uniacid . '_' . $this->member['id'] . '.png';
            $qr_file = $path . '/' . $file;
            if (!(is_file($qr_file))) {
                require IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
                QRcode::png($url, $qr_file, QR_ECLEVEL_H, 4);
            }
            $img = $_W['siteroot'] . 'addons/wx_shop/data/qrcode/' . $uniacid . '/' . $file;

            $url =  mobileUrl('account/register', array('mid' => $this->member['id'], 'rcode' => $this->member['rcode']), true);

            show_json(1, array('img' => $img . '?t=' . TIMESTAMP, 'url'=>$url));
        }
    }

    /**
     * [reportform 统计报表]
     * @return [type] [description]
     */
    public function reportform()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $ownSellout = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type = 3 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        $ownPurchase = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type in(2,21) ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        $ownTask = pdo_fetch(' select sum(gold) as sum, count(id) as count from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type = 4 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        $ownCommission = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type = 5 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        $ownFrozen = pdo_fetchcolumn(' select sum(price) from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and uid = :uid and freeze = 1 ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));

        $ownInfo = array(//自身报表信息
            'gold'      => empty($this->member['credit2']) ? 0 : $this->member['credit2'],//余额
            'sellout'   => empty($ownSellout)       ? 0 : $ownSellout,//卖出（总提现）
            'purchase'  => empty($ownPurchase)      ? 0 : $ownPurchase,//买入（总充值）
            'tasknum'   => empty($ownTask['count']) ? 0 : $ownTask['count'],//任务总个数
            'frozen'    => empty($ownFrozen)        ? 0 : $ownFrozen,//冻结资金
            'taskprice' => empty($ownTask['sum'])   ? 0 : $ownTask['sum'],//任务总佣金
        );

        $downInfo = array(//推荐报表（只统计三代）
            'num'              => 0,
            'grab_sheet_total' => 0,//下级抢单总金额
            'purchase'         => 0,//下级买入（总充值）
            'sellout'          => 0,//下级卖出（总提现）
            'taskprice'        => 0,//下级总任务佣金
            'commission'       => empty($ownCommission) ? 0 : $ownCommission,//获得的总代理佣金
        );

        $sd_model = m('sd_model');
        $downList = array();//下级三代所有账户信息列表
        $sd_model->getDown($this->member['id'], $downList, 0, 3);
        
        foreach ($downList as $key => &$value) {
            $downInfo['num']++;
        	$value['avatar'] = tomedia($value['avatar']);
            $sellout = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type = 3 ', array(':uniacid' => $uniacid, ':uid' => $value['id']));
            $purchase = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type in(2,21) ', array(':uniacid' => $uniacid, ':uid' => $value['id']));
            $taskprice = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type = 4 ', array(':uniacid' => $uniacid, ':uid' => $value['id']));
            $grab_sheet = pdo_fetch(' select sum(gold) as sum, count(id) as count from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type = 1 ', array(':uniacid' => $uniacid, ':uid' => $value['id']));

            $commission = pdo_fetchcolumn(' select sum(gold) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and type = 5 ', array(':uniacid' => $uniacid, ':uid' => $value['id']));

            $value['sellout']    = !empty($sellout)       ? $sellout        : 0;//卖出（总提现）
            $value['purchase']   = !empty($purchase)      ? $purchase       : 0;//买入（总充值）
            $value['taskprice']  = !empty($taskprice)     ? $taskprice      : 0;//任务总佣金
            $value['commission'] = !empty($commission)    ? $commission     : 0;//总代理佣金
            $value['tasknum']    = !empty($grab_sheet['count'])    ? $grab_sheet['count']     : 0;//任务个数

            $downInfo['grab_sheet_total']   += floatval($grab_sheet['sum']);
            $downInfo['purchase']           += floatval($purchase);
            $downInfo['sellout']            += floatval($sellout);
            $downInfo['taskprice']          += floatval($taskprice);

            $downcount = array();
            $sd_model->getDown($value['id'], $downcount, 0, 3);
            if(empty($downcount)){
            	$downcount = 0;
            }else{
            	$downcount = count($downcount);
            }
            $value['downcount'] = $downcount;
        }
        unset($value);
        
        show_json(1, array(
            'owninfo'   => $ownInfo,
            'downinfo'  => $downInfo,
            'downlist'  => $downList
        ));
    }

    /**
     * [withdrawal 提现]
     * @return [type] [description]
     */
    public function withdrawal()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $op = empty($_GPC['op']) ? 'display' : trim($_GPC['op']);

        $grabSheetNum = intval($_W['shopset']['grabsingle']['limit']);//每日抢单最大数

        $set = pdo_fetch(' select starttime, endtime, service, num, min, max from ' . tablename('wx_shop_sd_withdrawal_set') . ' where uniacid = :uniacid ', array(':uniacid' => $uniacid));

        $starttime = strtotime(date('Y-m-d ' . $set['starttime'], time()));//开始时间
        $endtime = strtotime(date('Y-m-d ' . $set['endtime'], time()));//开始时间

        if(time() < $starttime || time() > $endtime){
            show_json(0, '提现时间在每日'.$set['starttime'].'-'.$set['endtime']);
        }

        //当天时间戳
        $startTime = strtotime(date("Y-m-d",time()));
        $endTime = $startTime + 60 * 60 * 24 - 1;

        $num = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_order') . ' where uniacid = :uniacid and uid = :uid and createtime >= :starttime and createtime <= :endtime ', array(':uniacid' => $uniacid, ':uid' => $this->member['id'], ':starttime' => $startTime, ':endtime' => $endTime));
        if(empty($num)){
            $num = 0;
        }

        if($num < $grabSheetNum){
            $difference = intval($grabSheetNum - $num);
            show_json(0, '你今天的订单数量还剩'.$difference.'暂不能提现');
        }

        if(intval($set['num']) > 0){
            $withdrawalNum = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_gold_log') . ' where uniacid = :uniacid and uid = :uid and createtime >= :starttime and createtime <= :endtime and type in(3,32) ', array(':uniacid' => $uniacid, ':uid' => $this->member['id'], ':starttime' => $startTime, ':endtime' => $endTime));
            if($withdrawalNum >= intval($set['num'])){
                show_json(0, '一天只能提现'.intval($set['num']).'次!');
            }
        }

        $bank = pdo_fetch(' select id, banknum, bankname, realname from ' . tablename('wx_shop_sd_bankcard_list') . ' where uniacid = :uniacid and uid = :uid ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));
        $set['bankname'] = empty($bank['bankname']) ? '' : $bank['bankname'];
        $set['banknum']  = empty($bank['banknum']) ? '' : $bank['banknum'];
        $set['realname'] = empty($bank['realname']) ? '' : $bank['realname'];

        if($_W['ispost'] && $op == 'sub'){
            $money = floatval($_GPC['money']);
            if($money <= 0){
                show_json(0, '请输入提现金额');
            }

            if(intval($set['min']) > 0 && $money < $set['min']){
                show_json(0, '最小提现金额为'.$set['min'],'元');
            }

            if(intval($set['max']) > 0 && $money > $set['max']){
                show_json(0, '最大提现金额为'.$set['min'],'元');
            }

            $banknum = empty($_GPC['banknum']) ? show_json(0, '请输入银行卡号') : trim($_GPC['banknum']);
            $bankname = empty($_GPC['bankname']) ? show_json(0, '请输入所属银行') : trim($_GPC['bankname']);
            $realname = empty($_GPC['realname']) ? show_json(0, '请输入真实姓名') : trim($_GPC['realname']);

            if(empty($bank)){
                pdo_insert('wx_shop_sd_bankcard_list',array(
                    'uniacid'   => $uniacid,
                    'uid'       => $this->member['id'],
                    'banknum'   => $banknum,
                    'bankname'  => $bankname,
                    'realname'  => $realname,
                    'createtime'=> time(),
                ));
                $bankid = pdo_insertid();
            }else{
                pdo_update('wx_shop_sd_bankcard_list', array(
                    'banknum'   => $banknum,
                    'bankname'  => $bankname,
                    'realname'  => $realname,
                    'createtime'=> time(),
                ), array('uid' => $this->member['id']));
                $bankid = $bank['id'];
            }

            $pwd = empty($_GPC['paypwd']) ? show_json(0, '请输入支付密码') : trim($_GPC['paypwd']);
            if(md5($pwd.$this->member['salt']) != $this->member['pwd2']){
            	show_json(0, '支付密码错误');
            }

            $fp = fopen("../data/business/".$this->member['id'].".txt", "w+");
            if(flock($fp,LOCK_EX | LOCK_NB)){
                $sd_model = m('sd_model');
                $result = $sd_model->setGold($this->member['id'], $this->member['openid'], 'credit2', -$money, 1, $bankid, 32);//提现
                if($result){
                    m('sd_model')->setonline('123456', 'tixian');
                    flock($fp,LOCK_UN);
                    fclose($fp);
                    show_json(1, '提现已提交');
                }else{
                    flock($fp,LOCK_UN);
                    fclose($fp);
                    show_json(0, '扣款失败，请稍后再试');
                }
            }
        }

        show_json(1, $set);
    }

    /**
     * [recharge 充值]
     * @return [type] [description]
     */
    public function recharge()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $op = empty($_GPC['op']) ? 'display' : trim($_GPC['op']);

        $set = $_W['shopset']['grabsingle'];
        //收款信息（银行卡信息）
        $receivablesInfo = array(
            'realname'      => $set['realname'],
            'bankname'      => $set['bankname'],
            'branch'        => $set['branch'],
            'bankcard'      => $set['bankcard'],
        );

        if($_W['ispost'] && $op == 'sub'){
            $money = floatval($_GPC['money']);
            $img   = trim($_GPC['images']);

            if($money <= 0){
                show_json(0, '请输入充值金额');
            }

            if(empty($img)){
                show_json(0, '请上传支付凭证');
            }
            $fp = fopen("../data/business/".$this->member['id'].".txt", "w+");
            if(flock($fp,LOCK_EX | LOCK_NB)){
                $data = array(
                    'uniacid'   => $uniacid,
                    'uid'       => $this->member['id'],
                    'money'     => $money,
                    'images'    => tomedia($img),
                    'createtime'=> time(),
                );
                pdo_insert('wx_shop_sd_recharge_list', $data);
                m('sd_model')->setonline('123456', 'tixian');

                flock($fp,LOCK_UN);
                fclose($fp);
                show_json(1, '提交成功');
            }  
        }

        show_json(1, $receivablesInfo);
    }

    /**
     * [bankcard 我的钱包-银行卡]
     * @return [type] [description]
     */
    public function bankcard()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $op = empty($_GPC['op']) ? 'display' : trim($_GPC['op']);

        $info = pdo_fetch(' select banknum, bankname, realname from ' . tablename('wx_shop_sd_bankcard_list') . ' where uniacid = :uniacid and uid = :uid ', array(':uniacid' => $uniacid, ':uid' => $this->member['id']));

        if($op == 'sub'){
            $banknum = empty($_GPC['banknum']) ? show_json(0, '请输入银行卡号') : trim($_GPC['banknum']);
            $bankname = empty($_GPC['bankname']) ? show_json(0, '请输入所属银行') : trim($_GPC['bankname']);
            $realname = empty($_GPC['realname']) ? show_json(0, '请输入真实姓名') : trim($_GPC['realname']);

            if(empty($info)){
                pdo_insert('wx_shop_sd_bankcard_list',array(
                    'uniacid'   => $uniacid,
                    'uid'       => $this->member['id'],
                    'banknum'   => $banknum,
                    'bankname'  => $bankname,
                    'realname'  => $realname,
                    'createtime'=> time(),
                ));
            }else{
                pdo_update('wx_shop_sd_bankcard_list', array(
                    'banknum'   => $banknum,
                    'bankname'  => $bankname,
                    'realname'  => $realname,
                    'createtime'=> time(),
                ), array('uid' => $this->member['id']));
            }
            show_json(1, '修改成功');
        }

        show_json(1, array('info' => $info));
    }

    /**
     * [updateNickname 修改昵称]
     * @return [type] [description]
     */
    public function updateNickname()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $nickname = trim($_GPC['nickname']);
        if($nickname != $this->member['nickname']){
            pdo_update('wx_shop_member', array('nickname' => $nickname), array('id' => $this->member['id']));
        }
        show_json(1, '修改成功');
    }

    /**
     * [updatePwd 修改密码]
     * @return [type] [description]
     */
    public function updatePwd()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $oldPwd = empty($_GPC['oldpwd']) ? show_json(0, '请输入旧密码') : trim($_GPC['oldpwd']);
        $newPwd = empty($_GPC['newpwd']) ? show_json(0, '请输入新密码') : trim($_GPC['newpwd']);
        $newPwd2 = empty($_GPC['newpwd2']) ? show_json(0, '请输入确认密码') : trim($_GPC['newpwd2']);

        if($this->member['updatePwd'] >= 5){
            pdo_update('wx_shop_member', array('isblack' => 1), array('id' => $this->member['id']));
            show_json(0, '密码错误5次，账户已被冻结');
        }

        if($oldPwd == $newPwd){
            show_json(0, '旧密码不能与新密码一致');
        }

        if($newPwd != $newPwd2){
            show_json(0, '再次输入新密码错误');
        }

        $oldPwdEncryption = md5($oldPwd.$this->member['salt']);
        if($oldPwdEncryption !== $this->member['pwd']){
            pdo_update('wx_shop_member', array('updatePwd' => $this->member['updatePwd']+1), array('id' => $this->member['id']));
            show_json(0, '旧密码错误');
        }


        $newPwdEncryption = md5($newPwd.$this->member['salt']);
        if($oldPwdEncryption === $newPwdEncryption){
            show_json(0, '旧密码不能与新密码一致');
        }

        pdo_update('wx_shop_member', array('pwd' => $newPwdEncryption, 'updatePwd' => 0), array('id' => $this->member['id']));
        show_json(1, '修改成功');
    }

    /**
     * [updatePayPwd 修改支付密码（支付安全）]
     * @return [type] [description]
     */
    public function updatePayPwd()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $oldPwd = empty($_GPC['oldpwd']) ? show_json(0, '请输入旧密码') : trim($_GPC['oldpwd']);
        $newPwd = empty($_GPC['newpwd']) ? show_json(0, '请输入新密码') : trim($_GPC['newpwd']);
        $newPwd2 = empty($_GPC['newpwd2']) ? show_json(0, '请输入确认密码') : trim($_GPC['newpwd2']);

        if($oldPwd == $newPwd){
            show_json(0, '旧密码不能与新密码一致');
        }

        if($newPwd != $newPwd2){
            show_json(0, '再次输入新密码错误');
        }

        $oldPwdEncryption = md5($oldPwd.$this->member['salt']);
        if($oldPwdEncryption !== $this->member['pwd2']){
            show_json(0, '旧密码错误');
        }


        $newPwdEncryption = md5($newPwd.$this->member['salt']);
        if($oldPwdEncryption === $newPwdEncryption){
            show_json(0, '旧密码不能与新密码一致');
        }

        pdo_update('wx_shop_member', array('pwd2' => $newPwdEncryption), array('id' => $this->member['id']));
        show_json(1, '修改成功');
    }

    /**
     * [aboutUs 关于我们]
     * @return [type] [description]
     */
    public function aboutUs()
    {
    	global $_W;
    	$aboutUs = $_W['shopset']['sd_about_us'];
    	$aboutUs['video'] = tomedia($aboutUs['video']);
    	show_json(1, $aboutUs);
    }
}