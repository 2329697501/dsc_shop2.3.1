<?php
//dezend by  QQ:2172298892
namespace apps\upgrade\controllers;

class IndexController extends \apps\base\controllers\BackendController
{
	private $md5_arr = array();
	private $_filearr = array('admin', 'api', 'include', 'plugins', '');
	private $_wechat = 'wechat';
	private $_extend = 'extend';
	private $cannotupgrade = 0;
	private $_upgrademd5 = 'http://www.ectouch.cn/upgrademd5/';
	private $_patchurl = '';

	public function __construct()
	{
		parent::__construct();
		$this->patch_charset = str_replace('-', '', CHARSET);
		$this->_patchurl = DATA_PATH . 'patch/';
		$this->upgrade_path_base = $this->_patchurl;
		defined('DS') || define('DS', DIRECTORY_SEPARATOR);
		defined('CACHE_PATH') || define('CACHE_PATH', ROOT_PATH . 'data/caches/');
		l(require ROOT_PATH . 'source/language/zh_cn/upgrade.php');
		$this->assign('lang', array_change_key_case(l()));
		$cache_dir_checking = $this->check_dirs_priv(CACHE_PATH);

		if ($cache_dir_checking['result'] === 'ERROR') {
			exit($cache_dir_checking['detail']);
		}

		$root_dir_checking = $this->check_dirs_priv(ROOT_PATH);

		if ($root_dir_checking['result'] === 'ERROR') {
			exit($root_dir_checking['detail']);
		}

		include_once ROOT_PATH . 'source/apps/' . APP_NAME . '/helpers/function_helper.php';
	}

	public function actionIndex()
	{
		$pathlist = $this->pathlist();
		$this->assign('pathlist', $pathlist);
		$this->assign('cannot', $this->cannotupgrade);
		$this->display('upgrade_index');
	}

	public function actionInit()
	{
		$do = i('get.do');
		$cover = i('cover', 0);

		if (empty($do)) {
			$this->message(l('upgradeing'), u('init', array('do' => 1, 'cover' => $cover)));
		}

		$pathlist = $this->pathlist();

		if (empty($pathlist)) {
			$this->message(l('upgrade_success'), u('index'));
		}

		if (!file_exists(CACHE_PATH . 'upgrade')) {
			@mkdir(CACHE_PATH . 'upgrade');
		}

		foreach ($pathlist as $k => $v) {
			$release = str_replace('R', '', basename($v, '.zip'));
			$upgradezip_url = $this->upgrade_path_base . $v;
			$upgradezip_path = CACHE_PATH . 'upgrade' . DS . $v;
			$upgradezip_source_path = CACHE_PATH . 'upgrade' . DS . basename($v, '.zip');
			file_put_contents($upgradezip_path, file_get_contents($upgradezip_url));
			$zip = new \libraries\Zip();

			if ($zip->decompress($upgradezip_path, $upgradezip_source_path) == 0) {
				exit('Error : unpack the failure.');
			}

			$copy_from = $upgradezip_source_path . DS . 'upload' . DS;
			$copy_to = ROOT_PATH;
			$this->copyfailnum = 0;
			$this->copydir($copy_from, $copy_to, $cover);

			if (0 < $this->copyfailnum) {
				$this->message(l('please_check_filepri'), u('index'));
			}

			$sql_path = CACHE_PATH . 'upgrade' . DS . basename($v, '.zip') . DS . 'upgrade' . DS;
			$file_list = glob($sql_path . '*');

			if (!empty($file_list)) {
				foreach ($file_list as $fk => $fv) {
					$file_path = strtolower($fv);
					if (in_array(substr($file_path, -3, 3), array('php', 'sql')) && (substr($file_path, -10, 10) != 'config.php')) {
						if (substr($file_path, -3, 3) == 'sql') {
							$sqlData = \libraries\Install::mysql($file_path, 'ecs_', c('DB_PREFIX'));

							if (is_array($sqlData)) {
								foreach ($sqlData as $sql) {
									$this->model->query($sql);
								}
							}
						}
						else {
							if ((strtolower(substr($file_list[$fk], -3, 3)) == 'php') && file_exists($file_path)) {
								include $file_path;
							}
						}
					}
				}
			}

			$configpath = CACHE_PATH . 'upgrade' . DS . basename($v, '.zip') . DS . 'upgrade' . DS . 'version.php';

			if (file_exists($configpath)) {
				$config = include $configpath;
				$content = @file_get_contents(ROOT_PATH . 'source/bootstrap.php');
				$content = str_replace(APPNAME, $config['APPNAME'], $content);
				$content = str_replace(VERSION, $config['VERSION'], $content);
				$content = str_replace(RELEASE, $release, $content);
				@file_put_contents(ROOT_PATH . 'source/bootstrap.php', $content);
			}

			@unlink($upgradezip_path);
			del_dir($upgradezip_source_path);
			$tmp_k = $k + 1;

			if (!empty($pathlist[$tmp_k])) {
				$next_update = '<br />' . l('upgradeing') . basename($pathlist[$tmp_k], '.zip');
				$this->message(basename($v, '.zip') . l('upgrade_success') . $next_update, u('init', array('do' => 1, 'cover' => $cover)));
			}
			else {
				$this->message(basename($v, '.zip') . l('upgrade_success'), u('site/index/index'));
			}
		}
	}

	private function copydir($dirfrom, $dirto, $cover = '')
	{
		if (is_file($dirto)) {
			exit(l('have_no_pri') . $dirto);
		}

		if (!file_exists($dirto)) {
			mkdir($dirto);
		}

		if (DS === '\\') {
			$dirfrom = str_replace('/', '\\', $dirfrom);
		}

		$handle = opendir($dirfrom);

		if ($handle === false) {
			$this->message(l('lost'), u('index'));
		}

		while (false !== ($file = readdir($handle))) {
			if (($file != '.') && ($file != '..')) {
				$filefrom = $dirfrom . DS . $file;
				$fileto = $dirto . DS . $file;

				if (is_dir($filefrom)) {
					$this->copydir($filefrom, $fileto, $cover);
				}
				else if (!empty($cover)) {
					if (!copy($filefrom, $fileto)) {
						$this->copyfailnum++;
						echo l('copy') . $filefrom . l('to') . $fileto . l('failed') . '<br />';
					}
				}
				else {
					if (get_file_suffix($fileto, array('dwt', 'lbi', 'html', 'htm')) && file_exists($fileto)) {
					}
					else if (!copy($filefrom, $fileto)) {
						$this->copyfailnum++;
						echo l('copy') . $filefrom . l('to') . $fileto . l('failed') . '<br />';
					}
				}
			}
		}
	}

	private function get_patchs()
	{
		$dir = opendir($this->upgrade_path_base);

		while ($file = readdir($dir)) {
			if (substr($file, -3, strlen('zip')) == 'zip') {
				$allpathlist[] = $file;
			}
		}

		asort($allpathlist);
		return $allpathlist;
	}

	private function pathlist()
	{
		if (stristr($this->upgrade_path_base, 'http')) {
			$pathlist_str = file_get_contents($this->upgrade_path_base);
			$pathlist = $allpathlist = array();
			$key = -1;
			preg_match_all('/"(R[\\w_]+\\.zip)"/', $pathlist_str, $allpathlist);
			$allpathlist = $allpathlist[1];
		}
		else {
			$allpathlist = $this->get_patchs();
		}

		foreach ($allpathlist as $k => $v) {
			$thisrelease[] = preg_replace('/\\D/s', '', $v);
		}

		if (!in_array(RELEASE, $thisrelease)) {
			$this->cannotupgrade = 1;
		}
		else {
			foreach ($allpathlist as $k => $v) {
				if (strstr($v, 'R' . RELEASE)) {
					$key = $k;
					break;
				}
			}

			$key = ($key < 0 ? 9999 : $key);

			foreach ($allpathlist as $k => $v) {
				if ($key < $k) {
					$pathlist[$k] = $v;
				}
			}
		}

		return $pathlist;
	}

	public function actionCheckfile()
	{
		$do = i('get.do', 0);

		if (!empty($do)) {
			$this->ec_readdir('.');
			$ectouch_md5 = \libraries\Http::doGet($this->_upgrademd5 . RELEASE . '.php');
			$ectouch_md5_arr = json_decode($ectouch_md5, 1);
			$ectouch_md5_arr = (empty($ectouch_md5_arr) ? array() : $ectouch_md5_arr);
			$diff = array_diff($ectouch_md5_arr, $this->md5_arr);
			$lostfile = array();

			foreach ($ectouch_md5_arr as $k => $v) {
				if (!in_array($k, array_keys($this->md5_arr))) {
					$lostfile[] = $k;
					unset($diff[$k]);
				}
			}

			$unknowfile = array_diff(array_keys($this->md5_arr), array_keys($ectouch_md5_arr));
			$this->assign('diff', $diff);
			$this->assign('lostfile', $lostfile);
			$this->assign('unknowfile', $unknowfile);
			$this->display();
		}
		else {
			$this->message(l('begin_checkfile'), u('checkfile', array('do' => 1)));
		}
	}

	public function actionBuildhash()
	{
		$this->ec_readdir('.');
		file_put_contents(CACHE_PATH . RELEASE . '.php', json_encode($this->md5_arr));
		$this->message(l('build_success'), u('index'));
	}

	private function ec_readdir($path = '')
	{
		$dir_arr = explode('/', dirname($path));

		if (is_dir($path)) {
			$handler = opendir($path);

			while (($filename = @readdir($handler)) !== false) {
				if (substr($filename, 0, 1) != '.') {
					$this->ec_readdir($path . '/' . $filename);
				}
			}

			closedir($handler);
		}
		else {
			if ((dirname($path) == '.') || (isset($dir_arr[1]) && in_array($dir_arr[1], $this->_filearr))) {
				$pos_wechat = strpos(strtolower($path), $this->_wechat);
				$pos_extend = strpos(strtolower($path), $this->_extend);
				if (($pos_wechat === false) && ($pos_extend === false)) {
					$this->md5_arr[base64_encode($path)] = md5_file($path);
				}
			}
		}
	}

	private function check_dirs_priv($checking_dirs)
	{
		$msgs = array(
			'result' => 'OK',
			'detail' => array()
			);

		if (!file_exists($checking_dirs)) {
			$msgs['result'] = 'ERROR';
			$msgs['detail'] = array($checking_dirs, l('not_exists'));
		}
		else if (file_mode_info($checking_dirs) < 2) {
			$msgs['result'] = 'ERROR';
			$msgs['detail'] = array($checking_dirs, l('cannt_write'));
		}
		else {
			$msgs['detail'] = array($checking_dirs, l('can_write'));
		}

		return $msgs;
	}
}

?>
