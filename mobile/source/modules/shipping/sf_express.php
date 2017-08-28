<?php
//dezend by  QQ:2172298892
defined('APPNAME') || exit('No direct script access allowed');
$shipping_lang = ROOT_PATH . 'source/language/' . c('shop.lang') . '/shipping/sf_express.php';

if (file_exists($shipping_lang)) {
	global $_LANG;
	include_once $shipping_lang;
}

if (isset($set_modules) && ($set_modules == true)) {
	include_once ROOT_PATH . 'languages/' . $GLOBALS['_CFG']['lang'] . '/admin/shipping.php';
	$i = (isset($modules) ? count($modules) : 0);
	$modules[$i]['code'] = basename(__FILE__, '.php');
	$modules[$i]['version'] = '1.0.0';
	$modules[$i]['desc'] = 'sf_express_desc';
	$modules[$i]['cod'] = false;
	$modules[$i]['author'] = 'ECTouch Team';
	$modules[$i]['website'] = 'http://www.ectouch.cn';
	$modules[$i]['configure'] = array(
	array('name' => 'item_fee', 'value' => 20),
	array('name' => 'base_fee', 'value' => 15),
	array('name' => 'step_fee', 'value' => 2)
	);
	$modules[$i]['print_model'] = 2;
	$modules[$i]['print_bg'] = '/images/receipt/dly_sf_express.jpg';
	$modules[$i]['config_lable'] = 't_shop_name,' . $_LANG['lable_box']['shop_name'] . ',150,29,112,137,b_shop_name||,||t_shop_address,' . $_LANG['lable_box']['shop_address'] . ',268,55,105,168,b_shop_address||,||t_shop_tel,' . $_LANG['lable_box']['shop_tel'] . ',55,25,177,224,b_shop_tel||,||t_customer_name,' . $_LANG['lable_box']['customer_name'] . ',78,23,299,265,b_customer_name||,||t_customer_address,' . $_LANG['lable_box']['customer_address'] . ',271,94,104,293,b_customer_address||,||';
	return NULL;
}

?>
