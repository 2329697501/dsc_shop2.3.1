<?php
//dezend by  QQ:2172298892
defined('APPNAME') || exit('No direct script access allowed');
$shipping_lang = ROOT_PATH . 'source/language/' . c('shop.lang') . '/shipping/post_mail.php';

if (file_exists($shipping_lang)) {
	global $_LANG;
	include_once $shipping_lang;
}

if (isset($set_modules) && ($set_modules == true)) {
	$i = (isset($modules) ? count($modules) : 0);
	$modules[$i]['code'] = basename(__FILE__, '.php');
	$modules[$i]['version'] = '1.0.0';
	$modules[$i]['desc'] = 'post_mail_desc';
	$modules[$i]['cod'] = false;
	$modules[$i]['author'] = 'ECTouch Team';
	$modules[$i]['website'] = 'http://www.ectouch.cn';
	$modules[$i]['configure'] = array(
	array('name' => 'item_fee', 'value' => 4),
	array('name' => 'base_fee', 'value' => 3.5),
	array('name' => 'step_fee', 'value' => 2),
	array('name' => 'step_fee1', 'value' => 2.5),
	array('name' => 'pack_fee', 'value' => 0)
	);
	$modules[$i]['print_model'] = 2;
	$modules[$i]['print_bg'] = '';
	$modules[$i]['config_lable'] = '';
	return NULL;
}

?>
