<?php
//dezend by  QQ:2172298892
class PHPExcel_Autoloader
{
	static public function Register()
	{
		$functions = spl_autoload_functions();

		foreach ($functions as $function) {
			spl_autoload_unregister($function);
		}

		$functions = array_merge(array(
	array('PHPExcel_Autoloader', 'Load')
	), $functions);

		foreach ($functions as $function) {
			$x = spl_autoload_register($function);
		}

		return $x;
	}

	static public function Load($pClassName)
	{
		if (class_exists($pClassName, false) || (strpos($pClassName, 'PHPExcel') !== 0)) {
			return false;
		}

		$pClassFilePath = PHPEXCEL_ROOT . str_replace('_', DIRECTORY_SEPARATOR, $pClassName) . '.php';
		if ((file_exists($pClassFilePath) === false) || (is_readable($pClassFilePath) === false)) {
			return false;
		}

		require $pClassFilePath;
	}
}

PHPExcel_Autoloader::Register();

if (ini_get('mbstring.func_overload') & 2) {
	throw new PHPExcel_Exception('Multibyte function overloading in PHP must be disabled for string functions (2).');
}

PHPExcel_Shared_String::buildCharacterSets();

?>
