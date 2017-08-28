<?php
//dezend by  QQ:2172298892
class uc_note
{
	public $db = '';

	public function uc_note()
	{
		$this->db = $GLOBALS['db'];
	}

	public function test($get, $post)
	{
		return API_RETURN_SUCCEED;
	}

	public function synlogin($get, $post)
	{
		$uid = $get['uid'];
		$username = $get['username'];

		if (!API_SYNLOGIN) {
			return API_RETURN_FORBIDDEN;
		}

		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
	}

	public function synlogout($get, $post)
	{
		if (!API_SYNLOGOUT) {
			return API_RETURN_FORBIDDEN;
		}

		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
	}

	public function updatehosts($get, $post)
	{
		if (!API_UPDATEHOSTS) {
			return API_RETURN_FORBIDDEN;
		}

		$cachefile = ROOT_PATH . 'plugins/uc_client/data/cache/hosts.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'hosts\'] = ' . var_export($post, true) . ";\r\n";
		fwrite($fp, $s);
		fclose($fp);
		return API_RETURN_SUCCEED;
	}

	public function updateapps($get, $post)
	{
		if (!API_UPDATEAPPS) {
			return API_RETURN_FORBIDDEN;
		}

		$UC_API = trim(addslashes($post['UC_API']));
		$cachefile = ROOT_PATH . 'plugins/uc_client/data/cache/apps.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'apps\'] = ' . var_export($post, true) . ";\r\n";
		fwrite($fp, $s);
		fclose($fp);

		if (is_writeable(ROOT_PATH . 'plugins/uc_client/config.inc.php')) {
			$configfile = trim(file_get_contents(ROOT_PATH . 'plugins/uc_client/config.inc.php'));
			$configfile = (substr($configfile, -2) == '?>' ? substr($configfile, 0, -2) : $configfile);
			$configfile = preg_replace('/define\\(\'UC_API\',\\s*\'.*?\'\\);/i', 'define(\'UC_API\', \'' . $UC_API . '\');', $configfile);

			if ($fp = @fopen(ROOT_PATH . 'plugins/uc_client/config.inc.php', 'w')) {
				@fwrite($fp, trim($configfile));
				@fclose($fp);
			}
		}

		return API_RETURN_SUCCEED;
	}

	public function updateclient($get, $post)
	{
		if (!API_UPDATECLIENT) {
			return API_RETURN_FORBIDDEN;
		}

		$cachefile = ROOT_PATH . 'plugins/uc_client/data/cache/settings.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'settings\'] = ' . var_export($post, true) . ";\r\n";
		fwrite($fp, $s);
		fclose($fp);
		return API_RETURN_SUCCEED;
	}
}

define('UC_CLIENT_VERSION', '1.6.0');
define('UC_CLIENT_RELEASE', '20110501');
define('API_SYNLOGIN', 1);
define('API_SYNLOGOUT', 1);
define('API_UPDATEHOSTS', 1);
define('API_UPDATEAPPS', 1);
define('API_UPDATECLIENT', 1);
define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '-2');
defined('ROOT_PATH') || define('ROOT_PATH', realpath('../') . '/');

if (!defined('IN_UC')) {
	error_reporting(0);
	require_once ROOT_PATH . 'plugins/uc_client/config.inc.php';
	require_once ROOT_PATH . 'plugins/uc_client/client.php';
	$code = @$_GET['code'];
	parse_str(uc_authcode($code, 'DECODE', UC_KEY), $get);
	$timestamp = time();

	if (3600 < ($timestamp - $get['time'])) {
		exit('Authracation has expiried');
	}

	if (empty($get)) {
		exit('Invalid Request');
	}

	$action = $get['action'];
	$post = uc_unserialize(file_get_contents('php://input'));

	if (in_array($get['action'], array('test', 'synlogin', 'synlogout', 'updatehosts', 'updateapps', 'updateclient'))) {
		$uc_note = new uc_note();
		exit($uc_note->$get['action']($get, $post));
	}
	else {
		exit(API_RETURN_FAILED);
	}
}
else {
	exit(API_RETURN_FAILED);
}

?>
