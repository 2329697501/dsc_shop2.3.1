<?php
//dezend by  QQ:2172298892
defined('APPNAME') || exit('No direct script access allowed');
$shipping_lang = ROOT_PATH . 'source/language/' . c('shop.lang') . '/shipping/ems.php';

if (file_exists($shipping_lang)) {
	global $_LANG;
	include_once $shipping_lang;
}

include_once ROOT_PATH . 'languages/' . c('shop.lang') . '/admin/shipping.php';
if (isset($set_modules) && ($set_modules == true)) {
	$i = (isset($modules) ? count($modules) : 0);
	$modules[$i]['code'] = basename(__FILE__, '.php');
	$modules[$i]['version'] = '1.0.0';
	$modules[$i]['desc'] = 'ems_express_desc';
	$modules[$i]['cod'] = false;
	$modules[$i]['author'] = 'ECTouch Team';
	$modules[$i]['website'] = 'http://www.ectouch.cn';
	$modules[$i]['configure'] = array(
	array('name' => 'item_fee', 'value' => 20),
	array('name' => 'base_fee', 'value' => 20),
	array('name' => 'step_fee', 'value' => 15)
	);
	$modules[$i]['print_model'] = 2;
	$modules[$i]['print_bg'] = '/images/receipt/dly_ems.jpg';
	$modules[$i]['config_lable'] = 't_shop_name,' . $_LANG['lable_box']['shop_name'] . ',236,32,182,161,b_shop_name||,||t_shop_tel,' . $_LANG['lable_box']['shop_tel'] . ',127,21,295,135,b_shop_tel||,||t_shop_address,' . $_LANG['lable_box']['shop_address'] . ',296,68,124,190,b_shop_address||,||t_pigeon,' . $_LANG['lable_box']['pigeon'] . ',21,21,192,278,b_pigeon||,||t_customer_name,' . $_LANG['lable_box']['customer_name'] . ',107,23,494,136,b_customer_name||,||t_customer_tel,' . $_LANG['lable_box']['customer_tel'] . ',155,21,639,124,b_customer_tel||,||t_customer_mobel,' . $_LANG['lable_box']['customer_mobel'] . ',159,21,639,147,b_customer_mobel||,||t_customer_post,' . $_LANG['lable_box']['customer_post'] . ',88,21,680,258,b_customer_post||,||t_year,' . $_LANG['lable_box']['year'] . ',37,21,534,379,b_year||,||t_months,' . $_LANG['lable_box']['months'] . ',29,21,592,379,b_months||,||t_day,' . $_LANG['lable_box']['day'] . ',27,21,642,380,b_day||,||t_order_best_time,' . $_LANG['lable_box']['order_best_time'] . ',104,39,688,359,b_order_best_time||,||t_order_postscript,' . $_LANG['lable_box']['order_postscript'] . ',305,34,485,402,b_order_postscript||,||t_customer_address,' . $_LANG['lable_box']['customer_address'] . ',289,48,503,190,b_customer_address||,||';
	return NULL;
}

?>
