<?php
//dezend by  QQ:2172298892
namespace libraries;

class Image
{
	/**
     * 图像文件
     * @var string
     */
	protected $img;
	/**
     * 图像驱动
     * @var string
     */
	protected $driver;
	/**
     * 驱动对象
     * @var array
     */
	static protected $objArr = array();

	public function __construct($img, $driver = 'gd')
	{
		$this->img = $img;
		$this->driver = $driver;
	}

	public function __call($method, $args)
	{
		if (!isset(self::$objArr[$this->image])) {
			$imageDriver = 'libraries' . '\\image\\' . ucfirst($this->driver) . 'Driver';

			if (!class_exists($imageDriver)) {
				throw new \Exception('Image Driver \'' . $imageDriver . '\' not found\'', 500);
			}

			self::$objArr[$this->image] = new $imageDriver($this->img);
		}

		return call_user_func_array(array(self::$objArr[$this->image], $method), $args);
	}
}


?>
