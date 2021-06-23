<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Sd_Distribution_WxShopPage extends WebPage
{
    public function main(){
        global $_W;
        global $_GPC;
        $uniacid = intval($_W['uniacid']);

        $distribution = pdo_fetch(' select price1, price2, price3 from ' . tablename('wx_shop_sd_distribution_set') . ' where uniacid = :uniacid ', array(':uniacid' => $uniacid));

        if($_W['ispost']){
            $data = array(
                'price1'    => floatval($_GPC['price1']),
                'price2'    => floatval($_GPC['price2']),
                'price3'    => floatval($_GPC['price3']),
            );

            if(empty($distribution)){
                $data['uniacid'] = $uniacid;
                pdo_insert('wx_shop_sd_distribution_set', $data);
            }else{
                pdo_update('wx_shop_sd_distribution_set', $data, array('uniacid' => $uniacid));
            }
            show_json(1, '修改成功');
        }

        include $this->template();
    }
}