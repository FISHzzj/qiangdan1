<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

require WX_SHOP_PLUGIN . 'app/core/page_mobile.php';
class Sms_WxShopPage extends AppMobilePage
{
	public function register()
	{
		$this->loginSMS('reg');
	}

	public function forget()
	{
		$this->loginSMS('forget');
	}

	public function changepwd()
	{
		$this->loginSMS('changepwd');
	}

	public function changemobile()
	{
		$this->loginSMS('bind');
	}

	public function changemobie()
	{
		$this->loginSMS('bind');
	}

	protected function loginSMS($temp)
	{
		global $_W;
		global $_GPC;
		$mobile = trim($_GPC['mobile']);

		if (empty($mobile)) {
			app_error(AppError::$ParamsError, '手机号不能为空');
		}

		if (($temp == 'bind') && $this->iswxapp && empty($_W['shopset']['isclose']) && !empty($_W['shopset']['openbind'])) {
			$data = m('common')->getSysset('app');
		}
		else {
			$data = m('common')->getSysset('wap');
		}

		$sms_id = $data['sms_' . $temp];

		if (empty($sms_id)) {
			app_error(AppError::$SMSTplidNull);
		}

		$key = '__wx_shop_member_verifycodesession_' . $_W['uniacid'] . '_' . $mobile;
		$key_time = '__wx_shop_member_verifycodesendtime_' . $_W['uniacid'];
		$sendtime = m('cache')->get($key_time);

		if (!is_numeric($sendtime)) {
			$sendtime = 0;
		}

		$time = time() - $sendtime;

		if ($time < 60) {
			app_error(AppError::$SMSRateError);
		}

		$code = random(5, true);
		$ret = com('sms')->send($mobile, $sms_id, array('验证码' => $code, '商城名称' => $_W['shopset']['shop']['name']));

        if ($ret['status']) {
            m('cache')->set($key, $code);
            m('cache')->set($key_time, time());
            app_json(array('status'=>1,'message'=>$ret['message']));
        }

		app_error(AppError::$SystemError, $ret['message']);
	}
}

?>
