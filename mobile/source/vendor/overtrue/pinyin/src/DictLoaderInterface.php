<?php
//dezend by  QQ:2172298892
namespace Overtrue\Pinyin;

interface DictLoaderInterface
{
	public function map(\Closure $callback);

	public function mapSurname(\Closure $callback);
}


?>
