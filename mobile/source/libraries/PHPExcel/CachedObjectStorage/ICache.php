<?php
//dezend by  QQ:2172298892
interface PHPExcel_CachedObjectStorage_ICache
{
	public function addCacheData($pCoord, PHPExcel_Cell $cell);

	public function updateCacheData(PHPExcel_Cell $cell);

	public function getCacheData($pCoord);

	public function deleteCacheData($pCoord);

	public function isDataSet($pCoord);

	public function getCellList();

	public function getSortedCellList();

	public function copyCellCollection(PHPExcel_Worksheet $parent);

	static public function cacheMethodIsAvailable();
}


?>
