<?php
//dezend by  QQ:2172298892
namespace Overtrue\Pinyin;

class Pinyin
{
	const NONE = 'none';
	const ASCII = 'ascii';
	const UNICODE = 'unicode';

	/**
     * Dict loader.
     *
     * @var \Overtrue\Pinyin\DictLoaderInterface
     */
	protected $loader;
	/**
     * Punctuations map.
     *
     * @var array
     */
	protected $punctuations = array('，' => ',', '。' => '.', '！' => '!', '？' => '?', '：' => ':', '“' => '"', '”' => '"', '‘' => '\'', '’' => '\'');

	public function __construct(DictLoaderInterface $loader = NULL)
	{
		$this->loader = $loader;
	}

	public function convert($string, $option = self::NONE)
	{
		$pinyin = $this->romanize($string);
		return $this->splitWords($pinyin, $option);
	}

	public function name($stringName, $option = self::NONE)
	{
		$pinyin = $this->romanize($stringName, true);
		return $this->splitWords($pinyin, $option);
	}

	public function permalink($string, $delimiter = '-')
	{
		if (!in_array($delimiter, array('_', '-', '.', ''), true)) {
			throw new \InvalidArgumentException('Delimiter must be one of: \'_\', \'-\', \'\', \'.\'.');
		}

		return implode($delimiter, $this->convert($string, false));
	}

	public function abbr($string, $delimiter = '')
	{
		return implode($delimiter, array_map(function($pinyin) {
			return $pinyin[0];
		}, $this->convert($string, false)));
	}

	public function sentence($sentence, $withTone = false)
	{
		$marks = array_keys($this->punctuations);
		$punctuationsRegex = preg_quote(implode(array_merge($marks, $this->punctuations)), '/');
		$regex = '/[^üāēīōūǖáéíóúǘǎěǐǒǔǚàèìòùǜa-z0-9' . $punctuationsRegex . '\\s_]+/iu';
		$pinyin = preg_replace($regex, '', $this->romanize($sentence));
		$punctuations = array_merge($this->punctuations, array('	' => ' ', '  ' => ' '));
		$pinyin = trim(str_replace(array_keys($punctuations), $punctuations, $pinyin));
		return $withTone ? $pinyin : $this->format($pinyin, false);
	}

	public function setLoader(DictLoaderInterface $loader)
	{
		$this->loader = $loader;
		return $this;
	}

	public function getLoader()
	{
		return $this->loader ?: new FileDictLoader(__DIR__ . '/../data/');
	}

	protected function prepare($string)
	{
		$string = preg_replace_callback('~[a-z0-9_-]+~i', function($matches) {
			return '	' . $matches[0];
		}, $string);
		return preg_replace('~[^\\p{Han}\\p{P}\\p{Z}\\p{M}\\p{N}\\p{L}	]~u', '', $string);
	}

	protected function romanize($string, $isName = false)
	{
		$string = $this->prepare($string);
		$dictLoader = $this->getLoader();

		if ($isName) {
			$string = $this->convertSurname($string, $dictLoader);
		}

		$dictLoader->map(function($dictionary) use(&$string) {
			$string = strtr($string, $dictionary);
		});
		return $string;
	}

	protected function convertSurname($string, $dictLoader)
	{
		$dictLoader->mapSurname(function($dictionary) use(&$string) {
			foreach ($dictionary as $surname => $pinyin) {
				if (strpos($string, $surname) === 0) {
					$string = $pinyin . mb_substr($string, mb_strlen($surname, 'UTF-8'), mb_strlen($string, 'UTF-8') - 1, 'UTF-8');
					break;
				}
			}
		});
		return $string;
	}

	public function splitWords($pinyin, $option)
	{
		$split = array_filter(preg_split('/[^üāēīōūǖáéíóúǘǎěǐǒǔǚàèìòùǜa-z\\d]+/iu', $pinyin));

		if ($option !== self::UNICODE) {
			foreach ($split as $index => $pinyin) {
				$split[$index] = $this->format($pinyin, $option === self::ASCII);
			}
		}

		return array_values($split);
	}

	protected function format($pinyin, $tone = false)
	{
		$replacements = array(
			'üē' => array('ue', 1),
			'üé' => array('ue', 2),
			'üě' => array('ue', 3),
			'üè' => array('ue', 4),
			'ā'   => array('a', 1),
			'ē'   => array('e', 1),
			'ī'   => array('i', 1),
			'ō'   => array('o', 1),
			'ū'   => array('u', 1),
			'ǖ'   => array('v', 1),
			'á'   => array('a', 2),
			'é'   => array('e', 2),
			'í'   => array('i', 2),
			'ó'   => array('o', 2),
			'ú'   => array('u', 2),
			'ǘ'   => array('v', 2),
			'ǎ'   => array('a', 3),
			'ě'   => array('e', 3),
			'ǐ'   => array('i', 3),
			'ǒ'   => array('o', 3),
			'ǔ'   => array('u', 3),
			'ǚ'   => array('v', 3),
			'à'   => array('a', 4),
			'è'   => array('e', 4),
			'ì'   => array('i', 4),
			'ò'   => array('o', 4),
			'ù'   => array('u', 4),
			'ǜ'   => array('v', 4)
			);

		foreach ($replacements as $unicde => $replacements) {
			if (false !== strpos($pinyin, $unicde)) {
				$pinyin = str_replace($unicde, $replacements[0], $pinyin) . ($tone ? $replacements[1] : '');
			}
		}

		return $pinyin;
	}
}

define('PINYIN_NONE', 'none');
define('PINYIN_ASCII', 'ascii');
define('PINYIN_UNICODE', 'unicode');

?>
