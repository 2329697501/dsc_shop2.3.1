<?php
//dezend by  QQ:2172298892
namespace apps\captcha\controllers;

class IndexController extends \apps\base\controllers\FrontendController
{
	public function actionIndex()
	{
		$params = array('fontSize' => 14, 'length' => 4, 'useNoise' => false, 'fontttf' => '4.ttf');
		$verify = new \vendor\Verify($params);
		$verify->entry();
	}
}

?>
