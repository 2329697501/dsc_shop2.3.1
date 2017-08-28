<?php
//dezend by  QQ:2172298892
class ComposerAutoloaderInit8c7218663417b786fd329e81ded6585f
{
	static private $loader;

	static public function loadClassLoader($class)
	{
		if ('Composer\\Autoload\\ClassLoader' === $class) {
			require __DIR__ . '/ClassLoader.php';
		}
	}

	static public function getLoader()
	{
		if (NULL !== self::$loader) {
			return self::$loader;
		}

		spl_autoload_register(array('ComposerAutoloaderInit8c7218663417b786fd329e81ded6585f', 'loadClassLoader'), true, true);
		self::$loader = $loader = new \Composer\Autoload\ClassLoader();
		spl_autoload_unregister(array('ComposerAutoloaderInit8c7218663417b786fd329e81ded6585f', 'loadClassLoader'));
		$map = require __DIR__ . '/autoload_namespaces.php';

		foreach ($map as $namespace => $path) {
			$loader->set($namespace, $path);
		}

		$map = require __DIR__ . '/autoload_psr4.php';

		foreach ($map as $namespace => $path) {
			$loader->setPsr4($namespace, $path);
		}

		$classMap = require __DIR__ . '/autoload_classmap.php';

		if ($classMap) {
			$loader->addClassMap($classMap);
		}

		$loader->register(true);
		$includeFiles = require __DIR__ . '/autoload_files.php';

		foreach ($includeFiles as $fileIdentifier => $file) {
			composerrequire8c7218663417b786fd329e81ded6585f($fileIdentifier, $file);
		}

		return $loader;
	}
}

function composerRequire8c7218663417b786fd329e81ded6585f($fileIdentifier, $file)
{
	if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
		require $file;
		$GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
	}
}


?>
