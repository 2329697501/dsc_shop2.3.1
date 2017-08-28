<?php
//dezend by  QQ:2172298892
namespace apps\community\controllers;

class IndexController extends \apps\base\controllers\FrontendController
{
	private $size = 10;
	private $page = 1;

	public function __construct()
	{
		parent::__construct();
		$this->page = i('request.page', 1, 'intval');
		l(require ROOT_PATH . 'source/language/' . c('shop.lang') . '/user.php');
		if ((APP_NAME == 'community') && ((ACTION_NAME == 'detail') || (ACTION_NAME == 'reply'))) {
			$community = 1;
			$this->assign('community', $community);
		}
	}

	public function actionIndex()
	{
		if (IS_AJAX) {
			$list = community_list(0, $this->page, $this->size);
			exit(json_encode($list));
		}

		$tao = array('num' => community_num(1), 'has_new' => community_has_new(1));
		$wen = array('num' => community_num(2), 'has_new' => community_has_new(2));
		$quan = array('num' => community_num(3), 'has_new' => community_has_new(3));
		$sun = array('num' => sd_count(), 'has_new' => community_has_new(4, 1));
		$this->assign('tao', $tao);
		$this->assign('wen', $wen);
		$this->assign('quan', $quan);
		$this->assign('sun', $sun);
		$this->assign('action', ACTION_NAME);
		$this->assign('page_title', l('community_group'));
		$this->display('index');
	}

	public function actionList()
	{
		$dis_type = i('get.type', 1, 'intval');
		$this->checkDistype($dis_type);

		if ($dis_type == 1) {
			$page_title = l('discuss_post');
		}
		else if ($dis_type == 2) {
			$page_title = l('answer_post');
		}
		else if ($dis_type == 3) {
			$page_title = l('group_post');
		}
		else if ($dis_type == 4) {
			$page_title = l('sunny_post');

			if (IS_AJAX) {
				if (isset($_COOKIE['community_view_time_' . $dis_type]) && !empty($_COOKIE['community_view_time_' . $dis_type])) {
					setcookie('community_view_time_' . $dis_type, gmtime(), gmtime() + (3600 * 24));
				}

				$list = comment_list($this->page, $this->size);
				exit(json_encode($list));
			}
		}

		if (IS_AJAX) {
			if (isset($_COOKIE['community_view_time_' . $dis_type]) && !empty($_COOKIE['community_view_time_' . $dis_type])) {
				setcookie('community_view_time_' . $dis_type, gmtime(), gmtime() + (3600 * 24));
			}

			$list = community_list($dis_type, $this->page, $this->size);
			exit(json_encode($list));
		}

		$this->assign('type', $dis_type);
		$this->assign('action', ACTION_NAME);
		$this->assign('page_title', $page_title);
		$this->display('list');
	}

	public function actionDetail()
	{
		$dis_type = i('type', '', 'intval');
		$dis_id = i('id', '', 'intval');
		if (!empty($dis_type) && !empty($dis_id)) {
			$dis_type == 4 ? $table = 'comment' : $table = 'discuss_circle';
			$dis_type == 4 ? $field = 'comment_id' : $field = 'dis_id';

			if (empty($_COOKIE[$dis_id . $dis_type . 'islike'])) {
				$sql = 'UPDATE {pre}' . $table . ' SET dis_browse_num=dis_browse_num+1 WHERE ' . $field . ' =\'' . $dis_id . '\' AND parent_id = 0';
				$this->db->query($sql);
			}

			$sql = 'SELECT * FROM {pre}' . $table . ' WHERE ' . $field . ' =\'' . $dis_id . '\' AND parent_id = 0';
			$res = $this->db->getRow($sql);
		}

		if ($res) {
			if ($res['content']) {
				$res['dis_text'] = $res['content'];
			}

			if ($res['comment_id']) {
				$res['dis_id'] = $res['comment_id'];
			}

			if (!$res['dis_type']) {
				$res['dis_type'] = 4;
			}

			$res['add_time'] = mdate($res['add_time']);
			$res['user_picture'] = get_image_path($this->db->getOne('SELECT user_picture FROM  {pre}users WHERE user_id = \'' . $res['user_id'] . '\' '));
			if (isset($_COOKIE[$res['dis_id'] . $res['dis_type'] . 'islike']) && ($_COOKIE[$res['dis_id'] . $res['dis_type'] . 'islike'] == '1')) {
				$res['islike'] = '1';
			}
			else {
				$res['islike'] = '0';
			}

			$this->assign('detail', $res);

			if ($dis_type == 4) {
				$img_list = get_img_list($res['id_value'], $res['comment_id']);

				foreach ($img_list as $key => $list) {
					$img_list[$key]['img_thumb'] = get_image_path($list['img_thumb']);
				}

				$this->assign('img_list', $img_list);
				$link_good = $this->db->getRow('SELECT goods_id,goods_thumb,goods_name FROM  {pre}goods WHERE goods_id = \'' . $res['id_value'] . '\' ');
			}
			else {
				$link_good = $this->db->getRow('SELECT goods_id,goods_thumb,goods_name FROM  {pre}goods WHERE goods_id = \'' . $res['goods_id'] . '\' ');
			}

			$link_good['goods_thumb'] = get_image_path($link_good['goods_thumb']);
			$link_good['url'] = u('goods/index/index', array('id' => $link_good['goods_id']));
			$this->assign('link_good', $link_good);
		}
		else {
			$this->redirect(u('index'));
		}

		$this->assign('dis_type', $dis_type);
		$this->assign('dis_id', $dis_id);
		$this->assign('page_title', l('post_detail'));
		$this->display('detail');
	}

	public function actionCommentList()
	{
		$dis_type = i('request.type');
		$dis_id = i('request.id');

		if (IS_AJAX) {
			$sql = 'SELECT COUNT(*) as total FROM {pre}discuss_circle as dc' . ' LEFT JOIN {pre}users as u ON u.user_id = dc.user_id' . ' WHERE dc.parent_id = ' . $dis_id . ' AND dc.dis_type = ' . $dis_type . ' ORDER BY dc.add_time DESC';
			$total = $GLOBALS['db']->getOne($sql);
			$sql = 'SELECT dc.dis_id,dc.user_id,dc.user_name, dc.dis_text,dc.add_time,u.user_picture FROM {pre}discuss_circle as dc' . ' LEFT JOIN {pre}users as u ON u.user_id = dc.user_id' . ' WHERE dc.parent_id = ' . $dis_id . ' AND dc.dis_type = ' . $dis_type . ' ORDER BY dc.add_time DESC';
			$dis_comment = $GLOBALS['db']->selectLimit($sql, $this->size, ($this->page - 1) * $this->size);

			foreach ($dis_comment as $k => $v) {
				$dis_comment[$k]['add_time'] = mdate($v['add_time']);
				$dis_comment[$k]['user_picture'] = get_image_path($v['user_picture']);
				$dis_comment[$k]['second'] = $this->db->getAll("SELECT user_id,user_name, dis_text,add_time FROM {pre}discuss_circle\r\n                      WHERE parent_id = " . $v['dis_id'] . ' AND parent_id != 0 AND dis_type = ' . $dis_type . ' ORDER BY add_time DESC');
				$dis_comment[$k]['count'] = count($dis_comment[$k]['second']);
			}

			exit(json_encode(array('commentlist' => $dis_comment, 'totalPage' => ceil($total / $this->size))));
		}
	}

	public function actionCommnet()
	{
		if (i('dis_text')) {
			$user_id = $_SESSION['user_id'];
			$user_name = $_SESSION['user_name'];
			$parent_id = i('id');
			$dis_type = i('type');
			$dis_id = (i('dis_id') ? i('dis_id') : $parent_id);

			if (!empty($user_id)) {
				if (IS_POST) {
					$this->checkDistype($dis_type);
					$data['dis_text'] = i('dis_text');
					$data['user_id'] = $user_id;
					$data['user_name'] = $user_name;
					$data['parent_id'] = $dis_id;
					$data['add_time'] = gmtime();
					$data['dis_type'] = $dis_type;
					$res = $this->db->table('discuss_circle')->data($data)->insert();

					if ($res) {
						echo json_encode(u('community/index/detail', array('id' => $parent_id, 'type' => $dis_type)));
					}
				}
			}
			else {
				echo json_encode(u('user/login/index'));
			}
		}
		else {
			show_message(l('write_answer'));
		}
	}

	public function actionMy()
	{
		$this->checkLogin();

		if (IS_AJAX) {
			$dis_type = i('dis_type', 0, 'intval');
			$this->checkDistype($dis_type);

			if ($dis_type == 4) {
				$list = comment_list($this->page, $this->size, $_SESSION['user_id']);
				exit(json_encode($list));
			}
			else {
				$list = community_list($dis_type, $this->page, $this->size, $_SESSION['user_id']);
				exit(json_encode($list));
			}
		}

		$has_new = reply_has_new();
		$this->assign('has_new', $has_new);
		$info = get_user_default($_SESSION['user_id']);
		$this->assign('type1_num', community_num(1, 0, $_SESSION['user_id']));
		$this->assign('type2_num', community_num(2, 0, $_SESSION['user_id']));
		$this->assign('type3_num', community_num(3, 0, $_SESSION['user_id']));
		$this->assign('type4_num', sd_count($_SESSION['user_id']));
		$this->assign('info', $info);
		$this->assign('action', ACTION_NAME);
		$this->assign('page_title', '');
		$this->display('mycommunity');
	}

	public function actionReply()
	{
		$this->checkLogin();

		if (IS_AJAX) {
			if (isset($_COOKIE['community_reply']) && !empty($_COOKIE['community_reply'])) {
				setcookie('community_reply', gmtime(), gmtime() + (3600 * 24));
			}

			$sql = "SELECT COUNT(*) as total FROM {pre}discuss_circle dc\r\n                     LEFT JOIN {pre}discuss_circle as dc2 ON dc.parent_id = dc2.dis_id\r\n                     LEFT JOIN {pre}users as u ON dc2.user_id = u.user_id\r\n                     WHERE dc.user_id != " . $_SESSION['user_id'] . ' AND dc2.user_id = ' . $_SESSION['user_id'] . ' AND dc.parent_id != 0';
			$total = $GLOBALS['db']->getOne($sql);
			$sql = "SELECT dc.user_id, dc.user_name, dc.dis_text, dc.add_time, dc.dis_type, dc.parent_id, dc2.dis_title as main_title, u.user_picture,\r\n                      (select cmt.content from {pre}comment as cmt left join {pre}discuss_circle as dcx on cmt.comment_id = dcx.parent_id\r\n                        where  dcx.dis_id = dc.dis_id and dcx.dis_type = 4 and dcx.user_id != " . $_SESSION['user_id'] . ") as content\r\n                     FROM {pre}discuss_circle dc\r\n                     LEFT JOIN {pre}discuss_circle as dc2 ON dc.parent_id = dc2.dis_id\r\n                     LEFT JOIN {pre}users as u ON dc2.user_id = u.user_id\r\n                     WHERE dc.user_id != " . $_SESSION['user_id'] . ' AND dc2.user_id = ' . $_SESSION['user_id'] . " AND dc.parent_id != 0\r\n                     ORDER BY dc.add_time DESC LIMIT " . (($this->page - 1) * $this->size) . ',  ' . $this->size . ' ';
			$list = $GLOBALS['db']->query($sql);

			foreach ($list as $k => $v) {
				if (($v['dis_type'] == 4) && !empty($v['content'])) {
					$list[$k]['main_title'] = $v['content'];
				}

				$list[$k]['user_picture'] = get_image_path($v['user_picture']);
				$list[$k]['add_time'] = mdate($v['add_time']);
				$list[$k]['url'] = u('detail', array('id' => $v['parent_id'], 'type' => $v['dis_type']));
			}

			exit(json_encode(array('list' => $list, 'totalPage' => ceil($total / $this->size))));
		}

		$this->assign('page_title', l('reply_me'));
		$this->display('reply_list');
	}

	public function actiondeleteMycom()
	{
		if (IS_AJAX) {
			$this->checkLogin();
			$result = array('error' => '', 'msg' => '');
			$dis_type = i('dis_type', '', 'intval');
			$dis_id = i('dis_id', '', 'intval');
			if (!empty($dis_type) && !empty($dis_id)) {
				if ($dis_type == 4) {
					$data['status'] = 0;
					$condition['comment_id'] = $dis_id;
					$condition['user_id'] = $_SESSION['user_id'];
					$this->model->table('comment')->data($data)->where($condition)->update();
					exit(json_encode($result['error'] == '0'));
				}
				else {
					$condition['dis_id'] = $dis_id;
					$sql = 'DELETE FROM `{pre}discuss_circle` WHERE dis_id = \'' . $dis_id . '\' OR parent_id = \'' . $dis_id . '\' ';
					$res = $GLOBALS['db']->query($sql);

					if ($res) {
						$result['error'] == '0';
					}

					exit(json_encode($result));
				}
			}
		}
	}

	public function actionLike()
	{
		if (IS_AJAX) {
			$dis_type = i('dis_type', '', 'intval');
			$dis_id = i('dis_id', '', 'intval');
			if (!empty($dis_type) && !empty($dis_id)) {
				$dis_type == 4 ? $table = 'comment' : $table = 'discuss_circle';
				$dis_type == 4 ? $field = 'comment_id' : $field = 'dis_id';

				if ($_COOKIE[$dis_id . $dis_type . 'islike'] == '1') {
					$symbols = '-';
					$islike = '0';
				}
				else {
					$symbols = '+';
					$islike = '1';
				}

				$sql = 'UPDATE {pre}' . $table . ' SET like_num=like_num' . $symbols . '1 WHERE ' . $field . ' = ' . $dis_id . ' ';
				$GLOBALS['db']->query($sql);
				$like_num = $this->db->getOne('SELECT like_num FROM {pre}' . $table . '  WHERE ' . $field . ' =  ' . $dis_id . '  ');

				if ($like_num === NULL) {
					$like_num = '0';
				}

				if ($islike == '0') {
					setcookie($dis_id . $dis_type . 'islike', $islike, gmtime() - 86400);
				}
				else {
					setcookie($dis_id . $dis_type . 'islike', $islike, gmtime() + 86400);
				}

				echo json_encode(array('like_num' => $like_num, 'is_like' => $islike, 'dis_id' => $dis_id));
			}
		}
	}

	private function checkLogin()
	{
		if (!$_SESSION['user_id']) {
			$url = urlencode(__HOST__ . $_SERVER['REQUEST_URI']);

			if (IS_POST) {
				$url = urlencode($_SERVER['HTTP_REFERER']);
			}

			ecs_header('Location: ' . u('user/login/index', array('back_act' => $url)));
			exit();
		}
	}

	private function checkDistype($dis_type)
	{
		if (!in_array($dis_type, array(0, 1, 2, 3, 4))) {
			$this->redirect(u('site/index/index'));
		}
	}
}

?>
