<?php
//dezend by  QQ:2172298892
define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$smarty->assign('footer', get_footer());
$smarty->display('buy.wml');

?>
