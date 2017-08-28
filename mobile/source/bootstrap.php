<?php
//dezend by  QQ:2172298892
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
	exit('require PHP > 5.3.0 !');
}

defined('APPNAME') || define('APPNAME', 'ECTouch');
defined('VERSION') || define('VERSION', '1.4.0');
defined('RELEASE') || define('RELEASE', '20160926');
defined('CHARSET') || define('CHARSET', 'utf-8');
defined('ROOT_PATH') || define('ROOT_PATH', str_replace('\\', '/', dirname(dirname(__FILE__))) . '/');
defined('BASE_PATH') || define('BASE_PATH', ROOT_PATH . 'source/');
defined('CONF_PATH') || define('CONF_PATH', BASE_PATH . 'config/');
defined('DATA_PATH') || define('DATA_PATH', ROOT_PATH . 'data/');
defined('ADDONS_PATH') || define('ADDONS_PATH', ROOT_PATH . 'plugins/');
defined('STORAGE_PATH') || define('STORAGE_PATH', DATA_PATH . 'attachment/');
defined('CACHE_PATH') || define('CACHE_PATH', DATA_PATH . 'caches/');
defined('NOW_TIME') || define('NOW_TIME', $_SERVER['REQUEST_TIME']);
defined('REQUEST_METHOD') || define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
defined('IS_GET') || define('IS_GET', REQUEST_METHOD == 'GET' ? true : false);
defined('IS_POST') || define('IS_POST', REQUEST_METHOD == 'POST' ? true : false);
defined('IS_AJAX') || define('IS_AJAX', (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) || !empty($_POST['ajax']) || !empty($_GET['ajax']) ? true : false);
defined('IS_PJAX') || define('IS_PJAX', array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']);
defined('APP_DEBUG') || define('APP_DEBUG', false);
defined('ENVIRONMENT') || define('ENVIRONMENT', APP_DEBUG ? 'development' : 'production');
defined('REST_EXTEND') || define('REST_EXTEND', 'JSON');
defined('PHP_SELF') || define('PHP_SELF', isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
header('Content-Type: text/html; charset=' . CHARSET);
require BASE_PATH . 'vendor/autoload.php';
\base\App::run();

?>
