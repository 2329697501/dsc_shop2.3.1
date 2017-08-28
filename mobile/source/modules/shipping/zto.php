<?php
//dezend by  QQ:2172298892
defined('APPNAME') || exit('No direct script access allowed');
$shipping_lang = ROOT_PATH . 'source/language/' . c('shop.lang') . '/shipping/zto.php';

if (file_exists($shipping_lang)) {
	global $_LANG;
	include_once $shipping_lang;
}

if (isset($set_modules) && ($set_modules == true)) {
	include_once ROOT_PATH . 'languages/' . c('shop.lang') . '/admin/shipping.php';
	$i = (isset($modules) ? count($modules) : 0);
	$modules[$i]['code'] = 'zto';
	$modules[$i]['version'] = '1.0.0';
	$modules[$i]['desc'] = 'zto_desc';
	$modules[$i]['insure'] = '2%';
	$modules[$i]['cod'] = false;
	$modules[$i]['author'] = 'ECTouch Team';
	$modules[$i]['website'] = 'http://www.ectouch.cn';
	$modules[$i]['configure'] = array(
	array('name' => 'item_fee', 'value' => 15),
	array('name' => 'base_fee', 'value' => 10),
	array('name' => 'step_fee', 'value' => 5)
	);
	$modules[$i]['print_model'] = 2;
	$modules[$i]['print_bg'] = '/images/receipt/dly_zto.jpg';
	$modules[$i]['config_lable'] = 't_shop_province,' . $_LANG['lable_box']['shop_province'] . ',116,30,296.55,117.2,b_shop_province||,||t_customer_province,' . $_LANG['lable_box']['customer_province'] . ',114,32,649.95,114.3,b_customer_province||,||t_shop_address,' . $_LANG['lable_box']['shop_address'] . ',260,57,151.75,152.05,b_shop_address||,||t_shop_name,' . $_LANG['lable_box']['shop_name'] . ',259,28,152.65,212.4,b_shop_name||,||t_shop_tel,' . $_LANG['lable_box']['shop_tel'] . ',131,37,138.65,246.5,b_shop_tel||,||t_customer_post,' . $_LANG['lable_box']['customer_post'] . ',104,39,659.2,242.2,b_customer_post||,||t_customer_tel,' . $_LANG['lable_box']['customer_tel'] . ',158,22,461.9,241.9,b_customer_tel||,||t_customer_mobel,' . $_LANG['lable_box']['customer_mobel'] . ',159,21,463.25,265.4,b_customer_mobel||,||t_customer_name,' . $_LANG['lable_box']['customer_name'] . ',109,32,498.9,115.8,b_customer_name||,||t_customer_address,' . $_LANG['lable_box']['customer_address'] . ',264,58,499.6,150.1,b_customer_address||,||t_months,' . $_LANG['lable_box']['months'] . ',35,23,135.85,392.8,b_months||,||t_day,' . $_LANG['lable_box']['day'] . ',24,23,180.1,392.8,b_day||,||';
	return NULL;
}

?>
