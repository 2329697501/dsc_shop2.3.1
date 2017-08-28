<?php
//dezend by  QQ:2172298892
namespace apps\base\controllers;

abstract class BaseController extends \base\Controller
{
	protected $model;
	protected $cache;
	protected $pager = '';

	public function __construct()
	{
		define('APP_PATH', BASE_PATH . 'apps/' . APP_NAME . '/');
		define('__ROOT__', rtrim(dirname($_SERVER['SCRIPT_NAME']), '\\/') . '/');
		define('__PUBLIC__', __ROOT__ . 'data/assets/');
		define('__HOST__', get_domain());
		define('__URL__', __HOST__ . __ROOT__);
		define('__TPL__', __ROOT__ . 'themes/' . c('TPL.TPL_TEMPLATE') . '/');
		define('__JS__', __ROOT__ . 'source/apps/base/js/');
		$this->model = new \apps\base\models\BaseModel();
		$GLOBALS['cache'] = $this->cache = new \base\Cache('memcached');
		$GLOBALS['smarty'] = $this->_getView();
	}

	protected function load_helper($files = array(), $type = 'base')
	{
		if (!is_array($files)) {
			$files = array($files);
		}

		$base_path = ($type == 'app' ? APP_PATH : BASE_PATH);

		foreach ($files as $vo) {
			$helper = $base_path . 'helpers/' . $vo . '_helper.php';

			if (file_exists($helper)) {
				require_once $helper;
			}
		}
	}

	protected function pageLimit($url, $num = 10)
	{
		$url = str_replace(urlencode('{page}'), '{page}', $url);
		$page = (isset($this->pager['obj']) && is_object($this->pager['obj']) ? $this->pager['obj'] : new \libraries\Page());
		$cur_page = $page->getCurPage($url);
		$limit_start = ($cur_page - 1) * $num;
		$limit = $limit_start . ',' . $num;
		$this->pager = array('obj' => $page, 'url' => $url, 'num' => $num, 'cur_page' => $cur_page, 'limit' => $limit);
		return $limit;
	}

	protected function pageShow($count)
	{
		return $this->pager['obj']->show($this->pager['url'], $count, $this->pager['num']);
	}

	protected function ectouchUpload($key = '', $upload_dir = 'images')
	{
		$config = array('maxSize' => 1024 * 1024 * 2, 'allowExts' => explode(',', 'jpg,jpeg,gif,png,bmp,mp3,amr,mp4'), 'rootPath' => ROOT_PATH, 'savePath' => 'data/attached/' . $upload_dir . '/');
		$upload = new \libraries\Upload($config);

		if (!$upload->upload($key)) {
			return array('error' => 1, 'message' => $upload->getError());
		}
		else {
			return array('error' => 0, 'message' => $upload->getUploadFileInfo());
		}
	}
}

?>
