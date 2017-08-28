<?php
//dezend by  QQ:2172298892
defined('IN_ECTOUCH') || exit('Deny Access');
$payment_lang = BASE_PATH . 'language/' . c('lang') . '/connect/' . basename(__FILE__);

if (file_exists($payment_lang)) {
	include_once $payment_lang;
	l($_LANG);
}

if (isset($set_modules) && ($set_modules == true)) {
	$i = (isset($modules) ? count($modules) : 0);
	$modules[$i]['name'] = 'Wechat';
	$modules[$i]['type'] = 'wechat';
	$modules[$i]['className'] = 'wechat';
	$modules[$i]['author'] = 'ECTouch';
	$modules[$i]['qq'] = '800007167';
	$modules[$i]['email'] = 'support@ecmoban.com';
	$modules[$i]['website'] = 'http://mp.weixin.qq.com';
	$modules[$i]['version'] = '1.0';
	$modules[$i]['date'] = '2014-10-03';
	$modules[$i]['config'] = array(
	array('type' => 'text', 'name' => 'app_id', 'value' => ''),
	array('type' => 'text', 'name' => 'app_secret', 'value' => '')
	);
	return NULL;
}

?>
