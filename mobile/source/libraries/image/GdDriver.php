<?php
//dezend by  QQ:2172298892
namespace libraries\image;

class GdDriver implements ImageInterface
{
	protected $imgRes;
	protected $info = array();
	protected $errorMsg = '';

	public function __construct($img)
	{
		if (!is_file($img)) {
			$this->errorMsg = '图片不存在！';
			return false;
		}

		$imgInfo = getimagesize($img);

		if (empty($imgInfo)) {
			$this->errorMsg = '非法图像资源！';
			return false;
		}

		$this->info = array('width' => $imgInfo[0], 'height' => $imgInfo[1], 'type' => image_type_to_extension($imgInfo[2], false), 'mime' => $imgInfo['mime']);
		$img = file_get_contents($img);
		$this->imgRes = @imagecreatefromstring($img);
	}

	public function crop($w, $h, $x = 0, $y = 0, $width = NULL, $height = NULL)
	{
		if (empty($this->imgRes)) {
			$this->errorMsg = '图像处理失败！';
			return false;
		}

		empty($width) && ($width = $w);
		empty($height) && ($height = $h);
		$img = imagecreatetruecolor($width, $height);
		$color = imagecolorallocate($img, 255, 255, 255);
		imagefill($img, 0, 0, $color);
		imagecopyresampled($img, $this->imgRes, 0, 0, $x, $y, $width, $height, $w, $h);
		imagedestroy($this->imgRes);
		$this->imgRes = $img;
		$this->info['width'] = $width;
		$this->info['height'] = $height;
		return $this;
	}

	public function thumb($width, $height, $type = 'scale')
	{
		$w = $this->info['width'];
		$h = $this->info['height'];

		switch ($type) {
		case 'scale':
			if (($w < $width) && ($h < $height)) {
				return NULL;
			}

			$scale = min($width / $w, $height / $h);
			$x = $y = 0;
			$width = $w * $scale;
			$height = $h * $scale;
			break;

		case 'center':
			$scale = max($width / $w, $height / $h);
			$w = $width / $scale;
			$h = $height / $scale;
			$x = ($this->info['width'] - $w) / 2;
			$y = ($this->info['height'] - $h) / 2;
			break;

		case 'fixed':
			$x = $y = 0;
			break;

		default:
			throw new \Exception('无此缩图类型！');
		}

		$this->crop($w, $h, $x, $y, $width, $height);
		return $this;
	}

	public function water($source, $locate = 0, $alpha = 80)
	{
		if (empty($this->imgRes)) {
			$this->errorMsg = '图像处理失败！';
			return false;
		}

		$info = getimagesize($source);

		if (!$info) {
			throw new \Exception('非法图像资源！');
		}

		$fun = 'imagecreatefrom' . image_type_to_extension($info[2], false);
		$water = $fun($source);
		imagealphablending($water, true);

		if (!$locate) {
			$locate = rand(1, 9);
		}

		switch ($locate) {
		case 1:
			$x = $y = 0;
			break;

		case 2:
			$x = ($this->info['width'] - $info[0]) / 2;
			$y = 0;
			break;

		case 3:
			$x = $this->info['width'] - $info[0];
			$y = 0;
			break;

		case 4:
			$x = 0;
			$y = ($this->info['height'] - $info[1]) / 2;
			break;

		case 5:
			$x = ($this->info['width'] - $info[0]) / 2;
			$y = ($this->info['height'] - $info[1]) / 2;
			break;

		case 6:
			$x = $this->info['width'] - $info[0];
			$y = ($this->info['height'] - $info[1]) / 2;
			break;

		case 7:
			$x = 0;
			$y = $this->info['height'] - $info[1];
			break;

		case 8:
			$x = ($this->info['width'] - $info[0]) / 2;
			$y = $this->info['height'] - $info[1];
			break;

		case 9:
			$x = $this->info['width'] - $info[0];
			$y = $this->info['height'] - $info[1];
			break;
		}

		$src = imagecreatetruecolor($info[0], $info[1]);
		$color = imagecolorallocate($src, 255, 255, 255);
		imagefill($src, 0, 0, $color);
		imagecopy($src, $this->imgRes, 0, 0, $x, $y, $info[0], $info[1]);
		imagecopy($src, $water, 0, 0, 0, 0, $info[0], $info[1]);
		imagecopymerge($this->imgRes, $src, $x, $y, 0, 0, $info[0], $info[1], $alpha);
		imagedestroy($src);
		imagedestroy($water);
		return $this;
	}

	public function output($filename, $type = NULL)
	{
		if (empty($this->imgRes)) {
			$this->errorMsg = '图像处理失败！';
			return false;
		}

		if (!$type) {
			$type = $this->info['type'];
		}
		else {
			$type = strtolower($type);
		}

		if (('jpeg' == $type) || ('jpg' == $type)) {
			$func = 'imagejpeg';
		}
		else {
			$func = 'image' . $type;
		}

		if (!function_exists($func)) {
			$this->error = '无法对该图片格式进行处理！';
			return false;
		}

		return $func($this->imgRes, $filename);
	}

	public function getError()
	{
		return $this->errorMsg;
	}

	public function getInfo()
	{
		return $this->info;
	}

	public function __destruct()
	{
		imagedestroy($this->imgRes);
	}
}

?>
