<?php
//dezend by  QQ:2172298892
defined('APPNAME') || exit('No direct script access allowed');
$shipping_lang = ROOT_PATH . 'source/language/' . c('shop.lang') . '/shipping/sto_express.php';

if (file_exists($shipping_lang)) {
	global $_LANG;
	include_once $shipping_lang;
}

if (isset($set_modules) && ($set_modules == true)) {
	include_once ROOT_PATH . 'languages/' . $GLOBALS['_CFG']['lang'] . '/admin/shipping.php';
	$i = (isset($modules) ? count($modules) : 0);
	$modules[$i]['code'] = basename(__FILE__, '.php');
	$modules[$i]['version'] = '1.0.0';
	$modules[$i]['desc'] = 'sto_express_desc';
	$modules[$i]['cod'] = false;
	$modules[$i]['author'] = 'ECTouch Team';
	$modules[$i]['website'] = 'http://www.ectouch.cn';
	$modules[$i]['configure'] = array(
	array('name' => 'item_fee', 'value' => 15),
	array('name' => 'base_fee', 'value' => 15),
	array('name' => 'step_fee', 'value' => 5)
	);
	$modules[$i]['print_model'] = 2;
	$modules[$i]['print_bg'] = '/images/receipt/dly_sto_express.jpg';
	$modules[$i]['config_lable'] = 't_shop_address,' . $_LANG['lable_box']['shop_address'] . ',235,48,131,152,b_shop_address||,||t_shop_name,' . $_LANG['lable_box']['shop_name'] . ',237,26,131,200,b_shop_name||,||t_shop_tel,' . $_LANG['lable_box']['shop_tel'] . ',96,36,144,257,b_shop_tel||,||t_customer_post,' . $_LANG['lable_box']['customer_post'] . ',86,23,578,268,b_customer_post||,||t_customer_address,' . $_LANG['lable_box']['customer_address'] . ',232,49,434,149,b_customer_address||,||t_customer_name,' . $_LANG['lable_box']['customer_name'] . ',151,27,449,231,b_customer_name||,||t_customer_tel,' . $_LANG['lable_box']['customer_tel'] . ',90,32,452,261,b_customer_tel||,||';
	return NULL;
}

?>
