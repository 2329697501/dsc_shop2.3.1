<?php
//dezend by  QQ:2172298892
class wxpay
{
	private $parameters;
	private $payment;

	public function get_code($order, $payment)
	{
		include_once BASE_PATH . 'helpers/payment_helper.php';
		$this->payment = $payment;
		$openid = '';
		if (isset($_SESSION['openid']) && !empty($_SESSION['openid'])) {
			$openid = $_SESSION['openid'];
		}
		else {
			if (isset($_SESSION['openid_base']) && !empty($_SESSION['openid_base'])) {
				$openid = $_SESSION['openid_base'];
			}
			else {
				return false;
			}
		}

		$order_amount = $order['order_amount'] * 100;
		$this->setParameter('openid', $openid);
		$this->setParameter('body', $order['order_sn']);
		$this->setParameter('out_trade_no', $order['order_sn'] . $order_amount . 'O' . $order['log_id']);
		$this->setParameter('total_fee', $order_amount);
		$this->setParameter('notify_url', __URL__ . 'wxpay.php');
		$this->setParameter('trade_type', 'JSAPI');
		$prepay_id = $this->getPrepayId();
		$jsApiParameters = $this->getParameters($prepay_id);
		$js = "<script language=\"javascript\">\r\n            function jsApiCall(){WeixinJSBridge.invoke(\"getBrandWCPayRequest\"," . $jsApiParameters . ',function(res){if(res.err_msg == "get_brand_wcpay_request:ok"){location.href="' . return_url(basename(__FILE__, '.php')) . "\"}else{}})};function callpay(){if (typeof WeixinJSBridge == \"undefined\"){if( document.addEventListener ){document.addEventListener(\"WeixinJSBridgeReady\", jsApiCall, false);}else if (document.attachEvent){document.attachEvent(\"WeixinJSBridgeReady\", jsApiCall);document.attachEvent(\"onWeixinJSBridgeReady\", jsApiCall);}}else{jsApiCall();}}\r\n            </script>";

		if (file_exists(ROOT_PATH . 'source/apps/wechat')) {
			$button = '<a class="box-flex btn-submit" type="button" onclick="callpay()">微信支付</a>' . $js;
		}
		else {
			$button = '<a class="box-flex btn-submit" type="button">微信支付</a>';
		}

		return $button;
	}

	public function callback($data)
	{
		return true;
	}

	public function notify($data)
	{
		include_once BASE_PATH . 'helpers/payment_helper.php';

		if (!empty($data['postStr'])) {
			$payment = get_payment($data['code']);
			$postdata = json_decode(json_encode(simplexml_load_string($data['postStr'], 'SimpleXMLElement', LIBXML_NOCDATA)), true);
			$wxsign = $postdata['sign'];
			unset($postdata['sign']);

			foreach ($postdata as $k => $v) {
				$Parameters[$k] = $v;
			}

			ksort($Parameters);
			$buff = '';

			foreach ($Parameters as $k => $v) {
				$buff .= $k . '=' . $v . '&';
			}

			if (0 < strlen($buff)) {
				$String = substr($buff, 0, strlen($buff) - 1);
			}

			$String = $String . '&key=' . $payment['wxpay_key'];
			$String = md5($String);
			$sign = strtoupper($String);

			if ($wxsign == $sign) {
				if ($postdata['result_code'] == 'SUCCESS') {
					$out_trade_no = explode('O', $postdata['out_trade_no']);
					$order_sn = $out_trade_no[1];
					order_paid($order_sn, 2);
					model()->table('pay_log')->data(array('openid' => $postdata['openid'], 'transid' => $postdata['transaction_id']))->where(array('log_id' => $order_sn))->update();
				}

				$returndata['return_code'] = 'SUCCESS';
			}
			else {
				$returndata['return_code'] = 'FAIL';
				$returndata['return_msg'] = '签名失败';
			}
		}
		else {
			$returndata['return_code'] = 'FAIL';
			$returndata['return_msg'] = '无数据返回';
		}

		$xml = '<xml>';

		foreach ($returndata as $key => $val) {
			if (is_numeric($val)) {
				$xml .= '<' . $key . '>' . $val . '</' . $key . '>';
			}
			else {
				$xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
			}
		}

		$xml .= '</xml>';
		echo $xml;
		exit();
	}

	public function trimString($value)
	{
		$ret = NULL;

		if (NULL != $value) {
			$ret = $value;

			if (strlen($ret) == 0) {
				$ret = NULL;
			}
		}

		return $ret;
	}

	public function createNoncestr($length = 32)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$str = '';

		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}

		return $str;
	}

	public function setParameter($parameter, $parameterValue)
	{
		$this->parameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
	}

	public function getSign($Obj)
	{
		foreach ($Obj as $k => $v) {
			$Parameters[$k] = $v;
		}

		ksort($Parameters);
		$buff = '';

		foreach ($Parameters as $k => $v) {
			$buff .= $k . '=' . $v . '&';
		}

		if (0 < strlen($buff)) {
			$String = substr($buff, 0, strlen($buff) - 1);
		}

		$String = $String . '&key=' . $this->payment['wxpay_key'];
		$String = md5($String);
		$result_ = strtoupper($String);
		return $result_;
	}

	public function postXmlCurl($xml, $url, $second = 30)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOP_TIMEOUT, $second);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		$data = curl_exec($ch);
		curl_close($ch);

		if ($data) {
			curl_close($ch);
			return $data;
		}
		else {
			$error = curl_errno($ch);
			echo 'curl出错，错误码:' . $error . '<br>';
			echo '<a href=\'http://curl.haxx.se/libcurl/c/libcurl-errors.html\'>错误原因查询</a></br>';
			curl_close($ch);
			return false;
		}
	}

	public function getPrepayId()
	{
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

		try {
			if ($this->parameters['out_trade_no'] == NULL) {
				throw new Exception('缺少统一支付接口必填参数out_trade_no！' . '<br>');
			}
			else if ($this->parameters['body'] == NULL) {
				throw new Exception('缺少统一支付接口必填参数body！' . '<br>');
			}
			else if ($this->parameters['total_fee'] == NULL) {
				throw new Exception('缺少统一支付接口必填参数total_fee！' . '<br>');
			}
			else if ($this->parameters['notify_url'] == NULL) {
				throw new Exception('缺少统一支付接口必填参数notify_url！' . '<br>');
			}
			else if ($this->parameters['trade_type'] == NULL) {
				throw new Exception('缺少统一支付接口必填参数trade_type！' . '<br>');
			}
			else {
				if (($this->parameters['trade_type'] == 'JSAPI') && ($this->parameters['openid'] == NULL)) {
					throw new Exception('统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！' . '<br>');
				}
			}

			$this->parameters['appid'] = $this->payment['wxpay_appid'];
			$this->parameters['mch_id'] = $this->payment['wxpay_mchid'];
			$this->parameters['spbill_create_ip'] = $_SERVER['REMOTE_ADDR'];
			$this->parameters['nonce_str'] = $this->createNoncestr();
			$this->parameters['sign'] = $this->getSign($this->parameters);
			$xml = '<xml>';

			foreach ($this->parameters as $key => $val) {
				if (is_numeric($val)) {
					$xml .= '<' . $key . '>' . $val . '</' . $key . '>';
				}
				else {
					$xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
				}
			}

			$xml .= '</xml>';
		}
		catch (Exception $e) {
			exit($e->getMessage());
		}

		$response = \libraries\Http::curlPost($url, $xml, 30);
		$result = json_decode(json_encode(simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		$prepay_id = $result['prepay_id'];
		return $prepay_id;
	}

	public function getParameters($prepay_id)
	{
		$jsApiObj['appId'] = $this->payment['wxpay_appid'];
		$timeStamp = time();
		$jsApiObj['timeStamp'] = $timeStamp;
		$jsApiObj['nonceStr'] = $this->createNoncestr();
		$jsApiObj['package'] = 'prepay_id=' . $prepay_id;
		$jsApiObj['signType'] = 'MD5';
		$jsApiObj['paySign'] = $this->getSign($jsApiObj);
		$this->parameters = json_encode($jsApiObj);
		return $this->parameters;
	}

	public function query($order, $payment)
	{
	}

	private function getOpenid()
	{
		if (!isset($_GET['code'])) {
			$redirectUrl = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . $_SERVER['QUERY_STRING']);
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $payment['wxpay_appid'] . '&redirect_uri=' . $redirectUrl . '&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
			header('Location: ' . $url);
			exit();
		}
		else {
			$code = $_GET['code'];
			$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->payment['wxpay_appid'] . '&secret=' . $this->payment['wxpay_appsecret'] . '&code=' . $code . '&grant_type=authorization_code';
			$result = \libraries\Http::doGet($url);

			if ($result) {
				$json = json_decode($result);
				if (isset($json['errCode']) && $json['errCode']) {
					return false;
				}

				$_SESSION['openid_base'] = $json['openid'];
				return $json['openid'];
			}

			return $false;
		}
	}
}

defined('BASE_PATH') || exit('No direct script access allowed');

?>
