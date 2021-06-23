<?php
header('Access-Control-Allow-Origin:*'); 
if (!(defined('IN_IA'))) 
{
    exit('Access Denied');
}
class Sd_Log_WxShopPage extends MobilePage
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
     * [main 匹配记录]
     * @return [type] [description]
     */
    public function main()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $typeArray = array('0','1','2','3','4');
        $type = intval($_GPC['type']);
        if(!in_array($type, $typeArray)){
            show_json(0, '参数错误，请刷新后重试');
        }

        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;

        $condition = ' and o.uniacid = :uniacid and o.uid = :uid ';
        $params = array(
            ':uniacid' => $uniacid,
            ':uid'     => $this->member['id'],
        );
        if($type == 1 || $type == 3){
            if($type == 1){
                $status = 1;
            }else{
                $status = 2;
            }
            $condition .= ' and o.status = :status and freeze = 0 ';
        }else if($type == 2 || $type == 4){
            if($type == 2){
                $status = 1;
            }else{
                $status = 2;
            }
            $condition .= ' and o.freeze = :status ';
        }

        if($type != 0){
            $params[':status'] = $status;
        }

        $sql = ' select o.id, o.createtime, o.price, o.commission, g.title, g.thumb, o.status, o.freeze from ' . tablename('wx_shop_sd_order') . ' o ' . ' left join ' . tablename('wx_shop_goods') . ' g on g.id = o.goodsid ' . ' where 1 ' . $condition . ' order by o.id desc limit ' . (($pindex - 1) * $psize) . ',' . $psize;
        $list = pdo_fetchall($sql, $params);
        foreach ($list as $key => &$value) {
            $value['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
            $value['goodsnum'] = 1;
            $value['thumb'] = tomedia($value['thumb']);
            $value['thisstatus'] = 0;//已完成
            if($value['status'] == 1){
                $value['thisstatus'] = 1;//待提交
            }

            if($value['freeze'] != 0){
                if($value['freeze'] == 1){
                    $value['thisstatus'] = 2;//冻结
                }else{
                    $value['thisstatus'] = 3;//已失效
                }  
            }
        }
        unset($value);

        $total = pdo_fetchcolumn(' select count(o.id) from ' . tablename('wx_shop_sd_order') . ' o ' . ' left join ' . tablename('wx_shop_goods') . ' g on g.id = o.goodsid ' . ' where 1 ' . $condition, $params);
        
        show_json(1, array(
            'gold'  => $this->member['credit2'],
            'list'  => $list,
            'total' => $total,
            'page'  => $pindex,
        ));
    }

    /**
     * [transactionLog 交易记录]
     * @return [type] [description]
     */
    public function transactionLog()
    {
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $sd_model = m('sd_model');
        $type = $sd_model->type;
        $type[0] = '全部';

        $types = intval($_GPC['type']);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;

        $condition = ' and uniacid = :uniacid and uid = :uid ';
        $params = array(
            ':uniacid' => $uniacid,
            ':uid'     => $this->member['id'],
        );

        if($types != 0){
            $condition .= ' and type = :type ';
            $params[':type'] = $types;
        }

        $sql = ' select gold, budget, createtime, title from ' . tablename('wx_shop_sd_gold_log') . ' where 1 ' . $condition . ' order by id desc limit ' . (($pindex - 1) * $psize) . ',' . $psize;
        $list = pdo_fetchall($sql, $params);
        foreach ($list as $key => &$value) {
            $value['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
        }
        unset($value);

        $total = pdo_fetchcolumn(' select count(id) from ' . tablename('wx_shop_sd_gold_log') . ' where 1 ' . $condition, $params);

        show_json(1,array(
            'type'  => $type,
            'list'  => $list,
            'total' => $total,
        ));
    }
}