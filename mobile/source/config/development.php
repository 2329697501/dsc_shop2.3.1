<?php
//dezend by  QQ:2172298892
defined('BASE_PATH') || exit('No direct script access allowed');
return array(
	'DEBUG'        => true,
	'REWRITE_ON'   => 'false',
	'REWRITE_RULE' => array(),
	'DB'           => array(
		'default' => file_exists(ROOT_PATH . 'data/config.php') ? require ROOT_PATH . 'data/config.php' : array(),
		'ecshop'  => array('DB_TYPE' => 'mysql', 'DB_HOST' => 'localhost', 'DB_USER' => 'root', 'DB_PWD' => 'root', 'DB_NAME' => 'ecshop_db', 'DB_PREFIX' => 'ecs_', 'DB_PORT' => '3306', 'DB_CHARSET' => 'utf8'),
		'sdp'     => array('DB_TYPE' => 'mysql', 'DB_HOST' => 'localhost', 'DB_USER' => 'root', 'DB_PWD' => 'root', 'DB_NAME' => 'sdp_db', 'DB_PREFIX' => 'ecs_', 'DB_PORT' => '3306', 'DB_CHARSET' => 'utf8'),
		'djd'     => array('DB_TYPE' => 'mysql', 'DB_HOST' => 'localhost', 'DB_USER' => 'root', 'DB_PWD' => 'root', 'DB_NAME' => 'ecshop_db', 'DB_PREFIX' => 'ecs_', 'DB_PORT' => '3306', 'DB_CHARSET' => 'utf8'),
		'dsc'     => array('DB_TYPE' => 'mysql', 'DB_HOST' => 'localhost', 'DB_USER' => 'root', 'DB_PWD' => 'root', 'DB_NAME' => 'shangchuang_db', 'DB_PREFIX' => 'ecs_', 'DB_PORT' => '3306', 'DB_CHARSET' => 'utf8')
		)
	);

?>
