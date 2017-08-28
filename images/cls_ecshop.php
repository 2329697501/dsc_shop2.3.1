<?php
//dezend by  QQ:2172298892
class ECS
{
	public $db_name = '';
	public $prefix = 'ecs_';

	public function ECS($db_name, $prefix)
	{
		$this->db_name = $db_name;
		$this->prefix = $prefix;
	}

	public function table($str)
	{
		return '`' . $this->db_name . '`.`' . $this->prefix . $str . '`';
	}

	public function compile_password($pass)
	{
		return md5($pass);
	}

	public function get_domain()
	{
		$protocol = $this->http();

		if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
			$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
		}
		else if (isset($_SERVER['HTTP_HOST'])) {
			$host = $_SERVER['HTTP_HOST'];
		}
		else {
			if (isset($_SERVER['SERVER_PORT'])) {
				$port = ':' . $_SERVER['SERVER_PORT'];
				if (((':80' == $port) && ('http://' == $protocol)) || ((':443' == $port) && ('https://' == $protocol))) {
					$port = '';
				}
			}
			else {
				$port = '';
			}

			if (isset($_SERVER['SERVER_NAME'])) {
				$host = $_SERVER['SERVER_NAME'] . $port;
			}
			else if (isset($_SERVER['SERVER_ADDR'])) {
				$host = $_SERVER['SERVER_ADDR'] . $port;
			}
		}

		return $protocol . $host;
	}

	public function url()
	{
		$curr = (strpos(PHP_SELF, ADMIN_PATH . '/') !== false ? preg_replace('/(.*)(' . ADMIN_PATH . ')(\\/?)(.)*/i', '\\1', dirname(PHP_SELF)) : dirname(PHP_SELF));
		$root = str_replace('\\', '/', $curr);

		if (substr($root, -1) != '/') {
			$root .= '/';
		}

		return $this->get_domain() . $root;
	}

	public function http()
	{
		return isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off') ? 'https://' : 'http://';
	}

	public function data_dir($sid = 0)
	{
		if (empty($sid)) {
			$s = 'data';
		}
		else {
			$s = 'user_files/';
			$s .= ceil($sid / 3000) . '/';
			$s .= $sid % 3000;
		}

		return $s;
	}

	public function image_dir($sid = 0)
	{
		if (empty($sid)) {
			$s = 'images';
		}
		else {
			$s = 'user_files/';
			$s .= ceil($sid / 3000) . '/';
			$s .= ($sid % 3000) . '/';
			$s .= 'images';
		}

		return $s;
	}
}

if (!defined('IN_ECS')) {
	exit('Hacking attempt');
}

define('APPNAME', 'ECMOBAN_DSC');
define('VERSION', 'DSC v1.1');
define('RELEASE', '20160203');

?>
