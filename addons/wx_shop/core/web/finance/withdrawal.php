<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Withdrawal_WxShopPage extends WebPage
{
    public function main(){
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);
        $set = pdo_fetch(' select * from ' . tablename('wx_shop_sd_withdrawal_set') . ' where uniacid = :uniacid ', array(':uniacid' => $uniacid));

        if($_W['ispost']){
            $data = array(
                'starttime'     => $_GPC['starttime'],
                'endtime'       => $_GPC['endtime'],
                'service'       => floatval($_GPC['service']),
                'num'           => intval($_GPC['num']),
                'min'           => floatval($_GPC['min']),
                'max'           => floatval($_GPC['max']),
            );

            if(empty($set)){
                $data['uniacid'] = $uniacid;
                $aa = pdo_insert('wx_shop_sd_withdrawal_set', $data);
            }else{
                pdo_update('wx_shop_sd_withdrawal_set', $data, array('uniacid' => $uniacid));
            }

            show_json(1, '修改成功');
        }
        include $this->template();
    }
}