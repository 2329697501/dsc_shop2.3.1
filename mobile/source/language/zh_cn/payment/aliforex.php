<?php
//dezend by  QQ:2172298892
class aliforex
{
	public function get_code($order, $payment)
	{
		if (!defined('CHARSET')) {
			$charset = 'utf-8';
		}
		else {
			$charset = CHARSET;
		}

		$gateway = 'https://mapi.alipay.com/gateway.do?';
		$parameter = array('service' => 'create_forex_trade_wap', 'partner' => $payment['alipay_partner'], 'return_url' => return_url(basename(__FILE__, '.php'), array('type' => 0)), 'notify_url' => base_url() . '/api/notify/alipay.php', 'subject' => $order['order_sn'], 'body' => $order['order_sn'], 'out_trade_no' => $order['order_sn'] . 'O' . $order['log_id'], 'currency' => 'dollar', 'total_fee' => $order['order_amount'], '_input_charset' => $charset);
		ksort($parameter);
		reset($parameter);
		$param = '';
		$sign = '';

		foreach ($parameter as $key => $val) {
			$param .= $key . '=' . urlencode($val) . '&';
			$sign .= $key . '=' . $val . '&';
		}

		$param = substr($param, 0, -1);
		$sign = substr($sign, 0, -1) . $payment['alipay_key'];
		$result = Http::doPost($gateway, $param . '&sign=' . md5($sign));
		$result = urldecode($result);
		$result_array = explode('&', $result);
		$new_result_array = $temp_item = array();

		if (is_array($result_array)) {
			foreach ($result_array as $vo) {
				$temp_item = explode('=', $vo, 2);
				$new_result_array[$temp_item[0]] = $temp_item[1];
			}
		}

		$xml = simplexml_load_string($new_result_array['res_data']);
		$request_token = (array) $xml->request_token;
		$parameter = array('service' => 'alipay.wap.auth.authAndExecute', 'format' => 'xml', 'v' => $new_result_array['v'], 'partner' => $new_result_array['partner'], 'sec_id' => $new_result_array['sec_id'], 'req_data' => '<auth_and_execute_req><request_token>' . $request_token[0] . '</request_token></auth_and_execute_req>', 'request_token' => $request_token[0], '_input_charset' => $charset);
		ksort($parameter);
		reset($parameter);
		$param = '';
		$sign = '';

		foreach ($parameter as $key => $val) {
			$param .= $key . '=' . urlencode($val) . '&';
			$sign .= $key . '=' . $val . '&';
		}

		$param = substr($param, 0, -1);
		$sign = substr($sign, 0, -1) . $payment['alipay_key'];
		$button = '<script type="text/javascript" src="' . base_url('data/assets') . '/js/ap.js"></script><div><button type="button" class="btn btn-default" onclick="javascript:_AP.pay(\'' . $gateway . $param . '&sign=' . md5($sign) . '\')"  >' . l('pay_button') . '</button></div>';
		return $button;
	}

	public function callback($data)
	{
		if (!empty($_GET)) {
			$out_trade_no = explode('O', $_GET['out_trade_no']);
			$log_id = $out_trade_no[1];
			$payment = get_payment($data['code']);
			ksort($_GET);
			reset($_GET);
			$sign = '';

			foreach ($_GET as $key => $val) {
				if (($key != 'sign') && ($key != 'sign_type') && ($key != 'code')) {
					$sign .= $key . '=' . $val . '&';
				}
			}

			$sign = substr($sign, 0, -1) . $payment['alipay_key'];

			if (md5($sign) != $_GET['sign']) {
				return false;
			}

			if ($_GET['result'] == 'success') {
				order_paid($log_id, 2);
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	public function notify($data)
	{
		if (!empty($_POST)) {
			$payment = get_payment($data['code']);
			$parameter['service'] = $_POST['service'];
			$parameter['v'] = $_POST['v'];
			$parameter['sec_id'] = $_POST['sec_id'];
			$parameter['notify_data'] = $_POST['notify_data'];
			$sign = '';

			foreach ($parameter as $key => $val) {
				$sign .= $key . '=' . $val . '&';
			}

			$sign = substr($sign, 0, -1) . $payment['alipay_key'];

			if (md5($sign) != $_POST['sign']) {
				exit('fail');
			}

			$data = (array) simplexml_load_string($parameter['notify_data']);
			$trade_status = $data['trade_status'];
			$out_trade_no = explode('O', $data['out_trade_no']);
			$log_id = $out_trade_no[1];
			if (($trade_status == 'TRADE_FINISHED') || ($trade_status == 'TRADE_SUCCESS')) {
				order_paid($log_id, 2);

				if (method_exists('WechatController', 'do_oauth')) {
					$order_id = model('Base')->model->table('order_info')->field('order_id')->where('order_sn = "' . $out_trade_no[0] . '"')->getOne();
					$order_url = __HOST__ . url('user/order_detail', array('order_id' => $order_id));
					$order_url = urlencode(base64_encode($order_url));
					send_wechat_message('pay_remind', '', $out_trade_no[0] . ' 订单已支付', $order_url, $out_trade_no[0]);
				}

				exit('success');
			}
			else {
				exit('fail');
			}
		}
		else {
			exit('fail');
		}
	}

	public function query($order, $payment)
	{
	}
}

defined('BASE_PATH') || exit('No direct script access allowed');

?>
