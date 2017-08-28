<?php
//dezend by  QQ:2172298892
function getInstance()
{
	static $obj = array();

	if (empty($obj)) {
		$obj = a('base/Frontend', 'controllers');
	}

	return $obj;
}

function check_verify($code, $id = '')
{
	$verify = new \vendor\Verify();
	return $verify->check($code, $id);
}

function dump($var, $echo = true, $label = NULL, $strict = true)
{
	$label = ($label === NULL ? '' : rtrim($label) . ' ');

	if (!$strict) {
		if (ini_get('html_errors')) {
			$output = print_r($var, true);
			$output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
		}
		else {
			$output = $label . print_r($var, true);
		}
	}
	else {
		ob_start();
		var_dump($var);
		$output = ob_get_clean();

		if (!extension_loaded('xdebug')) {
			$output = preg_replace('/\\]\\=\\>\\n(\\s+)/m', '] => ', $output);
			$output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
		}
	}

	if ($echo) {
		echo $output;
		return NULL;
	}
	else {
		return $output;
	}
}

function filter($name, &$content)
{
	$class = $name . 'Filter';
	require_cache(APP_PATH . 'filters/' . $class . '.php');
	$filter = new $class();
	$content = $filter->run($content);
}

function is_ssl()
{
	if (isset($_SERVER['HTTPS']) && (('1' == $_SERVER['HTTPS']) || ('on' == strtolower($_SERVER['HTTPS'])))) {
		return true;
	}
	else {
		if (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
			return true;
		}
	}

	return false;
}

function redirect($url, $time = 0, $msg = '')
{
	$url = str_replace(array("\n", "\r"), '', $url);

	if (empty($msg)) {
		$msg = '系统将在' . $time . '秒之后自动跳转到' . $url . '！';
	}

	if (!headers_sent()) {
		if (0 === $time) {
			header('Location: ' . $url);
		}
		else {
			header('refresh:' . $time . ';url=' . $url);
			echo $msg;
		}

		exit();
	}
	else {
		$str = '<meta http-equiv=\'Refresh\' content=\'' . $time . ';URL=' . $url . '\'>';

		if ($time != 0) {
			$str .= $msg;
		}

		exit($str);
	}
}

function S($name, $value = '', $options = NULL)
{
	static $cache = '';
	if (is_array($options) && empty($cache)) {
		$type = (isset($options['type']) ? $options['type'] : '');
		$cache = Cache::getInstance($type, $options);
	}
	else if (is_array($name)) {
		$type = (isset($name['type']) ? $name['type'] : '');
		$cache = Cache::getInstance($type, $name);
		return $cache;
	}
	else if (empty($cache)) {
		$cache = Cache::getInstance();
	}

	if ('' === $value) {
		return $cache->get($name);
	}
	else if (is_null($value)) {
		return $cache->rm($name);
	}
	else {
		if (is_array($options)) {
			$expire = (isset($options['expire']) ? $options['expire'] : NULL);
		}
		else {
			$expire = (is_numeric($options) ? $options : NULL);
		}

		return $cache->set($name, $value, $expire);
	}
}

function F($name, $value = '', $path = DATA_PATH)
{
	static $_cache = array();
	$filename = $path . $name . '.php';

	if ('' !== $value) {
		if (is_null($value)) {
			return false !== strpos($name, '*') ? array_map('unlink', glob($filename)) : unlink($filename);
		}
		else {
			$dir = dirname($filename);

			if (!is_dir($dir)) {
				mkdir($dir, 493, true);
			}

			$_cache[$name] = $value;
			return file_put_contents($filename, strip_whitespace('<?php	return ' . var_export($value, true) . ';?>'));
		}
	}

	if (isset($_cache[$name])) {
		return $_cache[$name];
	}

	if (is_file($filename)) {
		$value = include $filename;
		$_cache[$name] = $value;
	}
	else {
		$value = false;
	}

	return $value;
}

function to_guid_string($mix)
{
	if (is_object($mix) && function_exists('spl_object_hash')) {
		return spl_object_hash($mix);
	}
	else if (is_resource($mix)) {
		$mix = get_resource_type($mix) . strval($mix);
	}
	else {
		$mix = serialize($mix);
	}

	return md5($mix);
}

function xml_encode($data, $root = 'think', $item = 'item', $attr = '', $id = 'id', $encoding = 'utf-8')
{
	if (is_array($attr)) {
		$_attr = array();

		foreach ($attr as $key => $value) {
			$_attr[] = $key . '="' . $value . '"';
		}

		$attr = implode(' ', $_attr);
	}

	$attr = trim($attr);
	$attr = (empty($attr) ? '' : ' ' . $attr);
	$xml = '<?xml version="1.0" encoding="' . $encoding . '"?>';
	$xml .= '<' . $root . $attr . '>';
	$xml .= data_to_xml($data, $item, $id);
	$xml .= '</' . $root . '>';
	return $xml;
}

function data_to_xml($data, $item = 'item', $id = 'id')
{
	$xml = $attr = '';

	foreach ($data as $key => $val) {
		if (is_numeric($key)) {
			$id && ($attr = ' ' . $id . '="' . $key . '"');
			$key = $item;
		}

		$xml .= '<' . $key . $attr . '>';
		$xml .= (is_array($val) || is_object($val) ? data_to_xml($val, $item, $id) : $val);
		$xml .= '</' . $key . '>';
	}

	return $xml;
}

function session($name, $value = '')
{
	$prefix = c('SESSION_PREFIX');

	if (is_array($name)) {
		if (isset($name['prefix'])) {
			c('SESSION_PREFIX', $name['prefix']);
		}

		if (c('VAR_SESSION_ID') && isset($_REQUEST[c('VAR_SESSION_ID')])) {
			session_id($_REQUEST[c('VAR_SESSION_ID')]);
		}
		else if (isset($name['id'])) {
			session_id($name['id']);
		}

		ini_set('session.auto_start', 0);

		if (isset($name['name'])) {
			session_name($name['name']);
		}

		if (isset($name['path'])) {
			session_save_path($name['path']);
		}

		if (isset($name['domain'])) {
			ini_set('session.cookie_domain', $name['domain']);
		}

		if (isset($name['expire'])) {
			ini_set('session.gc_maxlifetime', $name['expire']);
		}

		if (isset($name['use_trans_sid'])) {
			ini_set('session.use_trans_sid', $name['use_trans_sid'] ? 1 : 0);
		}

		if (isset($name['use_cookies'])) {
			ini_set('session.use_cookies', $name['use_cookies'] ? 1 : 0);
		}

		if (isset($name['cache_limiter'])) {
			session_cache_limiter($name['cache_limiter']);
		}

		if (isset($name['cache_expire'])) {
			session_cache_expire($name['cache_expire']);
		}

		if (isset($name['type'])) {
			c('SESSION_TYPE', $name['type']);
		}

		if (c('SESSION_TYPE')) {
			$class = 'Session' . ucwords(strtolower(c('SESSION_TYPE')));

			if (require_cache(EXTEND_PATH . 'Driver/Session/' . $class . '.class.php')) {
				$hander = new $class();
				$hander->execute();
			}
			else {
				throw_exception(l('_CLASS_NOT_EXIST_') . ': ' . $class);
			}
		}

		if (c('SESSION_AUTO_START')) {
			session_start();
		}
	}
	else if ('' === $value) {
		if (0 === strpos($name, '[')) {
			if ('[pause]' == $name) {
				session_write_close();
			}
			else if ('[start]' == $name) {
				session_start();
			}
			else if ('[destroy]' == $name) {
				$_SESSION = array();
				session_unset();
				session_destroy();
			}
			else if ('[regenerate]' == $name) {
				session_regenerate_id();
			}
		}
		else if (0 === strpos($name, '?')) {
			$name = substr($name, 1);

			if (strpos($name, '.')) {
				list($name1, $name2) = explode('.', $name);
				return $prefix ? isset($_SESSION[$prefix][$name1][$name2]) : isset($_SESSION[$name1][$name2]);
			}
			else {
				return $prefix ? isset($_SESSION[$prefix][$name]) : isset($_SESSION[$name]);
			}
		}
		else if (is_null($name)) {
			if ($prefix) {
				unset($_SESSION[$prefix]);
			}
			else {
				$_SESSION = array();
			}
		}
		else if ($prefix) {
			if (strpos($name, '.')) {
				list($name1, $name2) = explode('.', $name);
				return isset($_SESSION[$prefix][$name1][$name2]) ? $_SESSION[$prefix][$name1][$name2] : NULL;
			}
			else {
				return isset($_SESSION[$prefix][$name]) ? $_SESSION[$prefix][$name] : NULL;
			}
		}
		else if (strpos($name, '.')) {
			list($name1, $name2) = explode('.', $name);
			return isset($_SESSION[$name1][$name2]) ? $_SESSION[$name1][$name2] : NULL;
		}
		else {
			return isset($_SESSION[$name]) ? $_SESSION[$name] : NULL;
		}
	}
	else if (is_null($value)) {
		if ($prefix) {
			unset($_SESSION[$prefix][$name]);
		}
		else {
			unset($_SESSION[$name]);
		}
	}
	else if ($prefix) {
		if (!is_array($_SESSION[$prefix])) {
			$_SESSION[$prefix] = array();
		}

		$_SESSION[$prefix][$name] = $value;
	}
	else {
		$_SESSION[$name] = $value;
	}
}

function cookie($name, $value = '', $option = NULL)
{
	$config = array('prefix' => c('COOKIE_PREFIX'), 'expire' => c('COOKIE_EXPIRE'), 'path' => c('COOKIE_PATH'), 'domain' => c('COOKIE_DOMAIN'));

	if (!is_null($option)) {
		if (is_numeric($option)) {
			$option = array('expire' => $option);
		}
		else if (is_string($option)) {
			parse_str($option, $option);
		}

		$config = array_merge($config, array_change_key_case($option));
	}

	if (is_null($name)) {
		if (empty($_COOKIE)) {
			return NULL;
		}

		$prefix = (empty($value) ? $config['prefix'] : $value);

		if (!empty($prefix)) {
			foreach ($_COOKIE as $key => $val) {
				if (0 === stripos($key, $prefix)) {
					setcookie($key, '', time() - 3600, $config['path'], $config['domain']);
					unset($_COOKIE[$key]);
				}
			}
		}

		return NULL;
	}

	$name = $config['prefix'] . $name;

	if ('' === $value) {
		if (isset($_COOKIE[$name])) {
			$value = $_COOKIE[$name];

			if (0 === strpos($value, 'think:')) {
				$value = substr($value, 6);
				return array_map('urldecode', json_decode(MAGIC_QUOTES_GPC ? stripslashes($value) : $value, true));
			}
			else {
				return $value;
			}
		}
		else {
			return NULL;
		}
	}
	else if (is_null($value)) {
		setcookie($name, '', time() - 3600, $config['path'], $config['domain']);
		unset($_COOKIE[$name]);
	}
	else {
		if (is_array($value)) {
			$value = 'think:' . json_encode(array_map('urlencode', $value));
		}

		$expire = (!empty($config['expire']) ? time() + intval($config['expire']) : 0);
		setcookie($name, $value, $expire, $config['path'], $config['domain']);
		$_COOKIE[$name] = $value;
	}
}

function get_client_ip($type = 0)
{
	$type = ($type ? 1 : 0);
	static $ip;

	if ($ip !== NULL) {
		return $ip[$type];
	}

	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos = array_search('unknown', $arr);

		if (false !== $pos) {
			unset($arr[$pos]);
		}

		$ip = trim($arr[0]);
	}
	else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if (isset($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	$long = sprintf('%u', ip2long($ip));
	$ip = ($long ? array($ip, $long) : array('0.0.0.0', 0));
	return $ip[$type];
}

function send_http_status($code)
{
	static $_status = array(100 => 'Continue', 101 => 'Switching Protocols', 200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Moved Temporarily ', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 307 => 'Temporary Redirect', 400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Timeout', 409 => 'Conflict', 410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type', 416 => 'Requested Range Not Satisfiable', 417 => 'Expectation Failed', 500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Timeout', 505 => 'HTTP Version Not Supported', 509 => 'Bandwidth Limit Exceeded');

	if (isset($_status[$code])) {
		header('HTTP/1.1 ' . $code . ' ' . $_status[$code]);
		header('Status:' . $code . ' ' . $_status[$code]);
	}
}

function touch_filter(&$value)
{
	if (preg_match('/^(EXP|NEQ|GT|EGT|LT|ELT|OR|LIKE|NOTLIKE|NOTBETWEEN|NOT BETWEEN|BETWEEN|NOTIN|NOT IN|IN)$/i', $value)) {
		$value .= ' ';
	}
}

function I($name, $default = '', $filter = NULL)
{
	if (strpos($name, '.')) {
		list($method, $name) = explode('.', $name, 2);
	}
	else {
		$method = 'param';
	}

	switch (strtolower($method)) {
	case 'get':
		$input = &$_GET;
		break;

	case 'post':
		$input = &$_POST;
		break;

	case 'put':
		parse_str(file_get_contents('php://input'), $input);
		break;

	case 'param':
		switch ($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			$input = $_POST;
			break;

		case 'PUT':
			parse_str(file_get_contents('php://input'), $input);
			break;

		default:
			$input = $_GET;
		}

		if (c('VAR_URL_PARAMS') && isset($_GET[c('VAR_URL_PARAMS')])) {
			$input = array_merge($input, $_GET[c('VAR_URL_PARAMS')]);
		}

		break;

	case 'request':
		$input = &$_REQUEST;
		break;

	case 'session':
		$input = &$_SESSION;
		break;

	case 'cookie':
		$input = &$_COOKIE;
		break;

	case 'server':
		$input = &$_SERVER;
		break;

	case 'globals':
		$input = &$GLOBALS;
		break;

	default:
		return NULL;
	}

	if (c('VAR_FILTERS')) {
		$_filters = explode(',', c('VAR_FILTERS'));

		foreach ($_filters as $_filter) {
			array_walk_recursive($input, $_filter);
		}
	}

	if (empty($name)) {
		$data = $input;
		$filters = (isset($filter) ? $filter : c('DEFAULT_FILTER'));

		if ($filters) {
			$filters = explode(',', $filters);

			foreach ($filters as $filter) {
				$data = array_map($filter, $data);
			}
		}
	}
	else if (isset($input[$name])) {
		$data = $input[$name];
		$filters = (isset($filter) ? $filter : c('DEFAULT_FILTER'));

		if ($filters) {
			$filters = explode(',', $filters);

			foreach ($filters as $filter) {
				if (function_exists($filter)) {
					$data = (is_array($data) ? array_map_recursive($filter, $data) : $filter($data));
				}
				else {
					$data = filter_var($data, is_int($filter) ? $filter : filter_id($filter));

					if (false === $data) {
						return isset($default) ? $default : NULL;
					}
				}
			}
		}
	}
	else {
		$data = (isset($default) ? $default : NULL);
	}

	is_array($data) && array_walk_recursive($data, 'touch_filter');
	return $data;
}

function array_map_recursive($filter, $data)
{
	$result = array();

	foreach ($data as $key => $val) {
		$result[$key] = is_array($val) ? array_map_recursive($filter, $val) : call_user_func($filter, $val);
	}

	return $result;
}

function G($start, $end = '', $dec = 4)
{
	static $_info = array();
	static $_mem = array();

	if (is_float($end)) {
		$_info[$start] = $end;
	}
	else if (!empty($end)) {
		if (!isset($_info[$end])) {
			$_info[$end] = microtime(true);
		}

		if (MEMORY_LIMIT_ON && ($dec == 'm')) {
			if (!isset($_mem[$end])) {
				$_mem[$end] = memory_get_usage();
			}

			return number_format(($_mem[$end] - $_mem[$start]) / 1024);
		}
		else {
			return number_format($_info[$end] - $_info[$start], $dec);
		}
	}
	else {
		$_info[$start] = microtime(true);

		if (MEMORY_LIMIT_ON) {
			$_mem[$start] = memory_get_usage();
		}
	}
}

function N($key, $step = 0, $save = false)
{
	static $_num = array();

	if (!isset($_num[$key])) {
		$_num[$key] = false !== $save ? s('N_' . $key) : 0;
	}

	if (empty($step)) {
		return $_num[$key];
	}
	else {
		$_num[$key] = $_num[$key] + (int) $step;
	}

	if (false !== $save) {
		s('N_' . $key, $_num[$key], $save);
	}
}

function parse_name($name, $type = 0)
{
	if ($type) {
		return ucfirst(preg_replace('/_([a-zA-Z])/e', 'strtoupper(\'\\1\')', $name));
	}
	else {
		return strtolower(trim(preg_replace('/[A-Z]/', '_\\0', $name), '_'));
	}
}

function require_cache($filename)
{
	static $_importFiles = array();

	if (!isset($_importFiles[$filename])) {
		if (file_exists_case($filename)) {
			require $filename;
			$_importFiles[$filename] = true;
		}
		else {
			$_importFiles[$filename] = false;
		}
	}

	return $_importFiles[$filename];
}

function require_array($array, $return = false)
{
	foreach ($array as $file) {
		if (require_cache($file) && $return) {
			return true;
		}
	}

	if ($return) {
		return false;
	}
}

function file_exists_case($filename)
{
	if (is_file($filename)) {
		if (IS_WIN && c('APP_FILE_CASE')) {
			if (basename(realpath($filename)) != basename($filename)) {
				return false;
			}
		}

		return true;
	}

	return false;
}

function M($name = '', $tablePrefix = '', $connection = '')
{
	static $_model = array();

	if (strpos($name, ':')) {
		list($class, $name) = explode(':', $name);
	}
	else {
		$class = 'Model';
	}

	$guid = $tablePrefix . $name . '_' . $class;

	if (!isset($_model[$guid])) {
		$_model[$guid] = new $class($name, $tablePrefix, $connection);
	}

	return $_model[$guid];
}

function L($name = NULL, $value = NULL)
{
	static $_lang = array();

	if (empty($name)) {
		return $_lang;
	}

	if (is_string($name)) {
		$name = strtoupper($name);

		if (is_null($value)) {
			return isset($_lang[$name]) ? $_lang[$name] : $name;
		}

		$_lang[$name] = $value;
		return NULL;
	}

	if (is_array($name)) {
		$_lang = array_merge($_lang, array_change_key_case($name, CASE_UPPER));
	}

	return NULL;
}

function array_define($array, $check = true)
{
	$content = "\n";

	foreach ($array as $key => $val) {
		$key = strtoupper($key);

		if ($check) {
			$content .= 'defined(\'' . $key . '\') or ';
		}

		if (is_int($val) || is_float($val)) {
			$content .= 'define(\'' . $key . '\',' . $val . ');';
		}
		else if (is_bool($val)) {
			$val = ($val ? 'true' : 'false');
			$content .= 'define(\'' . $key . '\',' . $val . ');';
		}
		else if (is_string($val)) {
			$content .= 'define(\'' . $key . '\',\'' . addslashes($val) . '\');';
		}

		$content .= "\n";
	}

	return $content;
}

function logResult($word = '')
{
	$fp = fopen('log.txt', 'a');
	flock($fp, LOCK_EX);
	fwrite($fp, '执行日期：' . strftime('%Y%m%d%H%M%S', time()) . "\n" . $word . "\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}


?>
