<?php
//dezend by  QQ:2172298892
namespace apps\user\controllers;

class LoginController extends \apps\base\controllers\FrontendController
{
	public $user;
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		l(require ROOT_PATH . 'source/language/' . c('shop.lang') . '/user.php');
		$file = array('passport', 'clips');
		$this->load_helper($file);
		$this->user_id = $_SESSION['user_id'];
	}

	public function actionIndex()
	{
		if (0 < $this->user_id) {
			$this->redirect(u('user/index/index'));
		}

		if (IS_POST) {
			$username = (isset($_POST['username']) ? trim($_POST['username']) : '');
			$password = (isset($_POST['password']) ? trim($_POST['password']) : '');
			$back_act = (isset($_POST['back_act']) ? trim($_POST['back_act']) : '');
			if (strpos($username, '@') && strpos($username, '.')) {
				$login = $this->db->getOne('SELECT user_name FROM {pre}users WHERE email=\'' . $username . '\'');

				if ($login) {
					$username = $login;
				}
			}
			else if ($this->isMobile($username)) {
				$login = $this->db->getOne('SELECT user_name FROM {pre}users WHERE mobile_phone=\'' . $username . '\'');

				if ($login) {
					$username = $login;
				}
			}

			if ($this->users->login($username, $password)) {
				update_user_info();
				recalculate_price();
				$ucdata = (isset($this->users->ucdata) ? $this->users->ucdata : '');
				$back_act = (empty($back_act) ? u('user/index/index') : $back_act);
				show_message(l('login_success') . $ucdata, array(l('back_up_page'), l('profile_lnk')), array($back_act, u('user/index/index')), 'success');
			}
			else {
				$_SESSION['login_fail']++;
				show_message(l('login_failure'), l('relogin_lnk'), u('user/login/index'), 'fail');
			}

			exit();
		}

		$back_act = urldecode(i('back_act'));

		if (empty($back_act)) {
			if (empty($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
				$back_act = (strpos($GLOBALS['_SERVER']['HTTP_REFERER'], u('user/index/index')) ? u('user/index/index') : $GLOBALS['_SERVER']['HTTP_REFERER']);
			}
			else {
				$back_act = u('user/index/index');
			}
		}

		$this->assign('back_act', $back_act);
		$this->assign('page_title', l('log_user'));
		$this->assign('passport_js', l('passport_js'));
		$this->display('user_login');
	}

	public function actionGetPasswordPhone()
	{
		$enabled_sms = i('enabled_sms');

		if (IS_POST) {
			if ($enabled_sms == 1) {
				$mobile = i('mobile', '');
				$sms_code = i('sms_code', '');
				if (($mobile != $_SESSION['sms_mobile']) || ($sms_code != $_SESSION['sms_mobile_code'])) {
					show_message('手机验证码输入错误。');
				}

				$user_id = $this->db->getOne('SELECT user_id FROM {pre}users WHERE mobile_phone = ' . $mobile);

				if (empty($user_id)) {
					show_message(l('log_mobile'));
				}

				$this->assign('uid', $user_id);
				$this->display('user_forget_password');
				exit();
			}

			if ($enabled_sms == 2) {
				$this->send_pwd_email();
				exit();
			}
		}

		if ($enabled_sms == 2) {
			$this->assign('title', l('reset_password'));
			$this->display('user_forget_email');
			exit();
		}

		$this->assign('page_title', l('get_password'));
		$this->display('user_forget_tel');
	}

	public function actionForgetPassword()
	{
		if (IS_POST) {
			$password = i('password', '');
			$uid = i('uid', '');

			if (empty($password)) {
				show_message(l('log_pwd_notnull'));
			}

			if ($uid < 1) {
				show_message(l('log_opration_error'));
			}

			$sql = 'SELECT user_name FROM {pre}users WHERE  user_id=' . $uid;
			$user_name = $this->db->getOne($sql);

			if ($this->users->edit_user(array('username' => $user_name, 'old_password' => $password, 'password' => $password), 0)) {
				$sql = 'UPDATE {pre}users SET `ec_salt`=\'0\' WHERE user_id= \'' . $uid . '\'';
				$this->db->query($sql);
				unset($_SESSION['user_id']);
				unset($_SESSION['user_name']);
				show_message(l('edit_sucsess'), l('back_login'), u('user/login/index'), 'success');
			}

			show_message(l('edit_error'), l('retrieve_password'), u('user/login/get_password_phone', array('enabled_sms' => 2)), 'info');
		}
	}

	public function send_pwd_email()
	{
		$user_name = i('user_name', '');
		$email = i('email', '');
		$user_name = $this->db->getOne('SELECT user_name FROM {pre}users WHERE email=\'' . $email . '\'');
		$user_info = $this->users->get_user_info($user_name);
		if (($user_info['user_name'] == $user_name) && ($user_info['email'] == $email)) {
			$code = md5($user_info['user_id'] . c('hash_code') . $user_info['reg_time']);

			if (send_pwd_email($user_info['user_id'], $user_name, $email, $code)) {
				$this->assign('data', $user_info['email']);
				$this->assign('code', $_SESSION['maildata']['code']);
				$this->display('user_forget_code');
			}
			else {
				show_message(l('fail_send_password'), l('back_page_up'), u('get_password_phone', array('enabled_sms' => 2)), 'info');
			}
		}
		else {
			show_message(l('username_no_email'), l('back_page_up'), u('get_password_phone', array('enabled_sms' => 2)), 'info');
		}
	}

	public function actionEditForgetMail()
	{
		if (IS_POST) {
			$email = i('email', '');
			$code = md5(i('email_code', ''));

			if ($code != $_SESSION['maildata']['code']) {
				show_message(l('verification_code'));
			}

			if (empty($email)) {
				show_message(l('email_nomatch'));
			}

			$this->assign('uid', $this->db->getOne('SELECT user_id FROM {pre}users WHERE email=\'' . $email . '\''));
			$this->display('user_forget_password');
		}
	}

	public function actionEditPassword()
	{
		if (IS_POST) {
			$old_password = i('old_password', null);
			$new_password = i('userpassword2', '');
			$user_id = i('uid', $this->user_id);
			$code = i('code', '');
			$mobile = i('mobile', '');

			if (strlen($new_password) < 6) {
				show_message(l('log_pwd_six'));
			}

			$user_info = $this->users->get_profile_by_id($user_id);
			if ((!empty($mobile) && (base64_encode($user_info['mobiles']) == $mobile)) || ($user_info && !empty($code) && (md5($user_info['user_id'] . c('hash_code') . $user_info['reg_time']) == $code)) || ((0 < $_SESSION['user_id']) && ($_SESSION['user_id'] == $user_id) && $this->load->user->check_user($_SESSION['user_name'], $old_password))) {
				if ($this->load->user->edit_user(array('username' => empty($code) && empty($mobile) && empty($question) ? $_SESSION['user_name'] : $user_info['user_name'], 'old_password' => $old_password, 'password' => $new_password), empty($code) ? 0 : 1)) {
					$data['ec_salt'] = 0;
					$where['user_id'] = $user_id;
					$this->db->table('users')->data($data)->where($where)->update();
					$this->load->user->logout();
					show_message(l('edit_password_success'), l('relogin_lnk'), url('login'), 'info');
				}
				else {
					show_message(l('edit_password_failure'), l('back_page_up'), '', 'info');
				}
			}
			else {
				show_message(l('edit_password_failure'), l('back_page_up'), '', 'info');
			}
		}

		if (isset($_SESSION['user_id']) && (0 < $_SESSION['user_id'])) {
			$this->assign('title', l('edit_password'));

			if ($this->is_third_user($_SESSION['user_id'])) {
				$this->assign('is_third', 1);
			}

			$this->assign('page_title', l('edit_password'));
			$this->display();
		}
		else {
			$this->redirect(url('login', array('referer' => urlencode(url($this->action)))));
		}
	}

	public function actionLogout()
	{
		if ((!isset($this->back_act) || empty($this->back_act)) && isset($_SERVER['HTTP_REFERER'])) {
			$this->back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'c=user') ? url('index') : $GLOBALS['_SERVER']['HTTP_REFERER'];
		}
		else {
			$this->back_act = u('user/login/index');
		}

		$this->users->logout();
		show_message(l('logout'), array(l('back_up_page'), l('back_home_lnk')), array($this->back_act, u('site/index/index')), 'success');
	}

	public function clear_history()
	{
		if (IS_AJAX && IS_AJAX) {
			setcookie('ECS[history]', '', 1);
			echo json_encode(array('status' => 1));
		}
		else {
			echo json_encode(array('status' => 0));
		}
	}

	public function actionRegister()
	{
		if (IS_POST) {
			if (i('enabled_sms') == 1) {
				$username = (isset($_POST['mobile']) ? trim($_POST['mobile']) : '');
				$mobile = (isset($_POST['mobile']) ? trim($_POST['mobile']) : '');
				$password = (isset($_POST['smspassword']) ? trim($_POST['smspassword']) : '');
				$sms_code = (isset($_POST['mobile_code']) ? trim($_POST['mobile_code']) : '');
				$repassword = (isset($_POST['repassword']) ? trim($_POST['repassword']) : '');
				$back_act = (isset($_POST['back_act']) ? trim($_POST['back_act']) : '');
				if (($mobile != $_SESSION['sms_mobile']) || ($sms_code != $_SESSION['sms_mobile_code'])) {
					show_message(l('log_mobile_verify_error'));
				}

				if (strlen($username) < 3) {
					show_message(l('passport_js.username_shorter'));
				}

				if (strlen($password) < 6) {
					show_message(l('passport_js.password_shorter'));
				}

				if (0 < strpos($password, ' ')) {
					show_message(l('passwd_balnk'));
				}

				if ($password != $repassword) {
					show_message(l('both_password_error'));
				}

				$email = $username . '@qq.com';
				$other = array('mobile_phone' => $mobile);
			}
			else if (i('enabled_sms') == 2) {
				$username = (isset($_POST['username']) ? trim($_POST['username']) : '');
				$email = (isset($_POST['email']) ? trim($_POST['email']) : '');
				$password = (isset($_POST['password']) ? trim($_POST['password']) : '');
				$repassword = (isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '');
				$back_act = (isset($_POST['back_act']) ? trim($_POST['back_act']) : '');
				$passport_js = l('passport_js');

				if (strlen($username) < 3) {
					show_message($passport_js['username_shorter']);
				}

				if (strlen($password) < 6) {
					show_message(l('passport_js.password_shorter'));
				}

				if (0 < strpos($password, ' ')) {
					show_message(l('passwd_balnk'));
				}

				if ($password != $repassword) {
					show_message(l('both_password_error'));
				}

				$other = array();
			}

			if (register($username, $password, $email, $other) !== false) {
				if (c('member_email_validate') && c('send_verify_email')) {
					send_regiter_hash($_SESSION['user_id']);
				}

				$ucdata = (isset($this->users->ucdata) ? $this->users->ucdata : '');
				show_message(sprintf(l('register_success'), $username . $ucdata), l('profile_lnk'), u('user/index/index'), 'success');
			}
			else {
				if ($this->db->getOne('SELECT count(user_name) as a FROM {pre}users WHERE user_name=\'' . $username . '\'')) {
					$error = l('user_yet_register');
				}
				else if ($this->db->getOne('SELECT count(email) as a FROM {pre}users WHERE email=\'' . $email . '\'')) {
					$error = l('msg_email_registered');
				}

				show_message(l('msg_register_fail') . $error, '', u('user/login/register'), 'fail');
			}
		}

		if ((!isset($back_act) || empty($back_act)) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
			$back_act = (strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER']);
		}

		if ((intval(c('shop.captcha')) & CAPTCHA_REGISTER) && (0 < gd_version())) {
			$this->assign('enabled_captcha', 1);
			$this->assign('rand', mt_rand());
		}

		$_SESSION['sms_code'] = $sms_code = md5(mt_rand(1000, 9999));
		$this->assign('sms_code', $sms_code);
		$this->assign('flag', 'register');
		$this->assign('back_act', $back_act);
		$this->assign('page_title', l('registered_user'));
		$this->assign('show', $GLOBALS['_CFG']['sms_signin']);
		$this->display('user_register');
	}

	public function actionCheckcode()
	{
		if (IS_AJAX) {
			$verify = new \vendor\Verify();
			$code = i('code');
			$code = $verify->check($code);

			if ($code == true) {
				$code = 1;
				echo json_encode($code);
			}
			else {
				$code = 0;
				echo json_encode($code);
			}
		}
	}

	public function actionVerify()
	{
		$verify = new \vendor\Verify();
		$this->assign('code', $verify->entry());
	}

	public function isMobile($mobile)
	{
		if (!is_numeric($mobile)) {
			return false;
		}

		return preg_match('#^13[\\d]{9}$|^14[5,7]{1}\\d{8}$|^15[^4]{1}\\d{8}$|^17[0,6,7,8]{1}\\d{8}$|^18[\\d]{9}$#', $mobile) ? true : false;
	}

	public function actionchecklogin()
	{
		if (!$this->user_id) {
			$url = urlencode(__HOST__ . $_SERVER['REQUEST_URI']);

			if (IS_POST) {
				$url = urlencode($_SERVER['HTTP_REFERER']);
			}

			ecs_header('Location: ' . u('user/login/index', array('back_act' => $url)));
			exit();
		}
	}
}

?>
