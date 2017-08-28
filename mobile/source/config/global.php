<?php
//dezend by  QQ:2172298892
defined('BASE_PATH') || exit('No direct script access allowed');
return array(
	'ENV'                => ENVIRONMENT,
	'DEFAULT_APP'        => 'site',
	'DEFAULT_CONTROLLER' => 'Index',
	'ACTION_PREFIX'      => 'action',
	'DEFAULT_FILTER'     => 'htmlspecialchars',
	'VAR_FILTER'         => '',
	'CACHE_EXPIRE'       => 86400,
	'CACHE'              => array(
		'default'   => array('CACHE_TYPE' => 'FileCache', 'CACHE_PATH' => ROOT_PATH . 'data/caches/', 'GROUP' => 'data', 'HASH_DEEP' => 0),
		'memcached' => array('CACHE_TYPE' => 'FileCache', 'CACHE_PATH' => ROOT_PATH . 'data/caches/', 'GROUP' => 'tpl', 'HASH_DEEP' => 0),
		'TPL_CACHE' => array('CACHE_TYPE' => 'FileCache', 'CACHE_PATH' => ROOT_PATH . 'data/caches/', 'GROUP' => 'tpl', 'HASH_DEEP' => 0),
		'DB_CACHE'  => array('CACHE_TYPE' => 'FileCache', 'CACHE_PATH' => ROOT_PATH . 'data/caches/', 'GROUP' => 'data', 'HASH_DEEP' => 0)
		)
	);

?>
