<?php
//dezend by  QQ:2172298892
namespace apps\user\controllers;

class ProfileController extends \apps\base\controllers\FrontendController
{
	public $user_id;
	public $email;
	public $mobile;
	public $sex;

	public function __construct()
	{
		parent::__construct();
		l(require ROOT_PATH . 'source/language/' . c('shop.lang') . '/user.php');
		$file = array('passport', 'clips');
		$this->load_helper($file);
		$this->user_id = $_SESSION['user_id'];
		$this->actionchecklogin();
		$this->assign('lang', l());
	}

	public function actionIndex()
	{
		$this->parameter();
		$sql = 'SELECT user_id,user_name,sex FROM {pre}users WHERE user_id = ' . $this->user_id;
		$user_info = $this->db->getRow($sql);
		$this->assign('user_sex', $user_info['sex']);
		$this->display('user_detail');
	}

	public function actionEditProfile()
	{
		$this->parameter();

		if (IS_POST) {
			if (!empty($this->sex)) {
				$update = ' sex = \'' . $this->sex . '\'';
			}

			$where = ' WHERE user_id = \'' . $this->user_id . '\'';
			if (isset($update) && isset($where)) {
				$sql = 'UPDATE {pre}users SET ' . $update . ' ' . $where;
				$this->db->query($sql);
			}

			$info = get_user_default($this->user_id);
			echo json_encode($info);
			exit();
		}
	}

	public function actionUserEditMobile()
	{
		$this->parameter();
		$sql = 'SELECT user_id,user_name,mobile_phone FROM {pre}users WHERE user_id = ' . $this->user_id;
		$user_info = $this->db->getRow($sql);
		if (IS_POST && (i('sms_signin') == 1)) {
			$sms_code = i('sms_code');

			if ($sms_code !== $_SESSION['sms_code']) {
				show_message(l('msg_auth_code_error'));
				exit();
			}

			if (empty($this->mobile)) {
				show_message(l('msg_input_mobile'));
				exit();
			}

			if (!empty($user_info)) {
				$sql = 'UPDATE {pre}users SET mobile_phone = \'' . $this->mobile . '\' WHERE user_id = \'' . $this->user_id . '\'';
				$this->db->query($sql);
			}
		}

		if (IS_POST && (i('sms_signin') == 0)) {
			$sql = 'SELECT user_id FROM {pre}users WHERE mobile_phone=\'' . $this->mobile . '\'AND user_id!=' . $_SESSION['user_id'];
			$mobile_phone = $this->db->getOne($sql);

			if (!empty($mobile_phone)) {
				show_message(l('msg_mobile_exist'));
				exit();
			}

			$sql = 'SELECT user_id FROM {pre}users WHERE user_name=\'' . $this->mobile . '\'AND user_id!=' . $_SESSION['user_id'];
			$user_name = $this->db->getOne($sql);

			if (!empty($user_name)) {
				show_message(l('msg_mobile_exist'));
				exit();
			}

			if (!empty($this->mobile)) {
				$sql = 'UPDATE {pre}users SET mobile_phone = \'' . $this->mobile . '\' WHERE user_id = \'' . $this->user_id . '\'';
				$up = $this->db->query($sql);
				ecs_header('Location: ' . u('user/profile/index'));
			}
		}

		$_SESSION['sms_code'] = $sms_code = md5(mt_rand(1000, 9999));
		$this->assign('sms_code', $sms_code);
		$this->assign('mobile', $user_info['mobile_phone']);
		$this->assign('sms_signin', c('shop.sms_signin'));
		$this->assign('page_title', l('edit_mobile'));
		$this->display('user_edit_mobile');
	}

	public function actionUserEditEmail()
	{
		$this->parameter();
		$sql = 'SELECT user_id,email FROM {pre}users WHERE user_id = ' . $this->user_id;
		$user_info = $this->db->getRow($sql);

		if (IS_POST) {
			$sql = 'SELECT user_id FROM {pre}users WHERE email=\'' . $this->email . '\'AND user_id!=' . $_SESSION['user_id'];
			$email = $this->db->getOne($sql);

			if (!empty($email)) {
				show_message(l('msg_email_registered'));
				exit();
			}

			$sql = 'SELECT user_id FROM {pre}users WHERE user_name=\'' . $this->email . '\'AND user_id!=' . $_SESSION['user_id'];
			$user_email = $this->db->getOne($sql);

			if (!empty($user_email)) {
				show_message(l('msg_email_registered'));
				exit();
			}

			if (!empty($this->email)) {
				$sql = 'UPDATE {pre}users SET email = \'' . $this->email . '\' WHERE user_id = \'' . $this->user_id . '\'';
				$this->db->query($sql);
			}

			ecs_header('Location: ' . u('user/profile/index'));
		}

		$this->assign('emails', $user_info['email']);
		$this->assign('page_title', l('edit_email'));
		$this->display('user_edit_email');
	}

	private function parameter()
	{
		$this->user_id = $_SESSION['user_id'];

		if (empty($this->user_id)) {
			ecs_header("Location: ./\n");
		}

		$this->mobile = i('mobile');
		$this->sex = i('sex');
		$this->email = i('email');
		$this->postbox = i('postbox');
		$this->assign('info', get_user_default($this->user_id));
	}

	public function actionSendSms()
	{
		$mobile = i('mobile');
		$sms_code = i('sms_code');
		if (!empty($mobile) && !empty($sms_code)) {
			$content = l('user_auth_code') . $sms_code . l('msg_prompt');
			send_sms($mobile, $content);
		}
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
