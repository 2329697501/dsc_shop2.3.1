<?php
//dezend by  QQ:2172298892
namespace apps\base\hooks;

class AppHook
{
	/**
	 * 开始时间
	 * @var integer
	 */
	public $startTime = 0;

	public function appBegin()
	{
		$this->startTime = microtime(true);
	}

	public function appEnd()
	{
	}

	public function appError($e)
	{
		if (404 == $e->getCode()) {
			$action = 'error404';
		}
		else {
			$action = 'error';
		}

		a('base/Error', 'controllers')->$action($e);
	}

	public function routeParseUrl($rewriteRule, $rewriteOn)
	{
	}

	public function actionBefore($obj, $action)
	{
		$this->_initialize();
	}

	public function actionAfter($obj, $action)
	{
	}

	private function _initialize()
	{
		$initialize_path = APP_PATH . 'config/';
		$initialize_cache = ROOT_PATH . 'data/caches/app/' . APP_NAME . '/';

		if (!file_exists($initialize_cache)) {
			if (!@mkdir($initialize_cache, 511, true)) {
				throw new \Exception('Can not create dir \'' . $initialize_cache . '\'', 500);
			}
		}

		if (!is_writable($initialize_cache)) {
			@chmod($initialize_cache, 511);
		}

		if (file_exists($initialize_path . 'initialize.php') && !file_exists($initialize_cache . 'installed.lock') && !file_exists($initialize_path . 'installed.lock')) {
			$initialize = require $initialize_path . 'initialize.php';

			if (isset($initialize['db'])) {
				$init_sql = (is_string($initialize['db']) ? array($initialize['db']) : $initialize['db']);
				$db = new \base\Model();

				foreach ($init_sql as $sql) {
					$db->query($sql);
				}
			}

			file_put_contents($initialize_cache . 'installed.lock', 'lock');
		}
	}
}


?>
