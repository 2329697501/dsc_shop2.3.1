<?php
//dezend by  QQ:2172298892
namespace apps\oauth\controllers;

class AdminController extends \apps\base\controllers\BackendController
{
	public function actionIndex()
	{
		$modules = $this->read_modules(BASE_PATH . 'modules/connect');

		foreach ($modules as $key => $value) {
			$modules[$key]['install'] = $this->model->table('touch_auth')->where(array('type' => $value['type']))->count();
		}

		$this->assign('modules', $modules);
		$this->display();
	}

	public function actionInstall()
	{
		if (IS_POST) {
			$data['type'] = i('type');
			$cfg_value = i('cfg_value');
			$cfg_name = i('cfg_name');
			$cfg_type = i('cfg_type');
			$cfg_label = i('cfg_label');
			$auth_config = array();
			if (isset($cfg_value) && is_array($cfg_value)) {
				for ($i = 0; $i < count($cfg_value); $i++) {
					$auth_config[] = array('name' => trim($cfg_name[$i]), 'type' => trim($cfg_type[$i]), 'value' => trim($cfg_value[$i]));
				}
			}

			$data['auth_config'] = serialize($auth_config);
			$this->model->table('touch_auth')->data($data)->insert();
			$this->message('安装成功', u('index'));
			return NULL;
		}

		$type = i('type');
		$oauth_config = $this->getOauthConfig($type);

		if ($oauth_config !== false) {
			$this->redirect(u('index'));
		}

		$filepath = BASE_PATH . 'modules/connect/' . $type . '.php';

		if (file_exists($filepath)) {
			$set_modules = true;
			include_once $filepath;
			$info = $modules[$i];

			foreach ($info['config'] as $key => $value) {
				$info['config'][$key] = $value + array('label' => l($value['name']));
			}
		}

		$this->assign('info', $info);
		$this->assign('ur_here', '插件安装');
		$this->display();
	}

	public function actionEdit()
	{
		if (IS_POST) {
			$data['type'] = i('type');
			$cfg_value = i('cfg_value');
			$cfg_name = i('cfg_name');
			$cfg_type = i('cfg_type');
			$cfg_label = i('cfg_label');
			$auth_config = array();
			if (isset($cfg_value) && is_array($cfg_value)) {
				for ($i = 0; $i < count($cfg_value); $i++) {
					$auth_config[] = array('name' => trim($cfg_name[$i]), 'type' => trim($cfg_type[$i]), 'value' => trim($cfg_value[$i]));
				}
			}

			$data['auth_config'] = serialize($auth_config);
			$this->model->table('touch_auth')->data($data)->where(array('type' => $data['type']))->update();
			$this->message('编辑成功', u('index'));
			return NULL;
		}

		$type = i('type');
		$oauth_config = $this->getOauthConfig($type);

		if ($oauth_config === false) {
			$this->redirect(u('index'));
		}

		$filepath = BASE_PATH . 'modules/connect/' . $type . '.php';

		if (file_exists($filepath)) {
			$set_modules = true;
			include_once $filepath;
			$info = $modules[$i];

			foreach ($info['config'] as $key => $value) {
				$info['config'][$key] = $value + array('label' => l($value['name']));
			}
		}

		foreach ($info['config'] as $key => $value) {
			if (isset($oauth_config[$value['name']])) {
				$info['config'][$key]['value'] = $oauth_config[$value['name']];
			}
			else {
				$info['config'][$key]['value'] = $value['value'];
			}
		}

		$this->assign('info', $info);
		$this->assign('ur_here', '编辑插件');
		$this->display();
	}

	public function actionUninstall()
	{
		$condition['type'] = i('type');
		$this->model->table('touch_auth')->where($condition)->delete();
		$this->message('卸载成功', u('index'));
	}

	private function getOauthConfig($type)
	{
		$condition['type'] = $type;
		$info = $this->model->table('touch_auth')->field('auth_config')->where($condition)->find();

		if ($info) {
			$user = unserialize($info['auth_config']);
			$config = array();

			foreach ($user as $key => $value) {
				$config[$value['name']] = $value['value'];
			}

			return $config;
		}

		return false;
	}

	private function read_modules($directory = '.')
	{
		$dir = @opendir($directory);
		$set_modules = true;
		$modules = array();

		while (false !== ($file = @readdir($dir))) {
			if (preg_match('/^.*?\\.php$/', $file)) {
				include_once $directory . '/' . $file;
			}
		}

		@closedir($dir);
		unset($set_modules);

		foreach ($modules as $key => $value) {
			ksort($modules[$key]);
		}

		ksort($modules);
		return $modules;
	}
}

?>
