<?php
//dezend by  QQ:2172298892
define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$b_id = (!empty($_GET['b_id']) ? intval($_GET['b_id']) : 0);

if ($b_id <= 0) {
	exit();
}

$brands_array = assign_brand_goods($b_id);
$brands_array['brand']['name'] = encode_output($brands_array['brand']['name']);
$smarty->assign('brands_array', $brands_array);
$num = count($brands_array['goods']);

if (0 < $num) {
	$page_num = '10';
	$page = (!empty($_GET['page']) ? intval($_GET['page']) : 1);
	$pages = ceil($num / $page_num);

	if ($page <= 0) {
		$page = 1;
	}

	if ($pages == 0) {
		$pages = 1;
	}

	if ($pages < $page) {
		$page = $pages;
	}

	$i = 1;

	foreach ($brands_array['goods'] as $goods_data) {
		if ((($page_num * ($page - 1)) < $i) && ($i <= $page_num * $page)) {
			$price = (empty($goods_info['promote_price_org']) ? $goods_data['shop_price'] : $goods_data['promote_price']);
			$data[] = array('i' => $i, 'price' => encode_output($price), 'id' => $goods_data['id'], 'name' => encode_output($goods_data['name']));
		}

		$i++;
	}

	$smarty->assign('goods_data', $data);
	$pagebar = get_wap_pager($num, $page_num, $page, 'brands.php?b_id=' . $b_id, 'page');
	$smarty->assign('pagebar', $pagebar);
}

$brands_array = get_brands();

if (1 < count($brands_array)) {
	foreach ($brands_array as $key => $brands_data) {
		$brands_array[$key]['brand_name'] = encode_output($brands_data['brand_name']);
	}

	$smarty->assign('brand_id', $b_id);
	$smarty->assign('other_brands', $brands_array);
}

$smarty->assign('footer', get_footer());
$smarty->display('brands.wml');

?>
