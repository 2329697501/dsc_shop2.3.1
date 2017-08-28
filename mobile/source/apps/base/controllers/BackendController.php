<?php
//dezend by  QQ:2172298892
namespace apps\base\controllers;

abstract class BackendController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		define('__TPL__', __ROOT__ . 'data/assets/console/');
		require BASE_PATH . 'config/constant.php';
		$helper_list = array('time', 'base', 'common', 'main', 'insert', 'goods');
		$this->load_helper($helper_list);
		$this->db_config = \base\Config::get('DB.default');
		$this->ecs = $GLOBALS['ecs'] = new \classes\ecshop($this->db_config['DB_NAME'], $this->db_config['DB_PREFIX']);
		$this->db = $GLOBALS['db'] = new \classes\mysql();

		if (!defined('INIT_NO_USERS')) {
			$this->sess = $GLOBALS['sess'] = new \classes\session($this->db, $this->ecs->table('sessions'), $this->ecs->table('sessions_data'));
			define('SESS_ID', $this->sess->get_session_id());
			if (isset($_SESSION['admin_id']) && empty($_SESSION['admin_id']) && isset($_SESSION['admin_name']) && !empty($_SESSION['admin_name'])) {
				$condition['user_name'] = $_SESSION['admin_name'];
				$_SESSION['admin_id'] = $this->model->table('admin_user')->field('user_id')->where($condition)->one();
			}
		}

		$this->checkLogin();
	}

	public function display($tpl = '', $return = false, $isTpl = true)
	{
		$tpl = $this->getTpl($tpl, $isTpl);
		return parent::display($tpl, $return, $isTpl);
	}

	public function message($msg, $url = NULL, $type = '1', $waitSecond = 3)
	{
		if ($url == NULL) {
			$url = 'javascript:history.back();';
		}

		if ($type == '2') {
			$title = '错误信息';
		}
		else {
			$title = '提示信息';
		}

		$data['title'] = $title;
		$data['message'] = $msg;
		$data['type'] = $type;
		$data['url'] = $url;
		$data['second'] = $waitSecond;
		$this->assign('data', $data);
		$this->display('admin/message');
		exit();
	}

	protected function ectouchUpload($key = '', $upload_dir = 'images')
	{
		$config = array('maxSize' => 1024 * 1024 * 2, 'allowExts' => explode(',', 'jpg,jpeg,gif,png,bmp,mp3,amr,mp4'), 'rootPath' => ROOT_PATH, 'savePath' => 'data/attached/' . $upload_dir . '/');
		$upload = new \libraries\Upload($config);

		if (!$upload->upload($key)) {
			return array('error' => 1, 'message' => $upload->getError());
		}
		else {
			return array('error' => 0, 'message' => $upload->getUploadFileInfo());
		}
	}

	private function checkLogin()
	{
		$condition['user_id'] = isset($_SESSION['admin_id']) ? intval($_SESSION['admin_id']) : 0;
		$action_list = $this->model->table('admin_user')->field('action_list')->where($condition)->one();
		if (empty($action_list) && (strpos(APP_NAME, $action_list) === FALSE) && ($action_list != 'all')) {
			$this->redirect('../admin/index.php?act=main');
		}
	}

	private function getTpl($tpl = '', $isTpl = false)
	{
		if ($isTpl) {
			$tpl = (empty($tpl) ? strtolower(CONTROLLER_NAME) . c('TPL.TPL_DEPR') . strtolower(ACTION_NAME) : $tpl);
			$base_themes = ROOT_PATH . 'source/apps/base/views/';

			if (file_exists($base_themes . $tpl . c('TPL.TPL_SUFFIX'))) {
				$tpl = 'source/apps/base/views/' . $tpl;
			}
			else {
				$tpl = 'source/apps/' . APP_NAME . '/views/' . $tpl;
			}
		}

		return $tpl;
	}

	public function admin_priv($priv_str, $msg_type = '', $msg_output = true)
	{
		$condition['user_id'] = isset($_SESSION['admin_id']) ? intval($_SESSION['admin_id']) : 0;
		$action_list = $this->model->table('admin_user')->field('action_list')->where($condition)->one();
		if (empty($action_list) || ((stripos($action_list, $priv_str) === FALSE) && ($action_list != 'all'))) {
			$this->redirect('../admin/index.php?act=main');
		}
	}
}

?>
