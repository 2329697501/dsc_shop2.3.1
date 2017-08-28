<?php
//dezend by  QQ:2172298892
function delFile($dirName)
{
	if (is_dir($dirName) && ($handle = opendir($dirName))) {
		while (false !== ($item = readdir($handle))) {
			if (($item != '.') && ($item != '..')) {
				if (file_exists($dirName . '/' . $item) && is_dir($dirName . '/' . $item)) {
					delfile($dirName . '/' . $item);
				}
				else if (@unlink($dirName . '/' . $item)) {
					continue;
				}
			}
		}

		closedir($handle);
	}
}

$data_path = str_replace('\\', '/', dirname(dirname(dirname(dirname(__FILE__))))) . '/mobile/data/caches/';
$dir = array('data', 'static', 'tpl');

foreach ($dir as $k => $v) {
	$dirName = $data_path . $v;
	delfile($dirName);
}

?>
