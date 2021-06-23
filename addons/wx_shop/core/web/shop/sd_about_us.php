<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Sd_About_Us_WxShopPage extends WebPage
{
    public function main(){
        global $_W;
        global $_GPC;

        if ($_W['ispost']) {
            $data = ((is_array($_GPC['data']) ? $_GPC['data'] : array()));
            $data['video'] = $_GPC['video'];
            m('common')->updateSysset(array('sd_about_us' => $data));
            show_json(1);
        }
        $data = m('common')->getSysset('sd_about_us');

        include $this->template();
    }
}