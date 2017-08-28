<?php
//dezend by  QQ:2172298892
namespace apps\sms\controllers;

class IndexController extends \apps\base\controllers\FrontendController
{
	protected $mobile;
	protected $mobile_code;
	protected $sms_code;
	protected $flag;

	public function __construct()
	{
		parent::__construct();
		l(require ROOT_PATH . 'source/language/' . c('shop.lang') . '/other.php');
		$this->mobile = i('mobile');
		$this->mobile_code = i('mobile_code');
		$this->sms_code = i('sms_code');
		$this->flag = i('flag');
	}

	public function actionSend()
	{
		if (empty($this->mobile)) {
			exit(json_encode(array('msg' => l('mobile_notnull'))));
		}

		$preg = '/^1[0-9]{10}$/';

		if (!preg_match($preg, $this->mobile)) {
			exit(json_encode(array('msg' => l('mobile_format_error'))));
		}

		if ($_SESSION['sms_mobile']) {
			if ((time() - 60) < strtotime($this->read_file($this->mobile))) {
				exit(json_encode(array('msg' => l('msg_wait_auth_code'))));
			}
		}

		$where['mobile_phone'] = $this->mobile;
		$user_id = $this->db->getOne('SELECT user_id FROM {pre}users WHERE mobile_phone=\'' . $where['mobile_phone'] . '\'');

		if ($this->flag == 'register') {
			if (!empty($user_id)) {
				exit(json_encode(array('msg' => l('change_mobile'))));
			}
		}
		else if ($this->flag == 'forget') {
			if (empty($user_id)) {
				exit(json_encode(array('msg' => l('mobile_number_Unknown'))));
			}
		}

		$this->mobile_code = $this->random(6, 1);
		$sms_type = c('shop.sms_type');

		if ($sms_type == 0) {
			$sms_type = 'Ihuyi';
			$message = l('you_auth_code') . $this->mobile_code . l('please_protect_authcode');
			$send_time = '';
		}
		else {
			$sms_type = 'Alidayu';
			$message = array('mobile_code' => $this->mobile_code, 'user_name' => '');
			$send_time = 'sms_signin';
		}

		$send_result = send_sms($this->mobile, $message, $sms_type, $send_time);
		$this->write_file($this->mobile, $send_result);

		if ($send_result === true) {
			$_SESSION['sms_mobile'] = $this->mobile;
			$_SESSION['sms_mobile_code'] = $this->mobile_code;
			exit(json_encode(array('code' => 2, 'msg' => l('send_auth_code'))));
		}
		else {
			exit(json_encode(array('msg' => $send_result)));
		}
	}

	public function actionCheck()
	{
		if (($this->mobile != $_SESSION['sms_mobile']) || ($this->mobile_code != $_SESSION['sms_mobile_code'])) {
			exit(json_encode(array('msg' => l('mobile_auth_code_error'), 'code' => 1)));
		}
		else {
			exit(json_encode(array('code' => '2')));
		}
	}

	private function random($length = 6, $numeric = 0)
	{
		(PHP_VERSION < '4.2.0') && mt_srand((double) microtime() * 1000000);

		if ($numeric) {
			$hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
		}
		else {
			$hash = '';
			$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
			$max = strlen($chars) - 1;

			for ($i = 0; $i < $length; $i++) {
				$hash .= $chars[mt_rand(0, $max)];
			}
		}

		return $hash;
	}

	private function write_file($file_name, $content)
	{
		$this->mkdirs(ROOT_PATH . 'data/smslog/' . date('Ymd'));
		$filename = ROOT_PATH . 'data/smslog/' . date('Ymd') . '/' . $file_name . '.log';
		$Ts = fopen($filename, 'a+');
		fputs($Ts, "\r\n" . $content);
		fclose($Ts);
	}

	private function mkdirs($dir, $mode = 511)
	{
		if (is_dir($dir) || @mkdir($dir, $mode)) {
			return TRUE;
		}

		if (!$this->mkdirs(dirname($dir), $mode)) {
			return FALSE;
		}

		return @mkdir($dir, $mode);
	}

	private function read_file($file_name)
	{
		$content = '';
		$filename = ROOT_PATH . 'data/smslog/' . date('Ymd') . '/' . $file_name . '.log';

		if (function_exists('file_get_contents')) {
			@$content = file_get_contents($filename);
		}
		else if (@$fp = fopen($filename, 'r')) {
			@$content = fread($fp, filesize($filename));
			@fclose($fp);
		}

		$content = explode("\r\n", $content);
		return end($content);
	}
}

?>
