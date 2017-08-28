<?php
//dezend by  QQ:2172298892
namespace http\location\controllers;

class IndexController extends \http\base\controllers\FrontendController
{
	public function actionIndex()
	{
		if (IS_POST) {
			$city = array('region_id' => i('city_id', 0), 'region_name' => i('city_name', ''));
			$this->setRecentCity($city);
			$sql = 'select `parent_id` from ' . $GLOBALS['ecs']->table('region') . ' where region_type = 2 and region_id = \'' . $city['region_id'] . '\'';
			$city['parent_id'] = $GLOBALS['db']->getOne($sql);
			setcookie('lbs_city', $city['region_id'], gmtime() + (3600 * 24 * 30));
			setcookie('province', $city['parent_id'], gmtime() + (3600 * 24 * 30));
			setcookie('city', $city['region_id'], gmtime() + (3600 * 24 * 30));
			setcookie('district', 0, gmtime() + (3600 * 24 * 30));
			setcookie('type_province', 0, gmtime() + (3600 * 24 * 30));
			setcookie('type_city', 0, gmtime() + (3600 * 24 * 30));
			setcookie('type_district', 0, gmtime() + (3600 * 24 * 30));
			return NULL;
		}

		$keywords = i('keywords');
		$this->assign('recent_city', $this->getRecentCity());
		$this->assign('city_list', $this->getCity($keywords));
		$this->assign('page_title', '城市选择');
		$this->display('index_index');
	}

	public function actionInfo()
	{
		$city_name = i('city_name');
		$city_name = rtrim($city_name, '市');
		$city_group = $this->getCity($city_name);

		if (is_array($city_group)) {
			foreach ($city_group as $key => $city_list) {
				$city_list = end($city_list);
				exit(json_encode($city_list));
			}
		}
	}

	private function getRecentCity()
	{
		return isset($_SESSION['recent_city_history']) ? $_SESSION['recent_city_history'] : array();
	}

	private function setRecentCity($data = array())
	{
		$_SESSION['recent_city_history'][$data['region_id']] = $data['region_name'];
	}

	private function getCity($keywords = '')
	{
		$data = array();
		$cacheFile = dirname(ROOT_PATH) . '/data/sc_file/pin_regions.php';

		if (file_exists_case($cacheFile)) {
			require $cacheFile;
			ksort($data);
		}

		if (!empty($keywords)) {
			foreach ($data as $key => $val) {
				foreach ($val as $k => $vo) {
					if (strpos($vo['region_name'], $keywords) === false) {
						unset($data[$key][$k]);
					}
				}

				if (empty($data[$key])) {
					unset($data[$key]);
				}
			}
		}

		return $data;
	}
}

?>
