<?php
//dezend by  QQ:2172298892
class PHPExcel_Calculation_Functions
{
	const COMPATIBILITY_EXCEL = 'Excel';
	const COMPATIBILITY_GNUMERIC = 'Gnumeric';
	const COMPATIBILITY_OPENOFFICE = 'OpenOfficeCalc';
	const RETURNDATE_PHP_NUMERIC = 'P';
	const RETURNDATE_PHP_OBJECT = 'O';
	const RETURNDATE_EXCEL = 'E';

	/**
	 * Compatibility mode to use for error checking and responses
	 *
	 * @access	private
	 * @var string
	 */
	static protected $compatibilityMode = self::COMPATIBILITY_EXCEL;
	/**
	 * Data Type to use when returning date values
	 *
	 * @access	private
	 * @var string
	 */
	static protected $ReturnDateType = self::RETURNDATE_EXCEL;
	/**
	 * List of error codes
	 *
	 * @access	private
	 * @var array
	 */
	static protected $_errorCodes = array('null' => '#NULL!', 'divisionbyzero' => '#DIV/0!', 'value' => '#VALUE!', 'reference' => '#REF!', 'name' => '#NAME?', 'num' => '#NUM!', 'na' => '#N/A', 'gettingdata' => '#GETTING_DATA');

	static public function setCompatibilityMode($compatibilityMode)
	{
		if (($compatibilityMode == self::COMPATIBILITY_EXCEL) || ($compatibilityMode == self::COMPATIBILITY_GNUMERIC) || ($compatibilityMode == self::COMPATIBILITY_OPENOFFICE)) {
			self::$compatibilityMode = $compatibilityMode;
			return true;
		}

		return false;
	}

	static public function getCompatibilityMode()
	{
		return self::$compatibilityMode;
	}

	static public function setReturnDateType($returnDateType)
	{
		if (($returnDateType == self::RETURNDATE_PHP_NUMERIC) || ($returnDateType == self::RETURNDATE_PHP_OBJECT) || ($returnDateType == self::RETURNDATE_EXCEL)) {
			self::$ReturnDateType = $returnDateType;
			return true;
		}

		return false;
	}

	static public function getReturnDateType()
	{
		return self::$ReturnDateType;
	}

	static public function DUMMY()
	{
		return '#Not Yet Implemented';
	}

	static public function DIV0()
	{
		return self::$_errorCodes['divisionbyzero'];
	}

	static public function NA()
	{
		return self::$_errorCodes['na'];
	}

	static public function NaN()
	{
		return self::$_errorCodes['num'];
	}

	static public function NAME()
	{
		return self::$_errorCodes['name'];
	}

	static public function REF()
	{
		return self::$_errorCodes['reference'];
	}

	static public function NULL()
	{
		return self::$_errorCodes['null'];
	}

	static public function VALUE()
	{
		return self::$_errorCodes['value'];
	}

	static public function isMatrixValue($idx)
	{
		return (substr_count($idx, '.') <= 1) || (0 < preg_match('/\\.[A-Z]/', $idx));
	}

	static public function isValue($idx)
	{
		return substr_count($idx, '.') == 0;
	}

	static public function isCellValue($idx)
	{
		return 1 < substr_count($idx, '.');
	}

	static public function _ifCondition($condition)
	{
		$condition = PHPExcel_Calculation_Functions::flattenSingleValue($condition);

		if (!isset($condition[0])) {
			$condition = '=""';
		}

		if (!in_array($condition[0], array('>', '<', '='))) {
			if (!is_numeric($condition)) {
				$condition = PHPExcel_Calculation::_wrapResult(strtoupper($condition));
			}

			return '=' . $condition;
		}
		else {
			preg_match('/([<>=]+)(.*)/', $condition, $matches);

			if (!is_numeric($operand)) {
				$operand = str_replace('"', '""', $operand);
				$operand = PHPExcel_Calculation::_wrapResult(strtoupper($operand));
			}

			return $operator . $operand;
		}
	}

	static public function ERROR_TYPE($value = '')
	{
		$value = self::flattenSingleValue($value);
		$i = 1;

		foreach (self::$_errorCodes as $errorCode) {
			if ($value === $errorCode) {
				return $i;
			}

			++$i;
		}

		return self::NA();
	}

	static public function IS_BLANK($value = NULL)
	{
		if (!is_null($value)) {
			$value = self::flattenSingleValue($value);
		}

		return is_null($value);
	}

	static public function IS_ERR($value = '')
	{
		$value = self::flattenSingleValue($value);
		return self::IS_ERROR($value) && !self::IS_NA($value);
	}

	static public function IS_ERROR($value = '')
	{
		$value = self::flattenSingleValue($value);

		if (!is_string($value)) {
			return false;
		}

		return in_array($value, array_values(self::$_errorCodes));
	}

	static public function IS_NA($value = '')
	{
		$value = self::flattenSingleValue($value);
		return $value === self::NA();
	}

	static public function IS_EVEN($value = NULL)
	{
		$value = self::flattenSingleValue($value);

		if ($value === NULL) {
			return self::NAME();
		}

		if (is_bool($value) || (is_string($value) && !is_numeric($value))) {
			return self::VALUE();
		}

		return ($value % 2) == 0;
	}

	static public function IS_ODD($value = NULL)
	{
		$value = self::flattenSingleValue($value);

		if ($value === NULL) {
			return self::NAME();
		}

		if (is_bool($value) || (is_string($value) && !is_numeric($value))) {
			return self::VALUE();
		}

		return (abs($value) % 2) == 1;
	}

	static public function IS_NUMBER($value = NULL)
	{
		$value = self::flattenSingleValue($value);

		if (is_string($value)) {
			return false;
		}

		return is_numeric($value);
	}

	static public function IS_LOGICAL($value = NULL)
	{
		$value = self::flattenSingleValue($value);
		return is_bool($value);
	}

	static public function IS_TEXT($value = NULL)
	{
		$value = self::flattenSingleValue($value);
		return is_string($value) && !self::IS_ERROR($value);
	}

	static public function IS_NONTEXT($value = NULL)
	{
		return !self::IS_TEXT($value);
	}

	static public function VERSION()
	{
		return 'PHPExcel 1.8.0, 2014-03-02';
	}

	static public function N($value = NULL)
	{
		while (is_array($value)) {
			$value = array_shift($value);
		}

		switch (gettype($value)) {
		case 'double':
		case 'float':
		case 'integer':
			return $value;
			break;

		case 'boolean':
			return (int) $value;
			break;

		case 'string':
			if ((0 < strlen($value)) && ($value[0] == '#')) {
				return $value;
			}

			break;
		}

		return 0;
	}

	static public function TYPE($value = NULL)
	{
		$value = self::flattenArrayIndexed($value);
		if (is_array($value) && (1 < count($value))) {
			$a = array_keys($value);
			$a = array_pop($a);

			if (self::isCellValue($a)) {
				return 16;
			}
			else if (self::isMatrixValue($a)) {
				return 64;
			}
		}
		else if (empty($value)) {
			return 1;
		}

		$value = self::flattenSingleValue($value);
		if (($value === NULL) || is_float($value) || is_int($value)) {
			return 1;
		}
		else if (is_bool($value)) {
			return 4;
		}
		else if (is_array($value)) {
			return 64;
			break;
		}
		else if (is_string($value)) {
			if ((0 < strlen($value)) && ($value[0] == '#')) {
				return 16;
			}

			return 2;
		}

		return 0;
	}

	static public function flattenArray($array)
	{
		if (!is_array($array)) {
			return (array) $array;
		}

		$arrayValues = array();

		foreach ($array as $value) {
			if (is_array($value)) {
				foreach ($value as $val) {
					if (is_array($val)) {
						foreach ($val as $v) {
							$arrayValues[] = $v;
						}
					}
					else {
						$arrayValues[] = $val;
					}
				}
			}
			else {
				$arrayValues[] = $value;
			}
		}

		return $arrayValues;
	}

	static public function flattenArrayIndexed($array)
	{
		if (!is_array($array)) {
			return (array) $array;
		}

		$arrayValues = array();

		foreach ($array as $k1 => $value) {
			if (is_array($value)) {
				foreach ($value as $k2 => $val) {
					if (is_array($val)) {
						foreach ($val as $k3 => $v) {
							$arrayValues[$k1 . '.' . $k2 . '.' . $k3] = $v;
						}
					}
					else {
						$arrayValues[$k1 . '.' . $k2] = $val;
					}
				}
			}
			else {
				$arrayValues[$k1] = $value;
			}
		}

		return $arrayValues;
	}

	static public function flattenSingleValue($value = '')
	{
		while (is_array($value)) {
			$value = array_pop($value);
		}

		return $value;
	}
}

if (!defined('PHPEXCEL_ROOT')) {
	define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../../');
	require PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php';
}

define('MAX_VALUE', 1.2E+308);
define('M_2DIVPI', 0.63661977236758);
define('MAX_ITERATIONS', 256);
define('PRECISION', 8.88E-16);

if (!function_exists('acosh')) {
	function acosh($x)
	{
		return 2 * log(sqrt(($x + 1) / 2) + sqrt(($x - 1) / 2));
	}
}

if (!function_exists('asinh')) {
	function asinh($x)
	{
		return log($x + sqrt(1 + ($x * $x)));
	}
}

if (!function_exists('atanh')) {
	function atanh($x)
	{
		return (log(1 + $x) - log(1 - $x)) / 2;
	}
}

if (!function_exists('mb_str_replace') && function_exists('mb_substr') && function_exists('mb_strlen') && function_exists('mb_strpos')) {
	function mb_str_replace($search, $replace, $subject)
	{
		if (is_array($subject)) {
			$ret = array();

			foreach ($subject as $key => $val) {
				$ret[$key] = mb_str_replace($search, $replace, $val);
			}

			return $ret;
		}

		foreach ((array) $search as $key => $s) {
			if ($s == '') {
				continue;
			}

			$r = (!is_array($replace) ? $replace : (array_key_exists($key, $replace) ? $replace[$key] : ''));
			$pos = mb_strpos($subject, $s, 0, 'UTF-8');

			while ($pos !== false) {
				$subject = mb_substr($subject, 0, $pos, 'UTF-8') . $r . mb_substr($subject, $pos + mb_strlen($s, 'UTF-8'), 65535, 'UTF-8');
				$pos = mb_strpos($subject, $s, $pos + mb_strlen($r, 'UTF-8'), 'UTF-8');
			}
		}

		return $subject;
	}
}

?>
