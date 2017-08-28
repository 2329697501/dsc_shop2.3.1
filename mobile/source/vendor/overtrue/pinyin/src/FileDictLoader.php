<?php
//dezend by  QQ:2172298892
namespace Overtrue\Pinyin;

class FileDictLoader implements DictLoaderInterface
{
	/**
     * Words segment name.
     *
     * @var string
     */
	protected $segmentName = 'words_%s';
	/**
     * Dict path.
     *
     * @var string
     */
	protected $path;

	public function __construct($path)
	{
		$this->path = $path;
	}

	public function map(\Closure $callback)
	{
		for ($i = 0; $i < 100; ++$i) {
			$segment = $this->path . '/' . sprintf($this->segmentName, $i);

			if (file_exists($segment)) {
				$dictionary = (array) include $segment;
				$callback($dictionary);
			}
		}
	}

	public function mapSurname(\Closure $callback)
	{
		$surnames = $this->path . '/surnames';

		if (file_exists($surnames)) {
			$dictionary = (array) include $surnames;
			$callback($dictionary);
		}
	}
}

?>
