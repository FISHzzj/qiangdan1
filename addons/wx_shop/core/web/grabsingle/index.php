<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
class Index_WxShopPage extends WebPage
{
    public function main(){

        include $this->template();
    }

    public function set(){


            global $_W;
            global $_GPC;

            if ($_W['ispost']) 
            {
                
                $data = ((is_array($_GPC['data']) ? $_GPC['data'] : array()));

                $tx = ((is_array($_GPC['tx']) ? $_GPC['tx'] : array()));
       
                m('common')->updateSysset(array('grabsingle' => $data));
                m('common')->updateSysset(array('trade' => $tx));
                plog('goods.grabsingle.set', '修改系统设置-抢单设置');
                show_json(1);
            }

            $data = m('common')->getSysset('grabsingle');
            $tx = m('common')->getSysset('trade');
        
        include $this->template();
    }

    public function set2(){


            global $_W;
            global $_GPC;

            if ($_W['ispost']) 
            {
                
                $data = ((is_array($_GPC['data']) ? $_GPC['data'] : array()));
       
                m('common')->updateSysset(array('grabsingle' => $data));
                plog('goods.grabsingle.set', '修改系统设置-抢单设置');
                show_json(1);
            }

            $data = m('common')->getSysset('grabsingle');

           
        include $this->template();
    }

    public function set4(){


            global $_W;
            global $_GPC;

            if ($_W['ispost']) 
            {
                if(empty($_GPC['code'])){
                    show_json(0, '请输入验证码');
                }

                /*$key = '__wx_shop_member_verifycodesession_web_' . $_W['uniacid'] . '_13622895027';
                if (!(isset($_SESSION[$key])) || ($_SESSION[$key] !== $_GPC['code']) || !(isset($_SESSION['verifycodesendtime'])) || (($_SESSION['verifycodesendtime'] + 600) < time())) 
                {
                    show_json(0, '验证码错误或已过期!');
                }*/
                
                $data = ((is_array($_GPC['data']) ? $_GPC['data'] : array()));
       
                m('common')->updateSysset(array('grabsingle' => $data));
                plog('goods.grabsingle.set', '修改系统设置-抢单设置');
                show_json(1);
            }

            $data = m('common')->getSysset('grabsingle');
        include $this->template();
    }

    public function webCode()
    {   
        global $_W;
        global $_GPC;
        @session_start();
        // $mobile = '13622895027';//填写接收短信的手机号码

        if (!(empty($_SESSION['verifycodesendtime'])) && (time() < ($_SESSION['verifycodesendtime'] + 60))) 
        {
            show_json(0, '请求频繁请稍后重试');
        }

        $key = '__wx_shop_member_verifycodesession_web_' . $_W['uniacid'] . '_' . $mobile;
        @session_start();
        $code = random(5, true);

        $ret = com('sms')->sends($mobile, $code);
        if ($ret['status'])
        {
            $_SESSION[$key] = $code;
            $_SESSION['verifycodesendtime'] = time();
            show_json(1, '短信发送成功');
        }
        show_json(0, $ret['message']);
    }
}