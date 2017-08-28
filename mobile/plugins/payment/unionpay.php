<?php
//dezend by  QQ:2172298892
class unionpay
{
	public function __construct()
	{
		defined('SDK_SIGN_CERT_PATH') || define('SDK_SIGN_CERT_PATH', DATA_PATH . '/cer/' . 'PM_700000000000001_acp.pfx');
		defined('SDK_SIGN_CERT_PWD') || define('SDK_SIGN_CERT_PWD', '000000');
		defined('SDK_VERIFY_CERT_DIR') || define('SDK_VERIFY_CERT_DIR', DATA_PATH . '/cer/');
		defined('SDK_FRONT_TRANS_URL') || define('SDK_FRONT_TRANS_URL', 'https://101.231.204.80:5000/gateway/api/frontTransReq.do');
		defined('SDK_BACK_TRANS_URL') || define('SDK_BACK_TRANS_URL', 'https://101.231.204.80:5000/gateway/api/backTransReq.do');
		defined('SDK_SINGLE_QUERY_URL') || define('SDK_SINGLE_QUERY_URL', 'https://101.231.204.80:5000/gateway/api/queryTrans.do');
		include_once BASE_PATH . 'helpers/order_helper.php';
		include_once BASE_PATH . 'helpers/payment_helper.php';
	}

	public function get_code($order, $payment)
	{
		if (!defined('EC_CHARSET')) {
			$charset = 'UTF-8';
		}
		else {
			$charset = EC_CHARSET;
		}

		if (!$order['add_time']) {
			$order['add_time'] = gmtime();
		}

		if (!isset($order['order_sn'][10])) {
			$order['order_sn'] = get_order_sn();
		}

		$parameter = array('version' => '5.0.0', 'encoding' => $charset, 'certId' => $this->getSignCertId(), 'txnType' => '01', 'txnSubType' => '01', 'bizType' => '000000', 'frontUrl' => return_url(basename(__FILE__, '.php')), 'backUrl' => notify_url(basename(__FILE__, '.php')), 'signMethod' => '01', 'channelType' => '08', 'accessType' => '0', 'merId' => $payment['mer_id'], 'orderId' => $order['order_sn'] . '0' . $order['log_id'], 'txnTime' => date('YmdHis', $order['add_time']), 'txnAmt' => $order['order_amount'] * 100, 'currencyCode' => '156', 'defaultPayType' => '0001', 'reqReserved' => ' 透传信息');
		$this->sign($parameter);
		$front_uri = 'https://101.231.204.80:5000/gateway/api/frontTransReq.do';
		$html_form = $this->create_html($parameter, $front_uri);
		return $html_form;
	}

	public function verify_query($order, $payment)
	{
		if (!defined('EC_CHARSET')) {
			$charset = 'UTF-8';
		}
		else {
			$charset = EC_CHARSET;
		}

		$params = array('version' => '5.0.0', 'encoding' => $charset, 'certId' => $this->getSignCertId(), 'signMethod' => '01', 'txnType' => '00', 'txnSubType' => '00', 'bizType' => '000000', 'accessType' => '0', 'channelType' => '07', 'orderId' => $order['order_sn'] . '0' . $order['log_id'], 'merId' => $payment['mer_id'], 'txnTime' => date('YmdHis', $order['add_time']));
		$this->sign($params);
		$result = $this->sendHttpRequest($params, SDK_SINGLE_QUERY_URL);
		$result_arr = $this->coverStringToArray($result);

		if ($this->verify($result_arr)) {
			if ($result_arr['respCode'] == '00') {
				print_r($result_arr);
				echo 'ee';
				$log_id = substr($result_arr['orderId'], 14);
				order_paid($log_id, 2);
				return true;
			}
		}
	}

	public function callback($data)
	{
		if (isset($_POST['signature'])) {
			if ($this->verify($_POST)) {
				if ($_POST['respCode'] == '00') {
					$log_id = substr($_POST['orderId'], 14);
					order_paid($log_id, 2);
					return true;
				}
			}
			else {
				return false;
			}
		}
		else {
			echo '签名为空';
		}
	}

	public function notify($data)
	{
		if (!empty($_POST)) {
			if (isset($_POST['signature'])) {
				if ($this->verify($_POST)) {
					if ($_POST['respCode'] == '00') {
						$log_id = substr($_POST['orderId'], 14);
						order_paid($log_id, 2);
						return true;
					}
				}
				else {
					return false;
				}
			}
			else {
				echo '签名为空';
			}
		}
		else {
			exit('fail');
		}
	}

	public function getSignCertId()
	{
		return $this->getCertId(SDK_SIGN_CERT_PATH);
	}

	public function getCertId($cert_path)
	{
		$pkcs12certdata = file_get_contents($cert_path);
		openssl_pkcs12_read($pkcs12certdata, $certs, SDK_SIGN_CERT_PWD);
		$x509data = $certs['cert'];
		openssl_x509_read($x509data);
		$certdata = openssl_x509_parse($x509data);
		$cert_id = $certdata['serialNumber'];
		return $cert_id;
	}

	public function sign(&$params)
	{
		if (isset($params['transTempUrl'])) {
			unset($params['transTempUrl']);
		}

		$params_str = $this->coverParamsToString($params);
		$params_sha1x16 = sha1($params_str, false);
		$cert_path = SDK_SIGN_CERT_PATH;
		$private_key = $this->getPrivateKey($cert_path);
		$sign_falg = openssl_sign($params_sha1x16, $signature, $private_key, OPENSSL_ALGO_SHA1);

		if ($sign_falg) {
			$signature_base64 = base64_encode($signature);
			$params['signature'] = $signature_base64;
		}
		else {
			echo '签名失败';
			exit();
		}
	}

	public function getPrivateKey($cert_path)
	{
		$pkcs12 = file_get_contents($cert_path);
		openssl_pkcs12_read($pkcs12, $certs, SDK_SIGN_CERT_PWD);
		return $certs['pkey'];
	}

	public function coverParamsToString($params)
	{
		$sign_str = '';
		ksort($params);

		foreach ($params as $key => $val) {
			if ($key == 'signature') {
				continue;
			}

			$sign_str .= sprintf('%s=%s&', $key, $val);
		}

		return substr($sign_str, 0, strlen($sign_str) - 1);
	}

	public function create_html($params, $action)
	{
		$encodeType = (isset($params['encoding']) ? $params['encoding'] : 'UTF-8');
		$html = '    <form id="pay_form" name="pay_form" action="' . $action . "\" method=\"post\" target=\"_blank\">\r\n";

		foreach ($params as $key => $value) {
			$html .= '    <input type="hidden" name="' . $key . '" id="' . $key . '"  value="' . $value . "\" />\n";
		}

		$html .= "    <input type=\"submit\" type=\"hidden\" value=\"立即支付\" class=\"btn btn-info ect-btn-info ect-colorf ect-bg c-btn3\">\r\n    </form>";
		return $html;
	}

	public function verify($params)
	{
		global $log;
		$public_key = $this->getPulbicKeyByCertId($params['certId']);
		$signature_str = $params['signature'];
		unset($params['signature']);
		$params_str = $this->coverParamsToString($params);
		$signature = base64_decode($signature_str);
		$params_sha1x16 = sha1($params_str, false);
		$isSuccess = openssl_verify($params_sha1x16, $signature, $public_key, OPENSSL_ALGO_SHA1);
		return $isSuccess;
	}

	public function getPulbicKeyByCertId($certId)
	{
		global $log;
		$cert_dir = SDK_VERIFY_CERT_DIR;
		$handle = opendir($cert_dir);

		if ($handle) {
			while ($file = readdir($handle)) {
				clearstatcache();
				$filePath = $cert_dir . '/' . $file;

				if (is_file($filePath)) {
					if (pathinfo($file, PATHINFO_EXTENSION) == 'cer') {
						if ($this->getCertIdByCerPath($filePath) == $certId) {
							closedir($handle);
							return $this->getPublicKey($filePath);
						}
					}
				}
			}
		}

		closedir($handle);
		return NULL;
	}

	public function getCertIdByCerPath($cert_path)
	{
		$x509data = file_get_contents($cert_path);
		openssl_x509_read($x509data);
		$certdata = openssl_x509_parse($x509data);
		$cert_id = $certdata['serialNumber'];
		return $cert_id;
	}

	public function getPublicKey($cert_path)
	{
		return file_get_contents($cert_path);
	}

	public function sendHttpRequest($params, $url)
	{
		$opts = $this->getRequestParamString($params);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/x-www-form-urlencoded;charset=UTF-8'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $opts);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($ch);
		curl_close($ch);
		return $html;
	}

	public function coverStringToArray($str)
	{
		$result = array();

		if (!empty($str)) {
			$temp = preg_split('/&/', $str);

			if (!empty($temp)) {
				foreach ($temp as $key => $val) {
					$arr = preg_split('/=/', $val, 2);

					if (!empty($arr)) {
						$k = $arr['0'];
						$v = $arr['1'];
						$result[$k] = $v;
					}
				}
			}
		}

		return $result;
	}

	public function getRequestParamString($params)
	{
		$params_str = '';

		foreach ($params as $key => $value) {
			$params_str .= $key . '=' . (!isset($value) ? '' : urlencode($value)) . '&';
		}

		return substr($params_str, 0, strlen($params_str) - 1);
	}
}

defined('BASE_PATH') || exit('No direct script access allowed');

?>
