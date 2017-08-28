<?php
//dezend by  QQ:2172298892
namespace apps\oauth\controllers;

class IndexController extends \apps\base\controllers\FrontendController
{
	public function __construct()
	{
		parent::__construct();
		$this->load_helper('passport');
	}

	public function actionIndex()
	{
		$type = i('get.type');
		$back_url = i('get.back_url', '', 'urldecode');
		$file = ROOT_PATH . 'plugins/connect/' . $type . '.php';

		if (file_exists($file)) {
			include_once $file;
		}
		else {
			show_message('插件未启用', '返回上一页', u('user/login/index'));
		}

		$url = u('oauth/index/index', array('type' => $type, 'back_url' => empty($back_url) ? u('site/index/index') : $back_url), true);
		$config = $this->getOauthConfig($type);

		if (!$config) {
			show_message('插件未启用', '返回上一页', u('user/login/index'));
		}

		$obj = new $type($config);
		if (isset($_GET['code']) && ($_GET['code'] != '')) {
			if ($res = $obj->callback($url, $_GET['code'])) {
				if ($this->oauthLogin($res)) {
					$this->redirect($_GET['back_url']);
				}

				$this->doRegister($res, $_GET['back_url']);
			}
			else {
				show_message('授权回调失败', '返回上一页', u('user/login/index'));
			}

			return NULL;
		}

		$url = $obj->redirect($url);
		ecs_header('Location: ' . $url . "\n");
		exit();
	}

	public function actionBind()
	{
		if (IS_POST) {
			$username = i('username');
			$preg = (preg_match('#^13[\\d]{9}$|^14[5,7]{1}\\d{8}$|^15[^4]{1}\\d{8}$|^17[0,6,7,8]{1}\\d{8}$|^18[\\d]{9}$#', $username) ? true : false);

			if ($preg === true) {
				$user_name = $this->model->table('users')->field('user_name')->where(array('mobile_phone' => $username))->find();
				$username = $user_name['user_name'];
			}

			$pregg = (preg_match('/^([a-zA-Z0-9]+[_|\\_|\\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\\_|\\.]?)*[a-zA-Z0-9]+\\.[a-zA-Z]{2,3}$/', $username) ? true : false);

			if ($pregg === true) {
				$user_name = $this->model->table('users')->field('user_name')->where(array('email' => $username))->find();
				$username = $user_name['user_name'];
			}

			$password = i('password');
			$back_url = i('back_url');
			if (empty($username) || empty($password)) {
				show_message('请输入用户名或密码', '返回', '', 'error');
			}

			$bind_user_id = $this->users->check_user($username, $password);

			if (0 < $bind_user_id) {
				if (class_exists('\\apps\\wechat\\controllers\\IndexController')) {
					$condition = array('ect_uid' => $bind_user_id);
					$result = $this->db->table('wechat_user')->where($condition)->find();

					if (!empty($result)) {
						show_message('当前账号已经绑定了哦', '返回', '', 'error');
					}
				}

				$condition = array('user_id' => $_SESSION['user_id']);
				$userinfo = $this->db->table('users')->field('aite_id')->where($condition)->find();
				$condition_new = array('user_id' => $bind_user_id);
				$this->db->table('users')->data($userinfo)->where($condition_new)->update();
				$userinfo_old = array('aite_id' => '');
				$this->db->table('users')->data($userinfo_old)->where($condition)->update();

				if (class_exists('\\apps\\wechat\\controllers\\IndexController')) {
					if (isset($_SESSION['openid']) && !empty($_SESSION['openid'])) {
						$condition = array('openid' => $_SESSION['openid']);
						$this->db->table('wechat_user')->data(array('ect_uid' => $bind_user_id))->where($condition)->update();
					}
				}

				$this->doLogin($username);
				$back_url = (empty($back_url) ? u('user/index/index') : $back_url);
				$this->redirect($back_url);
			}
			else {
				show_message('账号绑定失败', '重新绑定', '', 'error');
			}
		}

		$this->assign('page_title', '绑定已有帐号');
		$this->display();
	}

	private function getOauthConfig($type)
	{
		$sql = 'SELECT auth_config FROM {pre}touch_auth WHERE `type` = \'' . $type . '\'';
		$info = $this->db->getRow($sql);

		if ($info) {
			$res = unserialize($info['auth_config']);
			$config = array();

			foreach ($res as $key => $value) {
				$config[$value['name']] = $value['value'];
			}

			return $config;
		}

		return false;
	}

	private function oauthLogin($res)
	{
		$condition['aite_id'] = $res['openid'];
		$userinfo = $this->db->table('users')->field('user_name')->where($condition)->find();

		if ($userinfo) {
			$this->doLogin($userinfo['user_name']);
			return true;
		}
		else {
			return false;
		}
	}

	private function doLogin($username)
	{
		$this->users->set_session($username);
		$this->users->set_cookie($username);
		update_user_info();
		recalculate_price();
	}

	private function doRegister($res, $back_url = '')
	{
		$username = $res['openid'];
		$password = mt_rand(100000, 999999);
		$email = time() . rand(100, 999) . '@' . get_top_domain();
		$extends = array('nick_name' => $res['name'], 'aite_id' => $res['openid'], 'sex' => $res['sex'], 'user_picture' => $res['avatar']);

		if (register($username, $password, $email, $extends) !== false) {
			if (class_exists('\\apps\\wechat\\controllers\\IndexController')) {
				if (isset($_SESSION['openid']) && !empty($_SESSION['openid'])) {
					$data = array('ect_uid' => $_SESSION['user_id']);
					$condition = array('openid' => $_SESSION['openid']);
					$this->db->table('wechat_user')->data($data)->where($condition)->update();
					$this->sendBonus();
				}
			}

			$back_url = (empty($back_url) ? u('site/index/index') : $back_url);
			$this->redirect($back_url);
		}
		else {
			show_message('授权注册失败', '重新注册', '', 'error');
		}

		return NULL;
	}

	private function sendBonus()
	{
		$rs = $this->db->query('SELECT name, keywords, command, config FROM {pre}wechat_extend WHERE command = \'bonus\' and enable = 1 and wechat_id = 1 ORDER BY id ASC');
		$addons = reset($rs);
		$file = ROOT_PATH . 'plugins/wechat/' . $addons['command'] . '/' . $addons['command'] . '.class.php';

		if (file_exists($file)) {
			require_once $file;
			$wechat = new $addons['command']();
			$data = $wechat->show($_SESSION['openid'], $addons);

			if (!empty($data)) {
				$wxinfo = model()->table('wechat')->field('id, token, appid, appsecret, encodingaeskey')->where(array('id' => 1, 'status' => 1))->find();
				$config['token'] = $wxinfo['token'];
				$config['appid'] = $wxinfo['appid'];
				$config['appsecret'] = $wxinfo['appsecret'];
				$config['encodingaeskey'] = $wxinfo['encodingaeskey'];
				$weObj = new \vendor\Wechat($config);
				$weObj->sendCustomMessage($data['content']);
			}
		}
	}
}

?>
