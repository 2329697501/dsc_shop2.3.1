<?php
//dezend by  QQ:2172298892
namespace http\presale\controllers;

class IndexController extends \http\base\controllers\FrontendController
{
	private $user_id = 0;
	private $region_id = 0;
	private $preid = 0;
	private $area_info = array();

	public function __construct()
	{
		parent::__construct();
		isset($_SESSION['user_id']) && $this->user_id = $_SESSION['user_id'];
		$this->init_params();
	}

	public function actionIndex()
	{
		$this->assign('pre_nav_list', get_pre_nav());
		$pre_goods = get_pre_cat();
		$this->assign('pre_cat_goods', $pre_goods);
		$this->assign('pre_list_url', u('presale/index/list'));
		$this->assign('pre_new_url', u('presale/index/new'));
		$this->assign('page_title', '预售频道');
		$this->display('presale');
	}

	public function actionList()
	{
		$page = i('request.page', 1, 'intval');
		$size = 10;

		if (IS_AJAX) {
			$default_sort_order_method = (c('shop.sort_order_method') == '0' ? 'DESC' : 'ASC');
			$default_sort_order_type = (c('shop.sort_order_type') == '0' ? 'act_id' : (c('shop.sort_order_type') == '1' ? 'shop_price' : 'start_time'));
			$sort = (isset($_REQUEST['sort']) && in_array(trim(strtolower(i('sort'))), array('shop_price', 'start_time', 'act_id')) ? i('sort', '', 'trim') : $default_sort_order_type);
			$order = (isset($_REQUEST['order']) && in_array(trim(strtoupper(i('order'))), array('ASC', 'DESC')) ? i('order', '', 'trim') : $default_sort_order_method);
			$cid = json_str_iconv(i('cid', 0));
			$status = i('status', 0, 'intval');
			$keyword = compile_str(i('keyword'));
			$pre_goods = $this->get_pre_goods($cid, $status, $sort, $order, $page, $size, $keyword);
			exit(json_encode(array('list' => $pre_goods['list'], 'totalPage' => ceil($pre_goods['total'] / $size))));
		}

		$cid = i('get.id', 0);
		$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('presale_cat') . ' ORDER BY sort_order ASC ';
		$cat_res = $GLOBALS['db']->getAll($sql);
		$page_title = '';

		foreach ($cat_res as $key => $row) {
			if (stristr($cid, $row['cid'])) {
				$cat_res[$key]['selected'] = 1;
				$page_title .= $cat_res[$key]['c_name'];
			}

			$cat_res[$key]['goods'] = get_cat_goods($row['cid'], $row['act_id']);
			$cat_res[$key]['count_goods'] = count(get_cat_goods($row['cid']));
			$cat_res[$key]['cat_url'] = u('presale/index/list');
		}

		$this->assign('pre_cat', $cat_res);
		$this->assign('cid', $cid);
		$this->assign('page_title', $page_title);
		$this->display('presale_list');
	}

	public function actionNew()
	{
		$where = '';
		$cid = json_str_iconv(i('cid', 0));
		$status = (isset($_REQUEST['status']) && (0 < intval($_REQUEST['status'])) ? intval($_REQUEST['status']) : 0);
		$keyword = compile_str(i('keyword'));

		if (0 < $cid) {
			$where .= ' AND a.cid = \'' . $cid . '\' ';
		}

		$now = gmtime();

		if ($status == 1) {
			$where .= ' AND a.start_time > ' . $now . ' ';
		}
		else if ($status == 2) {
			$where .= ' AND a.start_time < ' . $now . ' AND ' . $now . ' < a.end_time ';
		}
		else if ($status == 3) {
			$where .= ' AND ' . $now . ' > a.end_time ';
		}

		if ($keyword) {
			$where .= ' AND g.goods_name like \'%' . $keyword . '%\' ';
		}

		$sql = 'SELECT a.*, g.goods_thumb, g.goods_img, g.goods_name, g.shop_price, g.market_price, g.sales_volume FROM ' . $GLOBALS['ecs']->table('presale_activity') . ' AS a' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('goods') . ' AS g ON a.goods_id = g.goods_id ' . ' WHERE g.goods_id > 0 ' . $where . ' AND g.is_on_sale = 0 ORDER BY a.end_time DESC,a.start_time DESC ';
		$res = $GLOBALS['db']->getAll($sql);

		foreach ($res as $key => $row) {
			$res[$key]['thumb'] = get_image_path($row['goods_thumb']);
			$res[$key]['goods_img'] = get_image_path($row['goods_img']);
			$res[$key]['url'] = build_uri('presale', array('r' => 'index/detail', 'id' => $row['act_id']));
			$res[$key]['end_time_day'] = local_date('Y-m-d', $row['end_time']);

			if ($now <= $row['start_time']) {
				$res[$key]['no_start'] = 1;
				$res[$key]['short_format_date'] = short_format_date($row['start_time']);
			}
			else if ($row['end_time'] < $now) {
				$res[$key]['no_start'] = 3;
			}
			else {
				$res[$key]['short_format_date'] = short_format_date($row['end_time']);
			}
		}

		$date_array = array();

		foreach ($res as $key => $row) {
			$date_array[$row['end_time_day']][] = $row;
		}

		$date_result = array();

		foreach ($date_array as $key => $value) {
			$date_result[]['goods'] = $value;
		}

		foreach ($date_result as $key => $value) {
			$date_result[$key]['end_time_day'] = local_date('Y-m-d', gmstr2time($value['goods'][0]['end_time_day']));
			$date_result[$key]['end_time_y'] = local_date('Y', gmstr2time($value['goods'][0]['end_time_day']));
			$date_result[$key]['end_time_m'] = local_date('m', gmstr2time($value['goods'][0]['end_time_day']));
			$date_result[$key]['end_time_d'] = local_date('d', gmstr2time($value['goods'][0]['end_time_day']));
			$date_result[$key]['count_goods'] = count($value['goods']);
		}

		$this->assign('date_result', $date_result);
		$pre_cat = get_pre_cat();
		$this->assign('pre_cat', $pre_cat);
		$this->assign('page_title', '预售新品');
		$this->display('presale_new');
	}

	public function actionDetail()
	{
		$this->preid = i('id');

		if ($this->preid <= 0) {
			ecs_header("Location: ./\n");
		}

		$presale = presale_info($this->preid, 1, array(), $this->region_id, $this->area_info['region_id']);

		if (empty($presale)) {
			ecs_header("Location: ./\n");
			exit();
		}

		$now = gmtime();
		$presale['gmt_end_date'] = local_strtotime($presale['end_time']);
		$presale['gmt_start_date'] = local_strtotime($presale['start_time']);

		if ($now <= $presale['gmt_start_date']) {
			$presale['no_start'] = 1;
		}

		$this->assign('presale', $presale);
		$this->goods_id = $presale['goods_id'];
		$goods = get_goods_info($this->goods_id, $this->region_id, $this->area_info['region_id']);

		if (empty($goods)) {
			ecs_header("Location: ./\n");
			exit();
		}

		$sql = 'SELECT COUNT(*) as num FROM {pre}order_info WHERE extension_id = \'' . $this->preid . '\'';
		$res = $GLOBALS['db']->getOne($sql);

		if ($res) {
			$goods['sales_volume'] = $res;
		}
		else {
			$goods['sales_volume'] = 0;
		}

		if ($_SESSION['user_id']) {
			$where['user_id'] = $_SESSION['user_id'];
			$where['goods_id'] = $this->goods_id;
			$rs = $this->db->table('collect_goods')->where($where)->count();

			if (0 < $rs) {
				$this->assign('goods_collect', 1);
			}
		}

		$this->assign('goods', $goods);
		$this->assign('type', 0);
		$mc_all = ments_count_all($this->goods_id);
		$mc_one = ments_count_rank_num($this->goods_id, 1);
		$mc_two = ments_count_rank_num($this->goods_id, 2);
		$mc_three = ments_count_rank_num($this->goods_id, 3);
		$mc_four = ments_count_rank_num($this->goods_id, 4);
		$mc_five = ments_count_rank_num($this->goods_id, 5);
		$comment_all = get_conments_stars($mc_all, $mc_one, $mc_two, $mc_three, $mc_four, $mc_five);

		if (0 < $goods['user_id']) {
			$merchants_goods_comment = get_merchants_goods_comment($goods['user_id']);
			$this->assign('merch_cmt', $merchants_goods_comment);
		}

		$this->assign('comment_all', $comment_all);
		$good_comment = get_good_comment($this->goods_id, 4, 1, 0, 1);
		$this->assign('good_comment', $good_comment);
		$this->assign('goods_id', $this->goods_id);
		$sql = 'select b.is_IM, a.ru_id,a.province, a.city, a.kf_type, a.kf_ww, a.kf_qq, a.meiqia, a.shop_name, a.kf_appkey from {pre}seller_shopinfo as a left join {pre}merchants_shop_information as b on a.ru_id=b.shop_id where ru_id=\'' . $goods['user_id'] . '\' ';
		$basic_info = $this->db->getRow($sql);
		$info_ww = ($basic_info['kf_ww'] ? explode("\r\n", $basic_info['kf_ww']) : '');
		$info_qq = ($basic_info['kf_qq'] ? explode("\r\n", $basic_info['kf_qq']) : '');
		$kf_ww = ($info_ww ? $info_ww[0] : '');
		$kf_qq = ($info_qq ? $info_qq[0] : '');
		$basic_ww = ($kf_ww ? explode('|', $kf_ww) : '');
		$basic_qq = ($kf_qq ? explode('|', $kf_qq) : '');
		$basic_info['kf_ww'] = $basic_ww ? $basic_ww[1] : '';
		$basic_info['kf_qq'] = $basic_qq ? $basic_qq[1] : '';
		if ((($basic_info['is_IM'] == 1) || ($basic_info['ru_id'] == 0)) && !empty($basic_info['kf_appkey'])) {
			$basic_info['kf_appkey'] = $basic_info['kf_appkey'];
		}
		else {
			$basic_info['kf_appkey'] = '';
		}

		$basic_date = array('region_name');
		$basic_info['province'] = get_table_date('region', 'region_id = \'' . $basic_info['province'] . '\'', $basic_date, 2);
		$basic_info['city'] = get_table_date('region', 'region_id= \'' . $basic_info['city'] . '\'', $basic_date, 2) . '市';
		$this->assign('basic_info', $basic_info);
		$properties = get_goods_properties($this->goods_id, $this->region_id, $this->area_info['region_id']);
		$this->assign('properties', $properties['pro']);
		$default_spe = '';

		if ($properties['spe']) {
			foreach ($properties['spe'] as $k => $v) {
				if ($v['attr_type'] == 1) {
					if (0 < $v['is_checked']) {
						foreach ($v['values'] as $key => $val) {
							$default_spe .= ($val['checked'] ? $val['label'] . '、' : '');
						}
					}
					else {
						foreach ($v['values'] as $key => $val) {
							if ($key == 0) {
								$default_spe .= $val['label'] . '、';
							}
						}
					}
				}
			}
		}

		$this->assign('default_spe', $default_spe);
		$this->assign('specification', $properties['spe']);
		$sql = 'SELECT * FROM {pre}goods_gallery WHERE goods_id = ' . $this->goods_id;
		$goods_img = $this->db->query($sql);

		foreach ($goods_img as $key => $val) {
			$goods_img[$key]['img_url'] = get_image_path($val['img_url']);
		}

		$this->assign('goods_img', $goods_img);
		$this->assign('province_row', get_region_name($this->province_id));
		$this->assign('city_row', get_region_name($this->city_id));
		$this->assign('district_row', get_region_name($this->district_id));
		$goods_region['country'] = 1;
		$goods_region['province'] = $this->province_id;
		$goods_region['city'] = $this->city_id;
		$goods_region['district'] = $this->district_id;
		$this->assign('goods_region', $goods_region);
		$this->assign('best_goods', get_recommend_goods('best', '', $this->region_id, $this->area_info['region_id'], $goods['user_id'], 1, 'presale'));
		$this->assign('new_goods', get_recommend_goods('new', '', $this->region_id, $this->area_info['region_id'], $goods['user_id'], 1, 'presale'));
		$this->assign('hot_goods', get_recommend_goods('hot', '', $this->region_id, $this->area_info['region_id'], $goods['user_id'], 1, 'presale'));
		$shop_info = get_merchants_shop_info('merchants_steps_fields', $goods['user_id']);
		$adress = get_license_comp_adress($shop_info['license_comp_adress']);
		$this->assign('shop_info', $shop_info);
		$this->assign('adress', $adress);
		$province_list = get_warehouse_province();
		$this->assign('province_list', $province_list);
		$city_list = get_region_city_county($this->province_id);

		if ($city_list) {
			foreach ($city_list as $k => $v) {
				$city_list[$k]['district_list'] = get_region_city_county($v['region_id']);
			}
		}

		$this->assign('city_list', $city_list);
		$district_list = get_region_city_county($this->city_id);
		$this->assign('district_list', $district_list);
		$this->assign('goods_id', $this->goods_id);
		$warehouse_list = get_warehouse_list_goods();
		$this->assign('warehouse_list', $warehouse_list);
		$warehouse_name = get_warehouse_name_id($this->region_id);
		$this->assign('warehouse_name', $warehouse_name);
		$this->assign('region_id', $this->region_id);
		$this->assign('user_id', $_SESSION['user_id']);
		$this->assign('shop_price_type', $goods['model_price']);
		$this->assign('area_id', $this->area_info['region_id']);
		$area = array('region_id' => $this->region_id, 'province_id' => $this->province_id, 'city_id' => $this->city_id, 'district_id' => $this->district_id, 'goods_id' => $this->goods_id, 'user_id' => $_SESSION['user_id'], 'area_id' => $this->area_info['region_id'], 'merchant_id' => $goods['user_id']);
		$this->assign('area', $area);
		$properties = get_goods_properties($this->goods_id);
		$this->assign('properties', $properties['pro']);
		$this->assign('specification', $properties['spe']);
		$this->assign('cfg', c('shop'));
		$position = assign_ur_here(0, $goods['goods_name']);
		$this->assign('page_title', $position['title']);
		$this->display('presale_details');
	}

	public function actionPrice()
	{
		$res = array('err_msg' => '', 'err_no' => 0, 'result' => '', 'qty' => 1);
		$attr = i('attr');
		$number = i('number', 1, 'intval');
		$this->goods_id = isset($_REQUEST['gid']) ? intval($_REQUEST['gid']) : 0;
		$this->preid = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
		$attr_id = (!empty($attr) ? explode(',', $attr) : array());
		$warehouse_id = i('request.warehouse_id', 0, 'intval');
		$area_id = i('request.area_id', 0, 'intval');
		$onload = i('request.onload', '', 'trim');
		$goods = get_goods_info($this->goods_id, $warehouse_id, $area_id);

		if ($this->goods_id == 0) {
			$res['err_msg'] = l('err_change_attr');
			$res['err_no'] = 1;
		}
		else {
			if ($number == 0) {
				$res['qty'] = $number = 1;
			}
			else {
				$res['qty'] = $number;
			}

			$products = get_warehouse_id_attr_number($this->goods_id, $_REQUEST['attr'], $goods['user_id'], $warehouse_id, $area_id);
			$attr_number = $products['product_number'];

			if ($goods['model_attr'] == 1) {
				$table_products = 'products_warehouse';
				$type_files = ' and warehouse_id = \'' . $warehouse_id . '\'';
			}
			else if ($goods['model_attr'] == 2) {
				$table_products = 'products_area';
				$type_files = ' and area_id = \'' . $area_id . '\'';
			}
			else {
				$table_products = 'products';
				$type_files = '';
			}

			$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table($table_products) . ' WHERE goods_id = \'' . $this->goods_id . '\'' . $type_files . ' LIMIT 0, 1';
			$prod = $GLOBALS['db']->getRow($sql);

			if ($goods['goods_type'] == 0) {
				$attr_number = $goods['goods_number'];
			}
			else if (empty($prod)) {
				$attr_number = $goods['goods_number'];
			}

			if (empty($prod)) {
				$res['bar_code'] = $goods['bar_code'];
			}
			else {
				$res['bar_code'] = $products['bar_code'];
			}

			$attr_number = (!empty($attr_number) ? $attr_number : 0);
			$res['attr_number'] = $attr_number;
			$shop_price = get_final_price($this->goods_id, $number, true, $attr_id, $warehouse_id, $area_id, 0, 1);
			$res['shop_price'] = price_format($shop_price);
			$res['market_price'] = $goods['market_price'];
			$spec_price = get_final_price($this->goods_id, $number, true, $attr_id, $warehouse_id, $area_id, 1, 1);
			$res['marketPrice_amount'] = price_format($spec_price + $goods['marketPrice']);
			$martetprice_amount = $spec_price + $goods['marketPrice'];
			$res['discount'] = round($shop_price / $martetprice_amount, 2) * 10;
			$res['result'] = price_format($shop_price * $number);
			$presale = presale_info($this->preid, $number, $attr_id, $warehouse_id, $area_id);
			$res['formated_deposit'] = $presale['formated_deposit'];
			$res['formated_final_payment'] = $presale['formated_final_payment'];
			$attr_info = get_attr_value($this->goods_id, $attr_id[0]);

			if (!empty($attr_info['attr_img_flie'])) {
				$res['attr_img'] = get_image_path($attr_info['attr_img_flie']);
			}
		}

		exit(json_encode($res));
	}

	public function actionBuy()
	{
		$this->check_login();
		$warehouse_id = i('request.warehouse_id', 0, 'intval');
		$this->area_id = isset($_REQUEST['area_id']) ? intval($_REQUEST['area_id']) : 0;
		$this->preid = i('request.presale_id', 0, 'intval');

		if ($this->preid <= 0) {
			ecs_header("Location: ./\n");
			exit();
		}

		$number = (isset($_POST['number']) ? intval($_POST['number']) : 1);
		$number = ($number < 1 ? 1 : $number);
		$presale = presale_info($this->preid, $number, $_specs, $this->region_id, $this->area_info['region_id']);

		if (empty($presale)) {
			ecs_header("Location: ./\n");
			exit();
		}

		if ($presale['status'] != GBS_UNDER_WAY) {
			show_message(l('presale_error_status'), '', '', 'error');
		}

		$goods = goods_info($presale['goods_id'], $warehouse_id, $this->area_id);

		if (empty($goods)) {
			ecs_header("Location: ./\n");
			exit();
		}

		if ((0 < $goods['goods_number']) && (($goods['goods_number'] - $presale['valid_goods']) < $number)) {
			show_message(l('gb_error_goods_lacking'), '', '', 'error');
		}

		$specs = (isset($_POST['goods_spec']) ? htmlspecialchars(trim($_POST['goods_spec'])) : '');

		if ($specs) {
			$_specs = explode(',', $specs);
			$product_info = get_products_info($goods['goods_id'], $_specs, $warehouse_id, $this->area_id);
		}

		empty($product_info) ? $product_info = array('product_number' => 0, 'product_id' => 0) : '';

		if ($goods['model_attr'] == 1) {
			$table_products = 'products_warehouse';
			$type_files = ' and warehouse_id = \'' . $warehouse_id . '\'';
		}
		else if ($goods['model_attr'] == 2) {
			$table_products = 'products_area';
			$type_files = ' and area_id = \'' . $this->area_id . '\'';
		}
		else {
			$table_products = 'products';
			$type_files = '';
		}

		$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table($table_products) . ' WHERE goods_id = \'' . $goods['goods_id'] . '\'' . $type_files . ' LIMIT 0, 1';
		$prod = $GLOBALS['db']->getRow($sql);

		if ($GLOBALS['_CFG']['use_storage'] == 1) {
			if ($prod && ($product_info['product_number'] < $number)) {
				show_message(l('gb_error_goods_lacking'), '', '', 'error');
			}
			else if ($goods['goods_number'] < $number) {
				show_message(l('gb_error_goods_lacking'), '', '', 'error');
			}
		}

		$attr_list = array();
		$sql = 'SELECT a.attr_name, g.attr_value ' . 'FROM ' . $GLOBALS['ecs']->table('goods_attr') . ' AS g, ' . $GLOBALS['ecs']->table('attribute') . ' AS a ' . 'WHERE g.attr_id = a.attr_id ' . 'AND g.goods_attr_id ' . db_create_in($specs);
		$res = $GLOBALS['db']->query($sql);

		foreach ($res as $row) {
			$attr_list[] = $row['attr_name'] . ': ' . $row['attr_value'];
		}

		$goods_attr = join(chr(13) . chr(10), $attr_list);
		clear_cart(CART_PRESALE_GOODS);
		$area_info = get_area_info($this->province_id);
		$this->area_id = $area_info['region_id'];
		$where = 'regionId = \'' . $this->province_id . '\'';
		$date = array('parent_id');
		$this->region_id = get_table_date('region_warehouse', $where, $date, 2);

		if (!empty($_SESSION['user_id'])) {
			$sess = '';
		}
		else {
			$sess = real_cart_mac_ip();
		}

		$cart = array('user_id' => $_SESSION['user_id'], 'session_id' => $sess, 'goods_id' => $presale['goods_id'], 'product_id' => $product_info['product_id'], 'goods_sn' => addslashes($goods['goods_sn']), 'goods_name' => addslashes($goods['goods_name']), 'market_price' => $goods['market_price'], 'goods_price' => $goods['shop_price'], 'goods_number' => $number, 'goods_attr' => addslashes($goods_attr), 'goods_attr_id' => $specs, 'ru_id' => $goods['user_id'], 'warehouse_id' => $this->region_id, 'area_id' => $this->area_id, 'is_real' => $goods['is_real'], 'extension_code' => 'presale', 'parent_id' => 0, 'rec_type' => CART_PRESALE_GOODS, 'is_gift' => 0);
		$this->db->autoExecute($GLOBALS['ecs']->table('cart'), $cart, 'INSERT');
		$_SESSION['flow_type'] = CART_PRESALE_GOODS;
		$_SESSION['extension_code'] = 'presale';
		$_SESSION['cart_value'] = '';
		$_SESSION['extension_id'] = $presale['act_id'];
		$_SESSION['browse_trace'] = 'presale';
		$this->redirect(u('flow/index/index'));
		exit();
	}

	private function check_login()
	{
		if (!(0 < $_SESSION['user_id'])) {
			$url = urlencode(__HOST__ . $_SERVER['REQUEST_URI']);

			if (IS_POST) {
				$url = urlencode($_SERVER['HTTP_REFERER']);
			}

			ecs_header('Location: ' . u('user/login/index', array('back_act' => $url)));
			exit();
		}
	}

	private function init_params()
	{
		if (!isset($_COOKIE['province'])) {
			$area_array = get_ip_area_name();

			if ($area_array['county_level'] == 2) {
				$date = array('region_id', 'parent_id', 'region_name');
				$where = 'region_name = \'' . $area_array['area_name'] . '\' AND region_type = 2';
				$city_info = get_table_date('region', $where, $date, 1);
				$date = array('region_id', 'region_name');
				$where = 'region_id = \'' . $city_info[0]['parent_id'] . '\'';
				$province_info = get_table_date('region', $where, $date);
				$where = 'parent_id = \'' . $city_info[0]['region_id'] . '\' order by region_id asc limit 0, 1';
				$district_info = get_table_date('region', $where, $date, 1);
			}
			else if ($area_array['county_level'] == 1) {
				$area_name = $area_array['area_name'];
				$date = array('region_id', 'region_name');
				$where = 'region_name = \'' . $area_name . '\'';
				$province_info = get_table_date('region', $where, $date);
				$where = 'parent_id = \'' . $province_info['region_id'] . '\' order by region_id asc limit 0, 1';
				$city_info = get_table_date('region', $where, $date, 1);
				$where = 'parent_id = \'' . $city_info[0]['region_id'] . '\' order by region_id asc limit 0, 1';
				$district_info = get_table_date('region', $where, $date, 1);
			}
		}

		$order_area = get_user_order_area($this->user_id);
		$user_area = get_user_area_reg($this->user_id);
		if ($order_area['province'] && (0 < $this->user_id)) {
			$this->province_id = $order_area['province'];
			$this->city_id = $order_area['city'];
			$this->district_id = $order_area['district'];
		}
		else {
			if (0 < $user_area['province']) {
				$this->province_id = $user_area['province'];
				setcookie('province', $user_area['province'], gmtime() + (3600 * 24 * 30));
				$this->region_id = get_province_id_warehouse($this->province_id);
			}
			else {
				$sql = 'select region_name from ' . $this->ecs->table('region_warehouse') . ' where regionId = \'' . $province_info['region_id'] . '\'';
				$warehouse_name = $this->db->getOne($sql);
				$this->province_id = $province_info['region_id'];
				$cangku_name = $warehouse_name;
				$this->region_id = get_warehouse_name_id(0, $cangku_name);
			}

			if (0 < $user_area['city']) {
				$this->city_id = $user_area['city'];
				setcookie('city', $user_area['city'], gmtime() + (3600 * 24 * 30));
			}
			else {
				$this->city_id = $city_info[0]['region_id'];
			}

			if (0 < $user_area['district']) {
				$this->district_id = $user_area['district'];
				setcookie('district', $user_area['district'], gmtime() + (3600 * 24 * 30));
			}
			else {
				$this->district_id = $district_info[0]['region_id'];
			}
		}

		$this->province_id = isset($_COOKIE['province']) ? $_COOKIE['province'] : $this->province_id;
		$child_num = get_region_child_num($this->province_id);

		if (0 < $child_num) {
			$this->city_id = isset($_COOKIE['city']) ? $_COOKIE['city'] : $this->city_id;
		}
		else {
			$this->city_id = '';
		}

		$child_num = get_region_child_num($this->city_id);

		if (0 < $child_num) {
			$this->district_id = isset($_COOKIE['district']) ? $_COOKIE['district'] : $this->district_id;
		}
		else {
			$this->district_id = '';
		}

		$this->region_id = !isset($_COOKIE['region_id']) ? $this->region_id : $_COOKIE['region_id'];
		$goods_warehouse = get_warehouse_goods_region($this->province_id);

		if ($goods_warehouse) {
			$this->regionId = $goods_warehouse['region_id'];
			if ($_COOKIE['region_id'] && $_COOKIE['regionId']) {
				$gw = 0;
			}
			else {
				$gw = 1;
			}
		}

		if ($gw) {
			$this->region_id = $this->regionId;
			setcookie('area_region', $this->region_id, gmtime() + (3600 * 24 * 30));
		}

		setcookie('goodsId', $this->goods_id, gmtime() + (3600 * 24 * 30));
		$sellerInfo = get_seller_info_area();

		if (empty($this->province_id)) {
			$this->province_id = $sellerInfo['province'];
			$this->city_id = $sellerInfo['city'];
			$this->district_id = 0;
			setcookie('province', $this->province_id, gmtime() + (3600 * 24 * 30));
			setcookie('city', $this->city_id, gmtime() + (3600 * 24 * 30));
			setcookie('district', $this->district_id, gmtime() + (3600 * 24 * 30));
			$this->region_id = get_warehouse_goods_region($this->province_id);
		}

		$this->area_info = get_area_info($this->province_id);
	}

	private function get_pre_goods($cid, $status = 0, $sort = 'act_id', $order = 'DESC', $page = 1, $size = 10, $keyword = '')
	{
		$now = gmtime();
		$where = '';

		if (0 < $cid) {
			$where = 'AND a.cid = \'' . $cid . '\' ';
		}

		if ($status == 1) {
			$where .= ' AND a.start_time > ' . $now . ' ';
		}
		else if ($status == 2) {
			$where .= ' AND a.start_time < ' . $now . ' AND ' . $now . ' < a.end_time ';
		}
		else if ($status == 3) {
			$where .= ' AND ' . $now . ' > a.end_time ';
		}

		if ($sort == 'shop_price') {
			$sort = 'g.' . $sort;
		}
		else {
			$sort = 'a.' . $sort;
		}

		if ($keyword) {
			$where .= ' AND g.goods_name like \'%' . $keyword . '%\' ';
		}

		$sql = 'SELECT COUNT(*) as total FROM ' . $GLOBALS['ecs']->table('presale_activity') . ' AS a ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('goods') . ' AS g ON a.goods_id = g.goods_id ' . ' WHERE g.goods_id > 0 AND g.is_on_sale = 0 ' . $where;
		$total = $GLOBALS['db']->getOne($sql);
		$total ? $total : 0;
		$sql = 'SELECT a.*, g.goods_thumb, g.goods_img, g.goods_name, g.shop_price, g.market_price, g.sales_volume FROM ' . $GLOBALS['ecs']->table('presale_activity') . ' AS a ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('goods') . ' AS g ON a.goods_id = g.goods_id ' . ' WHERE g.goods_id > 0 ' . $where . ' AND g.is_on_sale = 0 ORDER BY ' . $sort . ' ' . $order . ' LIMIT ' . (($page - 1) * $size) . ',  ' . $size;
		$res = $GLOBALS['db']->getAll($sql);

		foreach ($res as $key => $row) {
			$res[$key]['thumb'] = get_image_path($row['goods_thumb']);
			$res[$key]['goods_img'] = get_image_path($row['goods_img']);
			$res[$key]['url'] = build_uri('presale', array('r' => 'index/detail', 'id' => $row['act_id']));

			if ($now <= $row['start_time']) {
				$res[$key]['status'] = 1;
				$res[$key]['short_format_date'] = short_format_date($row['start_time']);
			}
			else if ($row['end_time'] < $now) {
				$res[$key]['status'] = 3;
			}
			else {
				$res[$key]['short_format_date'] = short_format_date($row['end_time']);
			}
		}

		return array('total' => $total, 'list' => $res);
	}
}

?>
