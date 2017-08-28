<?php
//dezend by  QQ:2172298892
interface PHPExcel_Reader_IReader
{
	public function canRead($pFilename);

	public function load($pFilename);
}


?>
