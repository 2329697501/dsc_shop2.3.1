<?php
//dezend by  QQ:2172298892
class paypal
{
	public function get_code($order, $payment)
	{
		include_once BASE_PATH . 'helpers/payment_helper.php';
		$data_order_id = $order['log_id'];
		$data_amount = $order['order_amount'];
		$data_return_url = return_url(basename(__FILE__, '.php'));
		$data_pay_account = $payment['paypal_account'];
		$currency_code = $payment['paypal_currency'];
		$data_notify_url = notify_url(basename(__FILE__, '.php'));
		$cancel_return = __URL__;
		$def_url = '<br /><form style="text-align:center;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">' . '<input type=\'hidden\' name=\'cmd\' value=\'_xclick\'>' . '<input type=\'hidden\' name=\'business\' value=\'' . $data_pay_account . '\'>' . '<input type=\'hidden\' name=\'item_name\' value=\'' . $order['order_sn'] . '\'>' . '<input type=\'hidden\' name=\'amount\' value=\'' . $data_amount . '\'>' . '<input type=\'hidden\' name=\'currency_code\' value=\'' . $currency_code . '\'>' . '<input type=\'hidden\' name=\'return\' value=\'' . $data_return_url . '\'>' . '<input type=\'hidden\' name=\'invoice\' value=\'' . $data_order_id . '\'>' . '<input type=\'hidden\' name=\'charset\' value=\'utf-8\'>' . '<input type=\'hidden\' name=\'no_shipping\' value=\'1\'>' . '<input type=\'hidden\' name=\'no_note\' value=\'\'>' . '<input type=\'hidden\' name=\'notify_url\' value=\'' . $data_notify_url . '\'>' . '<input type=\'hidden\' name=\'rm\' value=\'2\'>' . '<input type=\'hidden\' name=\'cancel_return\' value=\'' . $cancel_return . '\'>' . '<input type=\'submit\' value=\'去付款\' class=\'box-flex btn-submit\' style=\'width:100%\'>' . '</form><br />';
		return $def_url;
	}

	public function callback($data)
	{
		include_once BASE_PATH . 'helpers/payment_helper.php';
		$payment = get_payment($data['code']);
		$merchant_id = $payment['paypal_account'];
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= '&' . $key . '=' . $value;
		}

		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= 'Content-Length: ' . strlen($req) . "\r\n\r\n";
		$fp = stream_socket_client('tcp://www.paypal.com:80', $errno, $errstr, 5);
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		$order_sn = $_POST['invoice'];
		$memo = (!empty($_POST['memo']) ? $_POST['memo'] : '');
		$action_note = $txn_id . '（' . l('paypal_txn_id') . '）' . $memo;
		$count = $GLOBALS['db']->getOne('SELECT count(*) FROM {pre}order_action WHERE action_note LIKE "' . mysql_like_quote($txn_id) . '"%');

		if (0 < $count) {
			fclose($fp);
			return true;
		}

		if ($fp) {
			fputs($fp, $header . $req);

			while (!feof($fp)) {
				$res = fgets($fp, 1024);

				if (strcmp($res, 'VERIFIED') == 0) {
					if (($payment_status != 'Completed') && ($payment_status != 'Pending')) {
						fclose($fp);
						return false;
					}

					if ($receiver_email != $merchant_id) {
						fclose($fp);
						return false;
					}

					$order_amount = model()->table('pay_log')->field('order_amount')->where(array('log_id' => $order_sn))->one();

					if ($order_amount != $payment_amount) {
						fclose($fp);
						return false;
					}

					if ($payment['paypal_currency'] != $payment_currency) {
						fclose($fp);
						return false;
					}

					order_paid($order_sn, PS_PAYED, $action_note);
					fclose($fp);
					return true;
				}
				else if (strcmp($res, 'INVALID') == 0) {
					fclose($fp);
					return false;
				}
			}
		}
		else {
			fclose($fp);
			return false;
		}
	}

	public function notify($data)
	{
		$this->callback($data);
	}
}

defined('BASE_PATH') || exit('No direct script access allowed');

?>
