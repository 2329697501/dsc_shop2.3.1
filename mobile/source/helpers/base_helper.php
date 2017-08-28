<?php
//dezend by  QQ:2172298892
function sub_str($str, $length = 0, $append = true)
{
	$str = trim($str);
	$strlength = strlen($str);
	if (($length == 0) || ($strlength <= $length)) {
		return $str;
	}
	else if ($length < 0) {
		$length = $strlength + $length;

		if ($length < 0) {
			$length = $strlength;
		}
	}

	if (function_exists('mb_substr')) {
		$newstr = mb_substr($str, 0, $length, CHARSET);
	}
	else if (function_exists('iconv_substr')) {
		$newstr = iconv_substr($str, 0, $length, CHARSET);
	}
	else {
		$newstr = substr($str, 0, $length);
	}

	if ($append && ($str != $newstr)) {
		$newstr .= '...';
	}

	return $newstr;
}

function real_ip()
{
	static $realip;

	if ($realip !== NULL) {
		return $realip;
	}

	if (isset($_SERVER)) {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

			foreach ($arr as $ip) {
				$ip = trim($ip);

				if ($ip != 'unknown') {
					$realip = $ip;
					break;
				}
			}
		}
		else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$realip = $_SERVER['HTTP_CLIENT_IP'];
		}
		else if (isset($_SERVER['REMOTE_ADDR'])) {
			$realip = $_SERVER['REMOTE_ADDR'];
		}
		else {
			$realip = '0.0.0.0';
		}
	}
	else if (getenv('HTTP_X_FORWARDED_FOR')) {
		$realip = getenv('HTTP_X_FORWARDED_FOR');
	}
	else if (getenv('HTTP_CLIENT_IP')) {
		$realip = getenv('HTTP_CLIENT_IP');
	}
	else {
		$realip = getenv('REMOTE_ADDR');
	}

	preg_match('/[\\d\\.]{7,15}/', $realip, $onlineip);
	$realip = (!empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0');
	return $realip;
}

function str_len($str)
{
	$length = strlen(preg_replace('/[\\x00-\\x7F]/', '', $str));

	if ($length) {
		return (strlen($str) - $length) + (intval($length / 3) * 2);
	}
	else {
		return strlen($str);
	}
}

function get_crlf()
{
	if (stristr($_SERVER['HTTP_USER_AGENT'], 'Win')) {
		$the_crlf = '\\r\\n';
	}
	else if (stristr($_SERVER['HTTP_USER_AGENT'], 'Mac')) {
		$the_crlf = '\\r';
	}
	else {
		$the_crlf = '\\n';
	}

	return $the_crlf;
}

function sendmail()
{
	$email = new Email();
}

function send_mail($name, $email, $subject, $content, $type = 0, $notification = false)
{
	if ($GLOBALS['_CFG']['mail_charset'] != CHARSET) {
		$name = ecs_iconv(CHARSET, $GLOBALS['_CFG']['mail_charset'], $name);
		$subject = ecs_iconv(CHARSET, $GLOBALS['_CFG']['mail_charset'], $subject);
		$content = ecs_iconv(CHARSET, $GLOBALS['_CFG']['mail_charset'], $content);
		$shop_name = ecs_iconv(CHARSET, $GLOBALS['_CFG']['mail_charset'], $GLOBALS['_CFG']['shop_name']);
	}

	$charset = $GLOBALS['_CFG']['mail_charset'];
	if (($GLOBALS['_CFG']['mail_service'] == 0) && function_exists('mail')) {
		$content_type = ($type == 0 ? 'Content-Type: text/plain; charset=' . $charset : 'Content-Type: text/html; charset=' . $charset);
		$headers = array();
		$headers[] = 'From: "' . '=?' . $charset . '?B?' . base64_encode($shop_name) . '?=' . '" <' . $GLOBALS['_CFG']['smtp_mail'] . '>';
		$headers[] = $content_type . '; format=flowed';

		if ($notification) {
			$headers[] = 'Disposition-Notification-To: ' . '=?' . $charset . '?B?' . base64_encode($shop_name) . '?=' . '" <' . $GLOBALS['_CFG']['smtp_mail'] . '>';
		}

		$res = @mail($email, '=?' . $charset . '?B?' . base64_encode($subject) . '?=', $content, implode("\r\n", $headers));

		if (!$res) {
			$GLOBALS['err']->add($GLOBALS['_LANG']['sendemail_false']);
			return false;
		}
		else {
			return true;
		}
	}
	else {
		$content_type = ($type == 0 ? 'Content-Type: text/plain; charset=' . $charset : 'Content-Type: text/html; charset=' . $charset);
		$headers = array();
		$headers[] = 'Date: ' . gmdate('D, j M Y H:i:s') . ' +0000';
		$headers[] = 'To: "' . '=?' . $charset . '?B?' . base64_encode($name) . '?=' . '" <' . $email . '>';
		$headers[] = 'From: "' . '=?' . $charset . '?B?' . base64_encode($shop_name) . '?=' . '" <' . $GLOBALS['_CFG']['smtp_mail'] . '>';
		$headers[] = 'Subject: ' . '=?' . $charset . '?B?' . base64_encode($subject) . '?=';
		$headers[] = $content_type . '; format=flowed';
		$headers[] = 'Content-Transfer-Encoding: base64';
		$headers[] = 'Content-Disposition: inline';

		if ($notification) {
			$headers[] = 'Disposition-Notification-To: ' . '=?' . $charset . '?B?' . base64_encode($shop_name) . '?=' . '" <' . $GLOBALS['_CFG']['smtp_mail'] . '>';
		}

		$params['smtp_host'] = $GLOBALS['_CFG']['smtp_host'];
		$params['smtp_port'] = $GLOBALS['_CFG']['smtp_port'];
		$params['smtp_ssl'] = $GLOBALS['_CFG']['smtp_ssl'];
		$params['smtp_username'] = $GLOBALS['_CFG']['smtp_user'];
		$params['smtp_password'] = $GLOBALS['_CFG']['smtp_pass'];
		$params['smtp_from_to'] = $GLOBALS['_CFG']['smtp_user'];
		$params['smtp_from_name'] = $shop_name;
		if (empty($params['smtp_host']) || empty($params['smtp_host'])) {
			$GLOBALS['err']->add($GLOBALS['_LANG']['smtp_setting_error']);
			return false;
		}
		else {
			if (!function_exists('fsockopen')) {
				$GLOBALS['err']->add($GLOBALS['_LANG']['disabled_fsockopen']);
				return false;
			}

			static $smtp;
			$send_params['recipients'] = $email;
			$send_params['headers'] = $headers;
			$send_params['from'] = $GLOBALS['_CFG']['smtp_mail'];
			$send_params['body'] = $content;

			if (!isset($smtp)) {
				$smtp = new \libraries\send\EmailDriver($params);
			}

			$res = $smtp->push($email, '[' . $shop_name . ']' . $subject, $content);

			if ($res) {
				return true;
			}
			else {
				$err_msg = $smtp->getError();

				if (empty($err_msg)) {
					$GLOBALS['err']->add('Unknown Error');
				}
				else if (strpos($err_msg, 'Failed to connect to server') !== false) {
					$GLOBALS['err']->add(sprintf($GLOBALS['_LANG']['smtp_connect_failure'], $params['host'] . ':' . $params['port']));
				}
				else if (strpos($err_msg, 'AUTH command failed') !== false) {
					$GLOBALS['err']->add($GLOBALS['_LANG']['smtp_login_failure']);
				}
				else if (strpos($err_msg, 'bad sequence of commands') !== false) {
					$GLOBALS['err']->add($GLOBALS['_LANG']['smtp_refuse']);
				}
				else {
					$GLOBALS['err']->add($err_msg);
				}

				return false;
			}
		}
	}
}

function gd_version()
{
	return \classes\image::gd_version();
}

function file_mode_info($file_path)
{
	if (!file_exists($file_path)) {
		return false;
	}

	$mark = 0;

	if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
		$test_file = $file_path . '/cf_test.txt';

		if (is_dir($file_path)) {
			$dir = @opendir($file_path);

			if ($dir === false) {
				return $mark;
			}

			if (@readdir($dir) !== false) {
				$mark ^= 1;
			}

			@closedir($dir);
			$fp = @fopen($test_file, 'wb');

			if ($fp === false) {
				return $mark;
			}

			if (@fwrite($fp, 'directory access testing.') !== false) {
				$mark ^= 2;
			}

			@fclose($fp);
			@unlink($test_file);
			$fp = @fopen($test_file, 'ab+');

			if ($fp === false) {
				return $mark;
			}

			if (@fwrite($fp, "modify test.\r\n") !== false) {
				$mark ^= 4;
			}

			@fclose($fp);

			if (@rename($test_file, $test_file) !== false) {
				$mark ^= 8;
			}

			@unlink($test_file);
		}
		else if (is_file($file_path)) {
			$fp = @fopen($file_path, 'rb');

			if ($fp) {
				$mark ^= 1;
			}

			@fclose($fp);
			$fp = @fopen($file_path, 'ab+');
			if ($fp && (@fwrite($fp, '') !== false)) {
				$mark ^= 6;
			}

			@fclose($fp);

			if (@rename($test_file, $test_file) !== false) {
				$mark ^= 8;
			}
		}
	}
	else {
		if (@is_readable($file_path)) {
			$mark ^= 1;
		}

		if (@is_writable($file_path)) {
			$mark ^= 14;
		}
	}

	return $mark;
}

function log_write($arg, $file = '', $line = '')
{
	if ((DEBUG_MODE & 4) != 4) {
		return NULL;
	}

	$str = "\r\n-- " . date('Y-m-d H:i:s') . " --------------------------------------------------------------\r\n";
	$str .= 'FILE: ' . $file . "\r\nLINE: " . $line . "\r\n";

	if (is_array($arg)) {
		$str .= '$arg = array(';

		foreach ($arg as $val) {
			foreach ($val as $key => $list) {
				$str .= '\'' . $key . '\' => \'' . $list . "'\r\n";
			}
		}

		$str .= ")\r\n";
	}
	else {
		$str .= $arg;
	}

	file_put_contents(ROOT_PATH . DATA_DIR . '/log.txt', $str);
}

function make_dir($folder)
{
	$reval = false;

	if (!file_exists($folder)) {
		@umask(0);
		preg_match_all('/([^\\/]*)\\/?/i', $folder, $atmp);
		$base = ($atmp[0][0] == '/' ? '/' : '');

		foreach ($atmp[1] as $val) {
			if ('' != $val) {
				$base .= $val;
				if (('..' == $val) || ('.' == $val)) {
					$base .= '/';
					continue;
				}
			}
			else {
				continue;
			}

			$base .= '/';

			if (!file_exists($base)) {
				if (@mkdir(rtrim($base, '/'), 511)) {
					@chmod($base, 511);
					$reval = true;
				}
			}
		}
	}
	else {
		$reval = is_dir($folder);
	}

	clearstatcache();
	return $reval;
}

function gzip_enabled()
{
	static $enabled_gzip;

	if ($enabled_gzip === NULL) {
		$enabled_gzip = $GLOBALS['_CFG']['enable_gzip'] && function_exists('ob_gzhandler');
	}

	return $enabled_gzip;
}

function addslashes_deep($value)
{
	if (empty($value)) {
		return $value;
	}
	else {
		return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
	}
}

function addslashes_deep_obj($obj)
{
	if (is_object($obj) == true) {
		foreach ($obj as $key => $val) {
			$obj->$key = addslashes_deep($val);
		}
	}
	else {
		$obj = addslashes_deep($obj);
	}

	return $obj;
}

function stripslashes_deep($value)
{
	if (empty($value)) {
		return $value;
	}
	else {
		return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	}
}

function make_semiangle($str)
{
	$arr = array('ï¼? => '0', 'ï¼? => '1', 'ï¼? => '2', 'ï¼? => '3', 'ï¼? => '4', 'ï¼? => '5', 'ï¼? => '6', 'ï¼? => '7', 'ï¼? => '8', 'ï¼? => '9', 'ï¼? => 'A', 'ï¼? => 'B', 'ï¼? => 'C', 'ï¼? => 'D', 'ï¼? => 'E', 'ï¼? => 'F', 'ï¼? => 'G', 'ï¼? => 'H', 'ï¼? => 'I', 'ï¼? => 'J', 'ï¼? => 'K', 'ï¼? => 'L', 'ï¼? => 'M', 'ï¼? => 'N', 'ï¼? => 'O', 'ï¼? => 'P', 'ï¼? => 'Q', 'ï¼? => 'R', 'ï¼? => 'S', 'ï¼? => 'T', 'ï¼? => 'U', 'ï¼? => 'V', 'ï¼? => 'W', 'ï¼? => 'X', 'ï¼? => 'Y', 'ï¼? => 'Z', 'ï½? => 'a', 'ï½? => 'b', 'ï½? => 'c', 'ï½? => 'd', 'ï½? => 'e', 'ï½? => 'f', 'ï½? => 'g', 'ï½? => 'h', 'ï½? => 'i', 'ï½? => 'j', 'ï½? => 'k', 'ï½? => 'l', 'ï½? => 'm', 'ï½? => 'n', 'ï½? => 'o', 'ï½? => 'p', 'ï½? => 'q', 'ï½? => 'r', 'ï½? => 's', 'ï½? => 't', 'ï½? => 'u', 'ï½? => 'v', 'ï½? => 'w', 'ï½? => 'x', 'ï½? => 'y', 'ï½? => 'z', 'ï¼? => '(', 'ï¼? => ')', 'ã€? => '[', 'ã€? => ']', 'ã€? => '[', 'ã€? => ']', 'ã€? => '[', 'ã€? => ']', 'â€? => '[', 'â€? => ']', 'â€? => '[', 'â€? => ']', 'ï½? => '{', 'ï½? => '}', 'ã€? => '<', 'ã€? => '>', 'ï¼? => '%', 'ï¼? => '+', 'â€? => '-', 'ï¼? => '-', 'ï½? => '-', 'ï¼? => ':', 'ã€? => '.', 'ã€? => ',', 'ï¼? => '.', 'ã€? => '.', 'ï¼? => ',', 'ï¼? => '?', 'ï¼? => '!', 'â€? => '-', 'â€? => '|', 'â€? => '"', 'â€? => '`', 'â€? => '`', 'ï½? => '|', 'ã€? => '"', 'ã€€' => ' ');
	return strtr($str, $arr);
}

function compile_str($str)
{
	$arr = array('<' => 'ï¼?, '>' => 'ï¼?, '"' => 'â€?, '\'' => 'â€?);
	return strtr($str, $arr);
}

function check_file_type($filename, $realname = '', $limit_ext_types = '')
{
	if ($realname) {
		$extname = strtolower(substr($realname, strrpos($realname, '.') + 1));
	}
	else {
		$extname = strtolower(substr($filename, strrpos($filename, '.') + 1));
	}

	if ($limit_ext_types && (stristr($limit_ext_types, '|' . $extname . '|') === false)) {
		return '';
	}

	$str = $format = '';
	$file = @fopen($filename, 'rb');

	if ($file) {
		$str = @fread($file, 1024);
		@fclose($file);
	}
	else if (stristr($filename, ROOT_PATH) === false) {
		if (($extname == 'jpg') || ($extname == 'jpeg') || ($extname == 'gif') || ($extname == 'png') || ($extname == 'doc') || ($extname == 'xls') || ($extname == 'txt') || ($extname == 'zip') || ($extname == 'rar') || ($extname == 'ppt') || ($extname == 'pdf') || ($extname == 'rm') || ($extname == 'mid') || ($extname == 'wav') || ($extname == 'bmp') || ($extname == 'swf') || ($extname == 'chm') || ($extname == 'sql') || ($extname == 'cert') || ($extname == 'pptx') || ($extname == 'xlsx') || ($extname == 'docx')) {
			$format = $extname;
		}
	}
	else {
		return '';
	}

	if (($format == '') && (2 <= strlen($str))) {
		if ((substr($str, 0, 4) == 'MThd') && ($extname != 'txt')) {
			$format = 'mid';
		}
		else {
			if ((substr($str, 0, 4) == 'RIFF') && ($extname == 'wav')) {
				$format = 'wav';
			}
			else if (substr($str, 0, 3) == "\xff\xd8\xff") {
				$format = 'jpg';
			}
			else {
				if ((substr($str, 0, 4) == 'GIF8') && ($extname != 'txt')) {
					$format = 'gif';
				}
				else if (substr($str, 0, 8) == "‰PNG\r\n\x1a\n") {
					$format = 'png';
				}
				else {
					if ((substr($str, 0, 2) == 'BM') && ($extname != 'txt')) {
						$format = 'bmp';
					}
					else {
						if (((substr($str, 0, 3) == 'CWS') || (substr($str, 0, 3) == 'FWS')) && ($extname != 'txt')) {
							$format = 'swf';
						}
						else if (substr($str, 0, 4) == "\xd0\xcf\x11\xe0") {
							if ((substr($str, 512, 4) == "\xec\xa5\xc1\x00") || ($extname == 'doc')) {
								$format = 'doc';
							}
							else {
								if ((substr($str, 512, 2) == "\t\x08") || ($extname == 'xls')) {
									$format = 'xls';
								}
								else {
									if ((substr($str, 512, 4) == "\xfd\xff\xff\xff") || ($extname == 'ppt')) {
										$format = 'ppt';
									}
								}
							}
						}
						else if (substr($str, 0, 4) == "PK\x03\x04") {
							if ((substr($str, 512, 4) == "\xec\xa5\xc1\x00") || ($extname == 'docx')) {
								$format = 'docx';
							}
							else {
								if ((substr($str, 512, 2) == "\t\x08") || ($extname == 'xlsx')) {
									$format = 'xlsx';
								}
								else {
									if ((substr($str, 512, 4) == "\xfd\xff\xff\xff") || ($extname == 'pptx')) {
										$format = 'pptx';
									}
									else {
										$format = 'zip';
									}
								}
							}
						}
						else {
							if ((substr($str, 0, 4) == 'Rar!') && ($extname != 'txt')) {
								$format = 'rar';
							}
							else if (substr($str, 0, 4) == '%PDF') {
								$format = 'pdf';
							}
							else if (substr($str, 0, 3) == "0\x82\n") {
								$format = 'cert';
							}
							else {
								if ((substr($str, 0, 4) == 'ITSF') && ($extname != 'txt')) {
									$format = 'chm';
								}
								else if (substr($str, 0, 4) == '.RMF') {
									$format = 'rm';
								}
								else if ($extname == 'sql') {
									$format = 'sql';
								}
								else if ($extname == 'txt') {
									$format = 'txt';
								}
							}
						}
					}
				}
			}
		}
	}

	if ($limit_ext_types && (stristr($limit_ext_types, '|' . $format . '|') === false)) {
		$format = '';
	}

	return $format;
}

function mysql_like_quote($str)
{
	return strtr($str, array('\\\\' => '\\\\\\\\', '_' => '\\_', '%' => '\\%', '\\\'' => '\\\\\\\''));
}

function real_server_ip()
{
	static $serverip;

	if ($serverip !== NULL) {
		return $serverip;
	}

	if (isset($_SERVER)) {
		if (isset($_SERVER['SERVER_ADDR'])) {
			$serverip = $_SERVER['SERVER_ADDR'];
		}
		else {
			$serverip = '0.0.0.0';
		}
	}
	else {
		$serverip = getenv('SERVER_ADDR');
	}

	return $serverip;
}

function ecs_header($string, $replace = true, $http_response_code = 0)
{
	if (strpos($string, '../upgrade/index.php') === 0) {
		echo '<script type="text/javascript">window.location.href="' . $string . '";</script>';
	}

	$string = str_replace(array("\r", "\n"), array('', ''), $string);

	if (preg_match('/^\\s*location:/is', $string)) {
		@header($string . "\n", $replace);
		exit();
	}

	if (empty($http_response_code) || (PHP_VERSION < '4.3')) {
		@header($string, $replace);
	}
	else {
		@header($string, $replace, $http_response_code);
	}
}

function ecs_iconv($source_lang, $target_lang, $source_string = '')
{
	static $chs;
	if (($source_lang == $target_lang) || ($source_string == '') || (preg_match("/[\x80-\xff]+/", $source_string) == 0)) {
		return $source_string;
	}

	if ($chs === NULL) {
		$chs = new \classes\iconv(ROOT_PATH);
	}

	return $chs->Convert($source_lang, $target_lang, $source_string);
}

function ecs_geoip($ip)
{
	static $fp;
	static $offset = array();
	static $index;
	$ip = gethostbyname($ip);
	$ipdot = explode('.', $ip);
	$ip = pack('N', ip2long($ip));
	$ipdot[0] = (int) $ipdot[0];
	$ipdot[1] = (int) $ipdot[1];
	if (($ipdot[0] == 10) || ($ipdot[0] == 127) || (($ipdot[0] == 192) && ($ipdot[1] == 168)) || (($ipdot[0] == 172) && (16 <= $ipdot[1]) && ($ipdot[1] <= 31))) {
		return 'LAN';
	}

	if ($fp === NULL) {
		$fp = fopen(ROOT_PATH . 'data/ipdata/ipdata.dat', 'rb');

		if ($fp === false) {
			return 'Invalid IP data file';
		}

		$offset = unpack('Nlen', fread($fp, 4));

		if ($offset['len'] < 4) {
			return 'Invalid IP data file';
		}

		$index = fread($fp, $offset['len'] - 4);
	}

	$length = $offset['len'] - 1028;
	$start = unpack('Vlen', $index[$ipdot[0] * 4] . $index[($ipdot[0] * 4) + 1] . $index[($ipdot[0] * 4) + 2] . $index[($ipdot[0] * 4) + 3]);

	for ($start = ($start['len'] * 8) + 1024; $start < $length; $start += 8) {
		if ($ip <= $index[$start] . $index[$start + 1] . $index[$start + 2] . $index[$start + 3]) {
			$index_offset = unpack('Vlen', $index[$start + 4] . $index[$start + 5] . $index[$start + 6] . "\x00");
			$index_length = unpack('Clen', $index[$start + 7]);
			break;
		}
	}

	fseek($fp, ($offset['len'] + $index_offset['len']) - 1024);
	$area = fread($fp, $index_length['len']);
	fclose($fp);
	$fp = NULL;
	return $area;
}

function trim_right($str)
{
	$len = strlen($str);
	if (($len == 0) || (ord($str[$len - 1]) < 127)) {
		return $str;
	}

	if (192 <= ord($str[$len - 1])) {
		return substr($str, 0, $len - 1);
	}

	$r_len = strlen(rtrim($str, "\x80..\xbf"));
	if (($r_len == 0) || (ord($str[$r_len - 1]) < 127)) {
		return sub_str($str, 0, $r_len);
	}

	$as_num = ord(~$str[$r_len - 1]);

	if ((1 << ((6 + $r_len) - $len)) < $as_num) {
		return $str;
	}
	else {
		return substr($str, 0, $r_len - 1);
	}
}

function move_upload_file($file_name, $target_name = '')
{
	if (function_exists('move_uploaded_file')) {
		if (move_uploaded_file($file_name, $target_name)) {
			@chmod($target_name, 493);
			return true;
		}
		else if (copy($file_name, $target_name)) {
			@chmod($target_name, 493);
			return true;
		}
	}
	else if (copy($file_name, $target_name)) {
		@chmod($target_name, 493);
		return true;
	}

	return false;
}

function json_str_iconv($str)
{
	if (CHARSET != 'utf-8') {
		if (is_string($str)) {
			return addslashes(stripslashes(ecs_iconv('utf-8', CHARSET, $str)));
		}
		else if (is_array($str)) {
			foreach ($str as $key => $value) {
				$str[$key] = json_str_iconv($value);
			}

			return $str;
		}
		else if (is_object($str)) {
			foreach ($str as $key => $value) {
				$str->$key = json_str_iconv($value);
			}

			return $str;
		}
		else {
			return $str;
		}
	}

	return $str;
}

function to_utf8_iconv($str)
{
	if (CHARSET != 'utf-8') {
		if (is_string($str)) {
			return ecs_iconv(CHARSET, 'utf-8', $str);
		}
		else if (is_array($str)) {
			foreach ($str as $key => $value) {
				$str[$key] = to_utf8_iconv($value);
			}

			return $str;
		}
		else if (is_object($str)) {
			foreach ($str as $key => $value) {
				$str->$key = to_utf8_iconv($value);
			}

			return $str;
		}
		else {
			return $str;
		}
	}

	return $str;
}

function get_file_suffix($file_name, $allow_type = array())
{
	$file_suffix = strtolower(array_pop(explode('.', $file_name)));

	if (empty($allow_type)) {
		return $file_suffix;
	}
	else if (in_array($file_suffix, $allow_type)) {
		return true;
	}
	else {
		return false;
	}
}

function read_static_cache($cache_name)
{
	if ((DEBUG_MODE & 2) == 2) {
		return false;
	}

	static $result = array();

	if (!empty($result[$cache_name])) {
		return $result[$cache_name];
	}

	if (($GLOBALS['cache']->cache == 'memcached') && (c('CACHE.memcached.CACHE_TYPE') == 'Memcached')) {
		$result[$cache_name] = $GLOBALS['cache']->get($cache_name);

		if ($result[$cache_name]) {
			return $result[$cache_name];
		}
		else {
			return false;
		}
	}
	else {
		$cache_file_path = CACHE_PATH . 'static/' . $cache_name . '.php';

		if (file_exists($cache_file_path)) {
			include_once $cache_file_path;
			$result[$cache_name] = $data;
			return $result[$cache_name];
		}
		else {
			return false;
		}
	}
}

function write_static_cache($cache_name, $caches)
{
	if ((DEBUG_MODE & 2) == 2) {
		return false;
	}

	if (($GLOBALS['cache']->cache == 'memcached') && (c('CACHE.memcached.CACHE_TYPE') == 'Memcached')) {
		$expire = c('CACHE_EXPIRE');
		$expire = (!empty($expire) ? $expire : 86400);
		$GLOBALS['cache']->set($cache_name, $caches, $expire);
	}
	else {
		$cache_file_path = CACHE_PATH . 'static/' . $cache_name . '.php';
		$content = "<?php\r\n";
		$content .= '$data = ' . var_export($caches, true) . ";\r\n";
		$content .= '?>';
		file_put_contents($cache_file_path, $content, LOCK_EX);
	}
}

function real_cart_mac_ip()
{
	static $realip;

	if ($realip !== NULL) {
		return $realip;
	}

	if (isset($_SERVER)) {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

			foreach ($arr as $ip) {
				$ip = trim($ip);

				if ($ip != 'unknown') {
					$realip = $ip;
					break;
				}
			}
		}
		else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$realip = $_SERVER['HTTP_CLIENT_IP'];
		}
		else if (isset($_SERVER['REMOTE_ADDR'])) {
			$realip = $_SERVER['REMOTE_ADDR'];
		}
		else {
			$realip = '0.0.0.0';
		}
	}
	else if (getenv('HTTP_X_FORWARDED_FOR')) {
		$realip = getenv('HTTP_X_FORWARDED_FOR');
	}
	else if (getenv('HTTP_CLIENT_IP')) {
		$realip = getenv('HTTP_CLIENT_IP');
	}
	else {
		$realip = getenv('REMOTE_ADDR');
	}

	preg_match('/[\\d\\.]{7,15}/', $realip, $onlineip);
	$realip = (!empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0');

	if ($_COOKIE['session_id_ip']) {
		$realip = $_COOKIE['session_id_ip'];
	}
	else {
		$realip = $realip . '_' . SESS_ID;
		$time = gmtime() + (3600 * 24 * 365);
		setcookie('session_id_ip', $realip, $time, '/');
	}

	return $realip;
}

function mdate($time = NULL)
{
	$text = '';
	$time = (($time === NULL) || (gmtime() < $time) ? gmtime() : intval($time));
	$t = gmtime() - $time;
	$y = date('Y', $time) - date('Y', gmtime());

	switch ($t) {
	case $t == 0:
		$text = 'åˆšåˆš';
		break;

	case $t < 60:
		$text = $t . 'ç§’å‰';
		break;

	case $t < (60 * 60):
		$text = floor($t / 60) . 'åˆ†é’Ÿå‰?;
		break;

	case $t < (60 * 60 * 24):
		$text = floor($t / (60 * 60)) . 'å°æ—¶å‰?;
		break;

	case $t < (60 * 60 * 24 * 3):
		$text = (floor($time / (60 * 60 * 24)) == 1 ? 'æ˜¨å¤© ' . date('H:i', $time) : 'å‰å¤© ' . date('H:i', $time));
		break;

	case $t < (60 * 60 * 24 * 30):
		$text = date('mæœˆdæ—?H:i', $time);
		break;

	case $y == 0:
		$text = date('mæœˆdæ—?, $time);
		break;

	default:
		$text = date('Yå¹´mæœˆdæ—?, $time);
		break;
	}

	return $text;
}

defined('BASE_PATH') || exit('No direct script access allowed');

if (!function_exists('file_get_contents')) {
	function file_get_contents($file)
	{
		if (($fp = @fopen($file, 'rb')) === false) {
			return false;
		}
		else {
			$fsize = @filesize($file);

			if ($fsize) {
				$contents = fread($fp, $fsize);
			}
			else {
				$contents = '';
			}

			fclose($fp);
			return $contents;
		}
	}
}

if (!function_exists('file_put_contents')) {
	define('FILE_APPEND', 'FILE_APPEND');
	function file_put_contents($file, $data, $flags = '')
	{
		$contents = (is_array($data) ? implode('', $data) : $data);

		if ($flags == 'FILE_APPEND') {
			$mode = 'ab+';
		}
		else {
			$mode = 'wb';
		}

		if (($fp = @fopen($file, $mode)) === false) {
			return false;
		}
		else {
			$bytes = fwrite($fp, $contents);
			fclose($fp);
			return $bytes;
		}
	}
}

if (!function_exists('floatval')) {
	function floatval($n)
	{
		return (double) $n;
	}
}

?>
