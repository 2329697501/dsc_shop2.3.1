<?php
//dezend by  QQ:2172298892
namespace apps\base\controllers;

class ErrorController extends BaseController
{
	public function error404($e = NULL)
	{
		header('HTTP/1.1 404 Not Found');
		header('status: 404 Not Found');
		$this->error($e);
	}

	public function error($e = NULL)
	{
		if (false !== stripos(get_class($e), 'Exception')) {
			$this->errorMessage = $e->getMessage();
			$this->errorCode = $e->getCode();
			$this->errorFile = $e->getFile();
			$this->errorLine = $e->getLine();
			$this->trace = $e->getTrace();
		}

		if ((false == c('DEBUG')) || ('production' == c('ENV'))) {
			$tpl = 'error_production';
		}
		else {
			$tpl = 'error_development';
		}

		$this->display('source/apps/base/views/' . $tpl);
	}
}

?>
