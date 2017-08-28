<?php
//dezend by  QQ:2172298892
class PHPExcel_Settings
{
	const PCLZIP = 'PHPExcel_Shared_ZipArchive';
	const ZIPARCHIVE = 'ZipArchive';
	const CHART_RENDERER_JPGRAPH = 'jpgraph';
	const PDF_RENDERER_TCPDF = 'tcPDF';
	const PDF_RENDERER_DOMPDF = 'DomPDF';
	const PDF_RENDERER_MPDF = 'mPDF';

	static private $_chartRenderers = array(self::CHART_RENDERER_JPGRAPH);
	static private $_pdfRenderers = array(self::PDF_RENDERER_TCPDF, self::PDF_RENDERER_DOMPDF, self::PDF_RENDERER_MPDF);
	/**
     * Name of the class used for Zip file management
     *	e.g.
     *		ZipArchive
     *
     * @var string
     */
	static private $_zipClass = self::ZIPARCHIVE;
	/**
     * Name of the external Library used for rendering charts
     *	e.g.
     *		jpgraph
     *
     * @var string
     */
	static private $_chartRendererName;
	/**
     * Directory Path to the external Library used for rendering charts
     *
     * @var string
     */
	static private $_chartRendererPath;
	/**
     * Name of the external Library used for rendering PDF files
     *	e.g.
     * 		mPDF
     *
     * @var string
     */
	static private $_pdfRendererName;
	/**
     * Directory Path to the external Library used for rendering PDF files
     *
     * @var string
     */
	static private $_pdfRendererPath;
	/**
     * Default options for libxml loader
     *
     * @var int
     */
	static private $_libXmlLoaderOptions;

	static public function setZipClass($zipClass)
	{
		if (($zipClass === self::PCLZIP) || ($zipClass === self::ZIPARCHIVE)) {
			self::$_zipClass = $zipClass;
			return true;
		}

		return false;
	}

	static public function getZipClass()
	{
		return self::$_zipClass;
	}

	static public function getCacheStorageMethod()
	{
		return PHPExcel_CachedObjectStorageFactory::getCacheStorageMethod();
	}

	static public function getCacheStorageClass()
	{
		return PHPExcel_CachedObjectStorageFactory::getCacheStorageClass();
	}

	static public function setCacheStorageMethod($method = PHPExcel_CachedObjectStorageFactory::cache_in_memory, $arguments = array())
	{
		return PHPExcel_CachedObjectStorageFactory::initialize($method, $arguments);
	}

	static public function setLocale($locale = 'en_us')
	{
		return PHPExcel_Calculation::getInstance()->setLocale($locale);
	}

	static public function setChartRenderer($libraryName, $libraryBaseDir)
	{
		if (!self::setChartRendererName($libraryName)) {
			return false;
		}

		return self::setChartRendererPath($libraryBaseDir);
	}

	static public function setChartRendererName($libraryName)
	{
		if (!in_array($libraryName, self::$_chartRenderers)) {
			return false;
		}

		self::$_chartRendererName = $libraryName;
		return true;
	}

	static public function setChartRendererPath($libraryBaseDir)
	{
		if ((file_exists($libraryBaseDir) === false) || (is_readable($libraryBaseDir) === false)) {
			return false;
		}

		self::$_chartRendererPath = $libraryBaseDir;
		return true;
	}

	static public function getChartRendererName()
	{
		return self::$_chartRendererName;
	}

	static public function getChartRendererPath()
	{
		return self::$_chartRendererPath;
	}

	static public function setPdfRenderer($libraryName, $libraryBaseDir)
	{
		if (!self::setPdfRendererName($libraryName)) {
			return false;
		}

		return self::setPdfRendererPath($libraryBaseDir);
	}

	static public function setPdfRendererName($libraryName)
	{
		if (!in_array($libraryName, self::$_pdfRenderers)) {
			return false;
		}

		self::$_pdfRendererName = $libraryName;
		return true;
	}

	static public function setPdfRendererPath($libraryBaseDir)
	{
		if ((file_exists($libraryBaseDir) === false) || (is_readable($libraryBaseDir) === false)) {
			return false;
		}

		self::$_pdfRendererPath = $libraryBaseDir;
		return true;
	}

	static public function getPdfRendererName()
	{
		return self::$_pdfRendererName;
	}

	static public function getPdfRendererPath()
	{
		return self::$_pdfRendererPath;
	}

	static public function setLibXmlLoaderOptions($options = NULL)
	{
		if (is_null($options)) {
			$options = LIBXML_DTDLOAD | LIBXML_DTDATTR;
		}

		@libxml_disable_entity_loader($options == (LIBXML_DTDLOAD | LIBXML_DTDATTR));
		self::$_libXmlLoaderOptions = $options;
	}

	static public function getLibXmlLoaderOptions()
	{
		if (is_null(self::$_libXmlLoaderOptions)) {
			self::setLibXmlLoaderOptions(LIBXML_DTDLOAD | LIBXML_DTDATTR);
		}

		@libxml_disable_entity_loader($options == (LIBXML_DTDLOAD | LIBXML_DTDATTR));
		return self::$_libXmlLoaderOptions;
	}
}

if (!defined('PHPEXCEL_ROOT')) {
	define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../');
	require PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php';
}

?>
