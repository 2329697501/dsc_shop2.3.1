<?php
//dezend by  QQ:2172298892
function get_brand_logo($img)
{
	$img = (empty($img) ? '../' . c('no_picture') : '../data/brandlogo/' . $img);
	return $img;
}

function get_brand_background($img)
{
	$img = (empty($img) ? '../' . c('no_picture') : '../data/brandlogo/' . $img);
	return $img;
}

function get_brands_letter($app = 'brand', $size, $page)
{
	$start = ($page - 1) * $size;
	$sql = 'SELECT * FROM {pre}brand WHERE is_show = 1 GROUP BY brand_id , sort_order  LIMIT ' . $start . ' , ' . $size;
	$res = $GLOBALS['db']->query($sql);
	$arr = array();

	foreach ($res as $row) {
		$brand['brand_id'] = $row['brand_id'];
		$brand['brand_name'] = trim($row['brand_name']);
		$brand['url'] = u('brand/index/goods_list', array('id' => $row['brand_id']));
		$brand['brand_logo'] = get_image_path('data/brandlogo/' . $row['brand_logo']);
		$brand['brand_banner'] = get_banner_path($row['brand_banner']);
		$brand['goods_num'] = goods_count_by_brand($row['brand_id']);
		$brand['brand_desc'] = htmlspecialchars($row['brand_desc'], ENT_QUOTES);
		$first = getletter($brand['brand_name']);
		$arr[$first]['info'] = $first ? $first : 'A';
		$arr[$first]['list'][] = $brand;
	}

	ksort($arr);
	$arr[] = array();
	return $arr;
}

function getLetter($str)
{
	$i = 0;

	while ($i < strlen($str)) {
		$tmp = bin2hex(substr($str, $i, 1));

		if ('B0' <= $tmp) {
			$object = new \libraries\Pinyin();
			$pyobj = $object->output($str);
			$pinyin = (isset($pyobj[0]) ? $pyobj[0] : '');
			return strtoupper(substr($pinyin, 0, 1));
			$i += 2;
		}
		else {
			return strtoupper(substr($str, $i, 1));
			$i++;
		}
	}
}

function goods_count_by_brand($brand_id, $cate = 0)
{
	$sql = 'SELECT COUNT(*) FROM {pre}goods AS g ' . 'WHERE brand_id = \'' . $brand_id . '\' AND g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0';

	if (0 < $cate) {
		$sql .= ' AND ' . get_children($cate);
	}

	return $GLOBALS['db']->getOne($sql);
}

function get_banner_path($img)
{
	if (IS_ECSHOP) {
		$img = (empty($img) ? c('no_picture') : $img);
	}
	else {
		$img = (empty($img) ? c('no_picture') : __ROOT__ . '/data/attached/brandbanner/' . $img);
	}

	return $img;
}

function brand_recommend_goods($type, $brand, $cat = 0, $warehouse_id = 0, $area_id = 0, $act = '')
{
	static $result;
	$time = gmtime();

	if ($result === NULL) {
		if (0 < $cat) {
			$cat_where = 'AND ' . get_children($cat);
		}
		else {
			$cat_where = '';
		}

		$leftJoin = '';

		if ($GLOBALS['_CFG']['open_area_goods'] == 1) {
			$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('link_area_goods') . ' as lag on g.goods_id = lag.goods_id ';
			$cat_where .= ' and lag.region_id = \'' . $area_id . '\' ';
		}

		$shop_price = 'wg.warehouse_price, wg.warehouse_promote_price, wag.region_price, wag.region_promote_price, g.model_price, g.model_attr, ';
		$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('warehouse_goods') . ' as wg on g.goods_id = wg.goods_id and wg.region_id = \'' . $warehouse_id . '\' ';
		$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('warehouse_area_goods') . ' as wag on g.goods_id = wag.goods_id and wag.region_id = \'' . $area_id . '\' ';

		if ($GLOBALS['_CFG']['review_goods'] == 1) {
			$cate_where .= ' AND g.review_status > 2 ';
		}

		$leftJoin .= 'LEFT JOIN ' . $GLOBALS['ecs']->table('link_brand') . ' AS lb ' . 'ON lb.bid = g.brand_id ';
		$sql = 'SELECT g.goods_id, g.goods_name, g.market_price, g.comments_number,g.sales_volume, ' . 'IF(g.model_price < 1, g.shop_price, IF(g.model_price < 2, wg.warehouse_price, wag.region_price)) AS org_price, ' . 'IF(g.model_price < 1, g.promote_price, IF(g.model_price < 2, wg.warehouse_promote_price, wag.region_promote_price)) as promote_price, ' . 'IFNULL(mp.user_price, IF(g.model_price < 1, g.shop_price, IF(g.model_price < 2, wg.warehouse_price, wag.region_price)) * \'' . $_SESSION['discount'] . '\') AS shop_price, ' . 'promote_start_date, promote_end_date, g.goods_brief, g.goods_thumb, goods_img, ' . 'g.is_best, g.is_new, g.is_hot, g.is_promote ' . 'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' . $leftJoin . 'LEFT JOIN ' . $GLOBALS['ecs']->table('member_price') . ' AS mp ' . 'ON mp.goods_id = g.goods_id AND mp.user_rank = \'' . $_SESSION['user_rank'] . '\' ' . 'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.brand_id = \'' . $brand . '\' AND ' . '(g.is_best = 1 OR (g.is_promote = 1 AND promote_start_date <= \'' . $time . '\' AND ' . 'promote_end_date >= \'' . $time . '\')) ' . $cat_where . 'ORDER BY g.sort_order, g.last_update DESC';
		$result = $GLOBALS['db']->getAll($sql);
	}

	$num = 0;
	$type2lib = array('best' => 'recommend_best', 'new' => 'recommend_new', 'hot' => 'recommend_hot', 'promote' => 'recommend_promotion');
	$num = get_library_number($type2lib[$type]);
	$idx = 0;
	$goods = array();

	foreach ($result as $row) {
		if ($num <= $idx) {
			break;
		}

		if ((($type == 'best') && ($row['is_best'] == 1)) || (($type == 'promote') && ($row['is_promote'] == 1) && ($row['promote_start_date'] <= $time) && ($time <= $row['promote_end_date']))) {
			if (0 < $row['promote_price']) {
				$promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
				$goods[$idx]['promote_price'] = 0 < $promote_price ? price_format($promote_price) : '';
			}
			else {
				$goods[$idx]['promote_price'] = '';
			}

			$goods[$idx]['id'] = $row['goods_id'];
			$goods[$idx]['name'] = $row['goods_name'];
			$goods[$idx]['sales_volume'] = $row['sales_volume'];
			$goods[$idx]['comments_number'] = $row['comments_number'];

			if (0 < $row['market_price']) {
				$discount_arr = get_discount($row['goods_id']);
			}

			$goods[$idx]['zhekou'] = $discount_arr['discount'];
			$goods[$idx]['jiesheng'] = $discount_arr['jiesheng'];
			$goods[$idx]['brief'] = $row['goods_brief'];
			$goods[$idx]['brand_name'] = $row['brand_name'];
			$goods[$idx]['short_style_name'] = 0 < $GLOBALS['_CFG']['goods_name_length'] ? sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
			$goods[$idx]['market_price'] = price_format($row['market_price']);
			$goods[$idx]['shop_price'] = price_format($row['shop_price']);
			$goods[$idx]['thumb'] = get_image_path($row['goods_id'], $row['goods_thumb'], true);
			$goods[$idx]['goods_img'] = get_image_path($row['goods_id'], $row['goods_img']);
			$goods[$idx]['url'] = build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']);
			$idx++;
		}
	}

	return $goods;
}

function brand_get_goods($brand_id, $cate, $size, $page, $sort, $order, $warehouse_id = 0, $area_id = 0, $act = '', $is_ship = '', $price_min, $price_max)
{
	$cate_where = (0 < $cate ? 'AND ' . get_children($cate) : '');
	$leftJoin = '';

	if ($GLOBALS['_CFG']['open_area_goods'] == 1) {
		$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('link_area_goods') . ' as lag on g.goods_id = lag.goods_id ';
		$cate_where .= ' and lag.region_id = \'' . $area_id . '\' ';
	}

	$shop_price = 'wg.warehouse_price, wg.warehouse_promote_price, wag.region_price, wag.region_promote_price, g.model_price, g.model_attr, ';
	$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('warehouse_goods') . ' as wg on g.goods_id = wg.goods_id and wg.region_id = \'' . $warehouse_id . '\' ';
	$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('warehouse_area_goods') . ' as wag on g.goods_id = wag.goods_id and wag.region_id = \'' . $area_id . '\' ';

	if ($GLOBALS['_CFG']['review_goods'] == 1) {
		$cate_where .= ' AND g.review_status > 2 ';
	}

	$tag_where = '';

	if ($is_ship == 'is_shipping') {
		$tag_where .= ' AND g.is_shipping = 1 ';
	}

	if ($price_min) {
		$tag_where .= ' AND g.shop_price >= ' . $price_min . ' ';
	}

	if ($price_max) {
		$tag_where .= ' AND g.shop_price <= ' . $price_max . ' ';
	}

	if ($sort == 'last_update') {
		$sort = 'g.last_update';
	}

	$sql = 'SELECT g.goods_id, g.user_id, g.goods_name, g.market_price, g.is_new,g.is_promote, g.is_best,g.is_hot,g.shop_price AS org_price,g.sales_volume, ' . $shop_price . 'IFNULL(mp.user_price, IF(g.model_price < 1, g.shop_price, IF(g.model_price < 2, wg.warehouse_price, wag.region_price)) * \'' . $_SESSION['discount'] . '\') AS shop_price, ' . 'IF(g.model_price < 1, g.promote_price, IF(g.model_price < 2, wg.warehouse_promote_price, wag.region_promote_price)) as promote_price, ' . 'g.promote_start_date, g.promote_end_date, g.is_promote, g.goods_brief, g.goods_thumb , g.goods_img ' . 'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' . $leftJoin . 'LEFT JOIN ' . $GLOBALS['ecs']->table('member_price') . ' AS mp ' . 'ON mp.goods_id = g.goods_id AND mp.user_rank = \'' . $_SESSION['user_rank'] . '\' ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('link_brand') . ' AS lb ' . 'ON lb.bid = g.brand_id ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('merchants_shop_brand') . ' AS msb ' . 'ON msb.bid = lb.bid ' . 'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND (g.brand_id = \'' . $brand_id . '\' OR (lb.brand_id = \'' . $brand_id . '\' AND g.brand_id = lb.bid AND msb.audit_status = 1)) ' . $cate_where . ' ' . $tag_where . ' ' . 'ORDER BY ' . $sort . ' ' . $order;
	$res = $GLOBALS['db']->selectLimit($sql, $size, ($page - 1) * $size);
	$arr = array();

	foreach ($res as $row) {
		if (0 < $row['promote_price']) {
			$promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
		}
		else {
			$promote_price = 0;
		}

		$price_other = array('market_price' => $row['market_price'], 'org_price' => $row['org_price'], 'shop_price' => $row['shop_price'], 'promote_price' => $promote_price);
		$price_info = get_goods_one_attr_price($row['goods_id'], $warehouse_id, $area_id, $price_other);
		$row = (!empty($row) ? array_merge($row, $price_info) : $row);
		$promote_price = $row['promote_price'];
		$arr[$row['goods_id']]['goods_id'] = $row['goods_id'];

		if ($GLOBALS['display'] == 'grid') {
			$arr[$row['goods_id']]['goods_name'] = 0 < $GLOBALS['_CFG']['goods_name_length'] ? sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
		}
		else {
			$arr[$row['goods_id']]['goods_name'] = $row['goods_name'];
		}

		$arr[$row['goods_id']]['sales_volume'] = $row['sales_volume'];
		$arr[$row['goods_id']]['is_promote'] = $row['is_promote'];
		$arr[$row['goods_id']]['market_price'] = price_format($row['market_price']);
		$arr[$row['goods_id']]['shop_price'] = price_format($row['shop_price']);
		$arr[$row['goods_id']]['promote_price'] = 0 < $promote_price ? price_format($promote_price) : '';
		$arr[$row['goods_id']]['goods_brief'] = $row['goods_brief'];
		$arr[$row['goods_id']]['goods_thumb'] = get_image_path($row['goods_thumb']);
		$arr[$row['goods_id']]['goods_img'] = get_image_path($row['goods_img']);
		$arr[$row['goods_id']]['url'] = build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']);
		$arr[$row['goods_id']]['count'] = selled_count($row['goods_id']);
		$sql = 'select * from ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' where ru_id=\'' . $row['user_id'] . '\'';
		$basic_info = $GLOBALS['db']->getRow($sql);
		$arr[$row['goods_id']]['kf_type'] = $basic_info['kf_type'];
		$arr[$row['goods_id']]['kf_ww'] = $basic_info['kf_ww'];
		$arr[$row['goods_id']]['kf_qq'] = $basic_info['kf_qq'];
		$arr[$row['goods_id']]['rz_shopName'] = get_shop_name($row['user_id'], 1);
		$goods_id = $row['goods_id'];
		$count = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('comment') . ' where id_value =\'' . $goods_id . '\' AND status = 1 AND parent_id = 0');
		$arr[$row['goods_id']]['review_count'] = $count;
		$mc_all = ments_count_all($row['goods_id']);
		$mc_one = ments_count_rank_num($row['goods_id'], 1);
		$mc_two = ments_count_rank_num($row['goods_id'], 2);
		$mc_three = ments_count_rank_num($row['goods_id'], 3);
		$mc_four = ments_count_rank_num($row['goods_id'], 4);
		$mc_five = ments_count_rank_num($row['goods_id'], 5);
		$arr[$row['goods_id']]['zconments'] = get_conments_stars($mc_all, $mc_one, $mc_two, $mc_three, $mc_four, $mc_five);

		if ($row['is_promote'] == 1) {
			$goods_type = 'promote';
		}
		else if ($row['is_new'] == 1) {
			$goods_type = 'new';
		}
		else if ($row['is_hot'] == 1) {
			$goods_type = 'hot';
		}
		else if ($row['is_best'] == 1) {
			$goods_type = 'best';
		}
		else {
			$goods_type = 'ordinary';
		}

		$arr[$row['goods_id']]['firsttype'] = $goods_type;
	}

	return $arr;
}

function brand_get_goods2($type, $brand_id, $cate, $size, $page, $sort, $order, $warehouse_id = 0, $area_id = 0, $act = '', $is_ship = '', $price_min, $price_max)
{
	$cate_where = (0 < $cate ? 'AND ' . get_children($cate) : '');
	$leftJoin = '';

	if ($GLOBALS['_CFG']['open_area_goods'] == 1) {
		$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('link_area_goods') . ' as lag on g.goods_id = lag.goods_id ';
		$cate_where .= ' and lag.region_id = \'' . $area_id . '\' ';
	}

	$shop_price = 'wg.warehouse_price, wg.warehouse_promote_price, wag.region_price, wag.region_promote_price, g.model_price, g.model_attr, ';
	$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('warehouse_goods') . ' as wg on g.goods_id = wg.goods_id and wg.region_id = \'' . $warehouse_id . '\' ';
	$leftJoin .= ' left join ' . $GLOBALS['ecs']->table('warehouse_area_goods') . ' as wag on g.goods_id = wag.goods_id and wag.region_id = \'' . $area_id . '\' ';

	if ($GLOBALS['_CFG']['review_goods'] == 1) {
		$cate_where .= ' AND g.review_status > 2 ';
	}

	$tag_where = '';

	if ($is_ship == 'is_shipping') {
		$tag_where .= ' AND g.is_shipping = 1 ';
	}

	if ($price_min) {
		$tag_where .= ' AND g.shop_price >= ' . $price_min . ' ';
	}

	if ($price_max) {
		$tag_where .= ' AND g.shop_price <= ' . $price_max . ' ';
	}

	if ($sort == 'last_update') {
		$sort = 'g.last_update';
	}

	$type_sql = 'WHERE ';

	switch ($type) {
	case 'promote':
		$type_sql = 'WHERE g.is_promote = 1 AND ';
		break;

	case 'best':
		$type_sql = 'WHERE g.is_best = 1 AND ';
		break;

	case 'hot':
		$type_sql = 'WHERE g.is_hot = 1 AND ';
		break;

	case 'new':
		$type_sql = 'WHERE g.is_new = 1 AND ';
		break;

	case 'ordinary':
		$type_sql = 'WHERE ';
		break;

	default:
		$type_sql = 'WHERE ';
	}

	$sql = 'SELECT g.goods_id, g.user_id, g.goods_name, g.market_price, g.is_new,g.is_promote, g.is_best,g.is_hot,g.shop_price AS org_price,g.sales_volume, ' . $shop_price . 'IFNULL(mp.user_price, IF(g.model_price < 1, g.shop_price, IF(g.model_price < 2, wg.warehouse_price, wag.region_price)) * \'' . $_SESSION['discount'] . '\') AS shop_price, ' . 'IF(g.model_price < 1, g.promote_price, IF(g.model_price < 2, wg.warehouse_promote_price, wag.region_promote_price)) as promote_price, ' . 'g.promote_start_date, g.promote_end_date, g.is_promote, g.goods_brief, g.goods_thumb , g.goods_img ' . 'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g ' . $leftJoin . 'LEFT JOIN ' . $GLOBALS['ecs']->table('member_price') . ' AS mp ' . 'ON mp.goods_id = g.goods_id AND mp.user_rank = \'' . $_SESSION['user_rank'] . '\' ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('link_brand') . ' AS lb ' . 'ON lb.bid = g.brand_id ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('merchants_shop_brand') . ' AS msb ' . 'ON msb.bid = lb.bid ' . $type_sql . 'g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND (g.brand_id = \'' . $brand_id . '\' OR (lb.brand_id = \'' . $brand_id . '\' AND g.brand_id = lb.bid AND msb.audit_status = 1)) ' . $cate_where . ' ' . $tag_where . ' ' . 'ORDER BY ' . $sort . ' ' . $order;
	$total_query = $GLOBALS['db']->query($sql);
	$total = (is_array($total_query) ? count($total_query) : 0);
	$res = $GLOBALS['db']->selectLimit($sql, $size, ($page - 1) * $size);
	$arr = array();

	foreach ($res as $row) {
		if (0 < $row['promote_price']) {
			$promote_price = bargain_price($row['promote_price'], $row['promote_start_date'], $row['promote_end_date']);
		}
		else {
			$promote_price = 0;
		}

		$price_other = array('market_price' => $row['market_price'], 'org_price' => $row['org_price'], 'shop_price' => $row['shop_price'], 'promote_price' => $promote_price);
		$price_info = get_goods_one_attr_price($row['goods_id'], $warehouse_id, $area_id, $price_other);
		$row = (!empty($row) ? array_merge($row, $price_info) : $row);
		$promote_price = $row['promote_price'];
		$arr[$row['goods_id']]['goods_id'] = $row['goods_id'];

		if ($GLOBALS['display'] == 'grid') {
			$arr[$row['goods_id']]['goods_name'] = 0 < $GLOBALS['_CFG']['goods_name_length'] ? sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
		}
		else {
			$arr[$row['goods_id']]['goods_name'] = $row['goods_name'];
		}

		$arr[$row['goods_id']]['sales_volume'] = $row['sales_volume'];
		$arr[$row['goods_id']]['is_promote'] = $row['is_promote'];
		$arr[$row['goods_id']]['market_price'] = price_format($row['market_price']);
		$arr[$row['goods_id']]['shop_price'] = price_format($row['shop_price']);
		$arr[$row['goods_id']]['promote_price'] = 0 < $promote_price ? price_format($promote_price) : '';
		$arr[$row['goods_id']]['goods_brief'] = $row['goods_brief'];
		$arr[$row['goods_id']]['goods_thumb'] = get_image_path($row['goods_thumb']);
		$arr[$row['goods_id']]['goods_img'] = get_image_path($row['goods_id'], $row['goods_img']);
		$arr[$row['goods_id']]['url'] = build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']);
		$arr[$row['goods_id']]['count'] = selled_count($row['goods_id']);
		$sql = 'select * from ' . $GLOBALS['ecs']->table('seller_shopinfo') . ' where ru_id=\'' . $row['user_id'] . '\'';
		$basic_info = $GLOBALS['db']->getRow($sql);
		$arr[$row['goods_id']]['kf_type'] = $basic_info['kf_type'];
		$arr[$row['goods_id']]['kf_ww'] = $basic_info['kf_ww'];
		$arr[$row['goods_id']]['kf_qq'] = $basic_info['kf_qq'];
		$arr[$row['goods_id']]['rz_shopName'] = get_shop_name($row['user_id'], 1);
		$goods_id = $row['goods_id'];
		$count = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('comment') . ' where id_value =\'' . $goods_id . '\' AND status = 1 AND parent_id = 0');
		$arr[$row['goods_id']]['review_count'] = $count;
		$mc_all = ments_count_all($row['goods_id']);
		$mc_one = ments_count_rank_num($row['goods_id'], 1);
		$mc_two = ments_count_rank_num($row['goods_id'], 2);
		$mc_three = ments_count_rank_num($row['goods_id'], 3);
		$mc_four = ments_count_rank_num($row['goods_id'], 4);
		$mc_five = ments_count_rank_num($row['goods_id'], 5);
		$arr[$row['goods_id']]['zconments'] = get_conments_stars($mc_all, $mc_one, $mc_two, $mc_three, $mc_four, $mc_five);

		if ($row['is_promote'] == 1) {
			$goods_type = 'promote';
		}
		else if ($row['is_new'] == 1) {
			$goods_type = 'new';
		}
		else if ($row['is_hot'] == 1) {
			$goods_type = 'hot';
		}
		else if ($row['is_best'] == 1) {
			$goods_type = 'best';
		}
		else {
			$goods_type = 'ordinary';
		}

		$arr[$row['goods_id']]['firsttype'] = $goods_type;
	}

	return array('list' => array_values($arr), 'totalpage' => ceil($total / $size));
}


?>
