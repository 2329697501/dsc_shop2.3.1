<?php
//dezend by  QQ:2172298892
if (!defined('IN_ECS')) {
	exit('Hacking attempt');
}

define('ECS_WAP', true);
error_reporting(30719);

if (__FILE__ == '') {
	exit('Fatal error code: 0');
}

define('ROOT_PATH', str_replace('wap/includes/init.php', '', str_replace('\\', '/', __FILE__)));
@ini_set('memory_limit', '64M');
@ini_set('session.cache_expire', 180);
@ini_set('session.use_cookies', 1);
@ini_set('session.auto_start', 0);
@ini_set('display_errors', 1);
@ini_set('arg_separator.output', '&amp;');

if (DIRECTORY_SEPARATOR == '\\') {
	@ini_set('include_path', '.;' . ROOT_PATH);
}
else {
	@ini_set('include_path', '.:' . ROOT_PATH);
}

if (file_exists(ROOT_PATH . 'data/config.php')) {
	include ROOT_PATH . 'data/config.php';
}
else {
	include ROOT_PATH . 'includes/config.php';
}

if (defined('DEBUG_MODE') == false) {
	define('DEBUG_MODE', 7);
}

if (('5.1' <= PHP_VERSION) && !empty($timezone)) {
	date_default_timezone_set($timezone);
}

$php_self = (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);

if ('/' == substr($php_self, -1)) {
	$php_self .= 'index.php';
}

define('PHP_SELF', $php_self);
require ROOT_PATH . 'includes/cls_ecshop.php';
require ROOT_PATH . 'includes/lib_goods.php';
require ROOT_PATH . 'includes/lib_base.php';
require ROOT_PATH . 'includes/lib_common.php';
require ROOT_PATH . 'includes/lib_time.php';
require ROOT_PATH . 'includes/lib_main.php';
require ROOT_PATH . 'wap/includes/lib_main.php';
require ROOT_PATH . 'includes/inc_constant.php';

if (!get_magic_quotes_gpc()) {
	if (!empty($_GET)) {
		$_GET = addslashes_deep($_GET);
	}

	if (!empty($_POST)) {
		$_POST = addslashes_deep($_POST);
	}

	$_COOKIE = addslashes_deep($_COOKIE);
	$_REQUEST = addslashes_deep($_REQUEST);
}

$ecs = new ECS($db_name, $prefix);
require ROOT_PATH . 'includes/cls_mysql.php';
$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
$db_host = $db_user = $db_pass = $db_name = NULL;
$_CFG = load_config();
require ROOT_PATH . 'includes/cls_session.php';
$sess = new cls_session($db, $ecs->table('sessions'), $ecs->table('sessions_data'), 'ecsid');

if (!defined('INIT_NO_SMARTY')) {
	header('Cache-control: private');
	header('Content-type: text/html; charset=utf-8');
	require ROOT_PATH . 'includes/cls_template.php';
	$smarty = new cls_template();
	$smarty->cache_lifetime = $_CFG['cache_time'];
	$smarty->template_dir = ROOT_PATH . 'wap/templates';
	$smarty->cache_dir = ROOT_PATH . 'temp/caches';
	$smarty->compile_dir = ROOT_PATH . 'temp/compiled/wap';

	if ((DEBUG_MODE & 2) == 2) {
		$smarty->direct_output = true;
		$smarty->force_compile = true;
	}
	else {
		$smarty->direct_output = false;
		$smarty->force_compile = false;
	}
}

if (!defined('INIT_NO_USERS')) {
	$user = &init_users();

	if (empty($_SESSION['user_id'])) {
		if ($user->get_cookie()) {
			if ((0 < $_SESSION['user_id']) && !isset($_SESSION['user_money'])) {
				update_user_info();
			}
		}
		else {
			$_SESSION['user_id'] = 0;
			$_SESSION['user_name'] = '';
			$_SESSION['email'] = '';
			$_SESSION['user_rank'] = 0;
			$_SESSION['discount'] = 1;
		}
	}
}

if ((DEBUG_MODE & 1) == 1) {
	error_reporting(30719);
}
else {
	error_reporting(30719 ^ 8);
}

if ((DEBUG_MODE & 4) == 4) {
	include ROOT_PATH . 'includes/lib.debug.php';
}

if (gzip_enabled()) {
	ob_start('ob_gzhandler');
}

header('Content-Type:text/vnd.wap.wml; charset=utf-8');
echo '<?xml version=\'1.0\' encoding=\'utf-8\'?>';

if (empty($_CFG['wap_config'])) {
	echo '<!DOCTYPE wml PUBLIC \'-//WAPFORUM//DTD WML 1.1//EN\' \'http://www.wapforum.org/DTD/wml_1.1.xml\'><wml><head><meta http-equiv=\'Cache-Control\' content=\'max-age=0\'/></head><card id=\'ecshop\' title=\'ECShop_WAP\'><p align=\'left\'>对不起,' . $_CFG['shop_name'] . '暂时没有开启WAP功能</p></card></wml>';
	exit();
}

?>
