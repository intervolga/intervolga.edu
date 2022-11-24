<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestLesson2 extends BaseTest
{
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COURSE_1_LESSON_2');
	}

	public static function run()
	{
		$filesToDelete = ['/services/index.php'];
		$dirsToDelete = ['/services/'];
		$lowerCaseDirs = [
			'/',
			'/company/'
		];
		// Адекватность partners -- вынести в требования?
		// Наличие /local/php_interface/
		static::testLocalPhpInterface();
		static::testDumpFunction();
	}

	public static function testLocalPhpInterface()
	{
		$path = \Bitrix\Main\Application::getDocumentRoot() . '/local/php_interface/init.php';
		if (!File::isFileExists($path)) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.LOCAL_PHP_INTERFACE_NOT_FOUND'));
		}
	}

	public static function testDumpFunction()
	{
		if (!function_exists('test_dump')) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.TEST_DUMP_NOT_FOUND'));
		}
	}
}