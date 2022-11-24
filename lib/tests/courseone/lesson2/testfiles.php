<?php
namespace Intervolga\Edu\Tests\CourseOne\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestFiles extends BaseTest
{
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_FILES') . ' (' . parent::getTitle() . ')';
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
		static::testDumpFunction();
	}

	public static function testDumpFunction()
	{
		if (!function_exists('test_dump')) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.TEST_DUMP_NOT_FOUND'));
		}
	}
}