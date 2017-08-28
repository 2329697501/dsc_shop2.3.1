<?php
//dezend by  QQ:2172298892
header('Content-Type: text/html; charset=utf-8');
error_reporting(1 | 2);
define('IN_ECS', true);
define('ROOT_PATH', preg_replace('/resources\\/assets(.*)/i', '', str_replace('\\', '/', __FILE__)));

if (isset($_SERVER['PHP_SELF'])) {
	define('PHP_SELF', $_SERVER['PHP_SELF']);
}
else {
	define('PHP_SELF', $_SERVER['SCRIPT_NAME']);
}

$root_url = preg_replace('/resources\\/assets(.*)/i', '', PHP_SELF);
$db_config = require ROOT_PATH . 'config/database.php';
require ROOT_PATH . 'app/helpers/base_helper.php';
require ROOT_PATH . 'app/classes/mysql.php';
require ROOT_PATH . 'app/classes/ecshop.php';
require ROOT_PATH . 'app/classes/session.php';
$ecs = new ecshop($db_config['DB_NAME'], $db_config['DB_PREFIX']);
define('DATA_DIR', $ecs->data_dir());
define('IMAGE_DIR', $ecs->image_dir());
$db = new mysql($db_config['DB_HOST'], $db_config['DB_USER'], $db_config['DB_PWD'], $db_config['DB_NAME']);
$sess = new session($db, $ecs->table('sessions'), $ecs->table('sessions_data'), 'ECSCP_ID');

if (!empty($_SESSION['admin_id'])) {
	if ($_SESSION['action_list'] == 'all') {
		$enable = true;
	}
	else {
		if ((strpos(',' . $_SESSION['action_list'] . ',', ',goods_manage,') === false) && (strpos(',' . $_SESSION['action_list'] . ',', ',virualcard,') === false) && (strpos(',' . $_SESSION['action_list'] . ',', ',article_manage,') === false)) {
			$enable = false;
		}
		else {
			$enable = true;
		}
	}
}
else {
	$enable = false;
}

?>
