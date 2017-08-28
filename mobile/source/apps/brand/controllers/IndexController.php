<?php
//dezend by  QQ:2172298892
namespace apps\brand\controllers;

class IndexController extends \apps\base\controllers\FrontendController
{
	private $brand = 0;
	private $size = 1000;
	private $page = 1;
	private $sort = 'last_update';
	private $order = 'ASC';
	private $region_id = 0;
	private $area_id = 0;
	private $is_ship = '';
	private $price_min = '';
	private $price_max = '';

	public function __construct()
	{
		parent::__construct();
		l(require ROOT_PATH . 'source/language/' . c('shop.lang') . '/user.php');
		l(require ROOT_PATH . 'source/language/' . c('shop.lang') . '/flow.php');
		$area_info = get_area_info($this->province_id);
		$this->area_id = $area_info['region_id'];
		$where = 'regionId = \'' . $this->province_id . '\'';
		$date = array('parent_id');
		$this->region_id = get_table_date('region_warehouse', $where, $date, 2);
		if (isset($_COOKIE['region_id']) && !empty($_COOKIE['region_id'])) {
			$this->region_id = $_COOKIE['region_id'];
		}

		$this->is_ship = isset($_REQUEST['is_ship']) && !empty($_REQUEST['is_ship']) ? trim($_REQUEST['is_ship']) : '';
		$this->price_min = !empty($_REQUEST['price_min']) && (0 < floatval($_REQUEST['price_min'])) ? floatval($_REQUEST['price_min']) : '';
		$this->price_max = !empty($_REQUEST['price_max']) && (0 < floatval($_REQUEST['price_max'])) ? floatval($_REQUEST['price_max']) : '';
	}

	public function actionIndex()
	{
		$n = getdate();
		$this->assign('mon', $n['mon']);
		$this->assign('mday', $n['mday']);
		$list = $GLOBALS['cache']->get('brands_index');

		if (!$list) {
			$list = $this->get_brands_hj();

			if ($list) {
				if ($list['top']) {
					$cate = 0;
					$act = '';

					foreach ($list['top'] as $key => $val) {
						$list['top'][$key]['goods'] = brand_get_goods($val['brand_id'], $cate, $this->size, $this->page, $this->sort, $this->order, $this->region_id, $this->area_id, $act, $this->is_ship, $this->price_min, $this->price_max);
						$arr_tmp = array();

						foreach ($list['top'][$key]['goods'] as $k => $v) {
							if ($list['top'][$key]['goods'][$k]['firsttype'] == 'hot') {
								$arr_tmp[] = $list['top'][$key]['goods'][$k];
							}
						}

						foreach ($list['top'][$key]['goods'] as $k => $v) {
							if ($list['top'][$key]['goods'][$k]['firsttype'] == 'new') {
								$arr_tmp[] = $list['top'][$key]['goods'][$k];
							}
						}

						foreach ($list['top'][$key]['goods'] as $k => $v) {
							if ($list['top'][$key]['goods'][$k]['firsttype'] == 'promote') {
								$arr_tmp[] = $list['top'][$key]['goods'][$k];
							}
						}

						foreach ($list['top'][$key]['goods'] as $k => $v) {
							if ($list['top'][$key]['goods'][$k]['firsttype'] == 'best') {
								$arr_tmp[] = $list['top'][$key]['goods'][$k];
							}
						}

						foreach ($list['top'][$key]['goods'] as $k => $v) {
							if ($list['top'][$key]['goods'][$k]['firsttype'] == 'ordinary') {
								$arr_tmp[] = $list['top'][$key]['goods'][$k];
							}
						}

						$list['top'][$key]['goods'] = $arr_tmp;
					}
				}

				if ($list['center']) {
					$cate = 0;
					$act = '';

					foreach ($list['center'] as $key => $val) {
						$list['center'][$key]['count'] = goods_count_by_brand($val['brand_id']);

						if (!$list['center'][$key]['count']) {
							$list['center'][$key]['count'] = 0;
						}

						$list['center'][$key]['goods'] = brand_get_goods($val['brand_id'], $cate, $this->size, $this->page, $this->sort, $this->order, $this->region_id, $this->area_id, $act, $this->is_ship, $this->price_min, $this->price_max);
						$arr_tmp = array();

						foreach ($list['center'][$key]['goods'] as $k => $v) {
							if ($list['center'][$key]['goods'][$k]['firsttype'] == 'hot') {
								$arr_tmp[] = $list['center'][$key]['goods'][$k];
							}
						}

						foreach ($list['center'][$key]['goods'] as $k => $v) {
							if ($list['center'][$key]['goods'][$k]['firsttype'] == 'promote') {
								$arr_tmp[] = $list['center'][$key]['goods'][$k];
							}
						}

						foreach ($list['center'][$key]['goods'] as $k => $v) {
							if ($list['center'][$key]['goods'][$k]['firsttype'] == 'new') {
								$arr_tmp[] = $list['center'][$key]['goods'][$k];
							}
						}

						foreach ($list['center'][$key]['goods'] as $k => $v) {
							if ($list['center'][$key]['goods'][$k]['firsttype'] == 'best') {
								$arr_tmp[] = $list['center'][$key]['goods'][$k];
							}
						}

						foreach ($list['center'][$key]['goods'] as $k => $v) {
							if ($list['center'][$key]['goods'][$k]['firsttype'] == 'ordinary') {
								$arr_tmp[] = $list['center'][$key]['goods'][$k];
							}
						}

						$list['center'][$key]['goods'] = $arr_tmp;
					}
				}
			}

			$GLOBALS['cache']->set('brands_index', $list, 300);
		}

		foreach ($list['top'] as $k => $v) {
			$list1 = $list['top'][$k]['goods'];
		}

		$this->assign('list1', $list1[0]['goods_thumb']);

		foreach ($list['top'] as $k => $v) {
			array_shift($list['top'][$k]['goods']);
		}

		$this->assign('list', $list);
		$brand_count = count($list['list2']);
		$brand15_tmp = array_rand($list['list2'], $brand_count - 15);

		foreach ($brand15_tmp as $key => $value) {
			unset($list['list2'][$value]);
		}

		$this->assign('brand15', $list['list2']);
		$this->assign('page_title', l('brand_street'));
		$this->display('brand_street');
	}

	private function get_brands_hj()
	{
		$sql = 'SELECT brand_id, brand_name, brand_logo, brand_desc FROM {pre}brand WHERE is_show = 1 GROUP BY brand_id , sort_order order by sort_order ASC';
		$res = $this->db->getAll($sql);
		$cate = 0;
		$act = '';

		foreach ($res as $k => $v) {
			$r = brand_get_goods($v['brand_id'], $cate, $this->size, $this->page, $this->sort, $this->order, $this->region_id, $this->area_id, $act, $this->is_ship, $this->price_min, $this->price_max);

			if (count($r) <= 3) {
				unset($res[$k]);
			}
		}

		$res = array_values($res);
		$arr = array();

		foreach ($res as $key => $row) {
			if ($key == 0) {
				$arr['top'][$row['brand_id']]['brand_id'] = $row['brand_id'];
				$arr['top'][$row['brand_id']]['brand_name'] = $row['brand_name'];
				$arr['top'][$row['brand_id']]['url'] = build_uri('brand', array('bid' => $row['brand_id']));
				$arr['top'][$row['brand_id']]['brand_logo'] = get_brand_logo($row['brand_logo']);
				$arr['top'][$row['brand_id']]['goods_num'] = goods_count_by_brand($row['brand_id']);
				$arr['top'][$row['brand_id']]['brand_desc'] = htmlspecialchars($row['brand_desc'], ENT_QUOTES);
			}
			else {
				if ((0 < $key) && ($key < 4)) {
					$arr['center'][$row['brand_id']]['brand_id'] = $row['brand_id'];
					$arr['center'][$row['brand_id']]['brand_name'] = $row['brand_name'];
					$arr['center'][$row['brand_id']]['url'] = build_uri('brand', array('bid' => $row['brand_id']));
					$arr['center'][$row['brand_id']]['brand_logo'] = get_brand_logo($row['brand_logo']);
					$arr['center'][$row['brand_id']]['goods_num'] = goods_count_by_brand($row['brand_id']);
					$arr['center'][$row['brand_id']]['brand_desc'] = htmlspecialchars($row['brand_desc'], ENT_QUOTES);
				}
				else {
					if ((4 < $key) && ($key < 4)) {
						$arr['list1'][$row['brand_id']]['brand_id'] = $row['brand_id'];
						$arr['list1'][$row['brand_id']]['brand_name'] = $row['brand_name'];
						$arr['list1'][$row['brand_id']]['url'] = build_uri('brand', array('bid' => $row['brand_id']));
						$arr['list1'][$row['brand_id']]['brand_logo'] = get_brand_logo($row['brand_logo']);
						$arr['list1'][$row['brand_id']]['goods_num'] = goods_count_by_brand($row['brand_id']);
						$arr['list1'][$row['brand_id']]['brand_desc'] = htmlspecialchars($row['brand_desc'], ENT_QUOTES);
					}
					else {
						$arr['list2'][$row['brand_id']]['brand_id'] = $row['brand_id'];
						$arr['list2'][$row['brand_id']]['brand_name'] = $row['brand_name'];
						$arr['list2'][$row['brand_id']]['url'] = build_uri('brand', array('bid' => $row['brand_id']));
						$arr['list2'][$row['brand_id']]['brand_logo'] = get_brand_logo($row['brand_logo']);
						$arr['list2'][$row['brand_id']]['goods_num'] = goods_count_by_brand($row['brand_id']);
						$arr['list2'][$row['brand_id']]['brand_desc'] = htmlspecialchars($row['brand_desc'], ENT_QUOTES);
					}
				}
			}
		}

		return $arr;
	}

	public function actionNav()
	{
		$list = read_static_cache('brand_list');

		if ($list === false) {
			$list = get_brands_letter('brand', 1000, 1);
			write_static_cache('brand_list', $list);
		}

		$this->assign('list', $list);
		$this->assign('page_title', l('all_brand'));
		$this->display('brand_list');
	}

	public function actionGoodslist()
	{
		if (i('get.type')) {
			$_SESSION['brandgoodstype'] = i('get.type');
		}
		else {
			$_SESSION['brandgoodstype'] = '';
		}

		$brand_id = i('request.id');
		$this->assign('brand_id', $brand_id);
		$brand_info = get_brand_info($brand_id);
		$brand_info['brand_logo'] = '../data/brandlogo/' . $brand_info['brand_logo'];
		$this->assign('brand_info', $brand_info);

		if (empty($brand_info)) {
			$this->redirect(u('index'));
			exit();
		}

		$this->assign('page', $this->page);
		$this->assign('size', $this->size);
		$this->assign('brand_id', $brand_id);
		$goods_list = brand_get_goods($brand_id, '0', $this->size, $this->page, $this->sort, $this->order, $this->region_id, $this->area_id, '', $this->is_ship, $this->price_min, $this->price_max);
		$arr_tmp = array();
		$brand_goods_hot = 0;

		foreach ($goods_list as $k => $v) {
			if ($goods_list[$k]['firsttype'] == 'hot') {
				$arr_tmp[] = $goods_list[$k];
				$brand_goods_hot++;
			}
		}

		$brand_goods_new = 0;

		foreach ($goods_list as $k => $v) {
			if ($goods_list[$k]['firsttype'] == 'new') {
				$arr_tmp[] = $goods_list[$k];
				$brand_goods_new++;
			}
		}

		$brand_goods_promote = 0;

		foreach ($goods_list as $k => $v) {
			if ($goods_list[$k]['firsttype'] == 'promote') {
				$arr_tmp[] = $goods_list[$k];
				$brand_goods_promote++;
			}
		}

		$brand_goods_best = 0;

		foreach ($goods_list as $k => $v) {
			if ($goods_list[$k]['firsttype'] == 'best') {
				$arr_tmp[] = $goods_list[$k];
				$brand_goods_best++;
			}
		}

		foreach ($goods_list as $k => $v) {
			if ($goods_list[$k]['firsttype'] == 'ordinary') {
				$arr_tmp[] = $goods_list[$k];
			}
		}

		$this->assign('brand_goods_new', $brand_goods_new);
		$this->assign('brand_goods_promote', $brand_goods_promote);
		$this->assign('brand_goods_best', $brand_goods_best);
		$this->assign('brand_goods_hot', $brand_goods_hot);
		$this->assign('show_marketprice', c('show_marketprice'));
		$brand_goods_count = count($arr_tmp);
		$this->assign('brand_goods_count', $brand_goods_count);
		$this->assign('page_title', $brand_info['brand_name']);
		$this->display('brand_list_info');
	}

	public function actionGoodslistasc()
	{
		if (IS_AJAX) {
			$brand_id = i('get.id', 0, 'intval');
			$page = i('post.page', 1, 'intval');
			$size = '4';
			$goods_list = brand_get_goods2($_SESSION['brandgoodstype'], $brand_id, '0', $size, $page, $this->sort, $this->order, $this->region_id, $this->area_id, '', '', '', '');
			exit(json_encode(array('list' => $goods_list['list'], 'totalPage' => $goods_list['totalpage'])));
		}
	}
}

?>
