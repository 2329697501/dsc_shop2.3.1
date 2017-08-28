<?php
//dezend by  QQ:2172298892
defined('BASE_PATH') || exit('No direct script access allowed');
return array(
	'DEBUG'        => false,
	'REWRITE_ON'   => 'false',
	'REWRITE_RULE' => array(),
	'DB'           => array('default' => file_exists(ROOT_PATH . 'data/config.php') ? require ROOT_PATH . 'data/config.php' : array())
	);

?>
