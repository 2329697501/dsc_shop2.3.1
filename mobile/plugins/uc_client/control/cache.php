<?php
//dezend by  QQ:2172298892
!defined('IN_UC') && exit('Access Denied');
class cachecontrol extends base
{
	public function __construct()
	{
		$this->cachecontrol();
	}

	public function cachecontrol()
	{
		parent::__construct();
	}

	public function onupdate($arr)
	{
		$this->load('cache');
		$_ENV['cache']->updatedata();
	}
}

?>
