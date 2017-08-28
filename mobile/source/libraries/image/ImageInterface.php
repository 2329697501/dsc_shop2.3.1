<?php
//dezend by  QQ:2172298892
namespace libraries\image;

interface ImageInterface
{
	public function __construct($img);

	public function thumb($width, $height, $type = 'scale');

	public function water($source, $locate = 0, $alpha = 80);

	public function output($filename, $type = NULL);

	public function getError();

	public function getInfo();
}


?>
