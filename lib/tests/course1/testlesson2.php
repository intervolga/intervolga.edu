<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
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
		static::testLowerCase();
		static::testPartnersDir();
		// Ссылки в меню с /index.php в конце
		static::testLocalPhpInterface();
		static::testDumpFunction();
	}

	public static function testLowerCase()
	{
		$lowerCaseDirs = [
			'/',
			'/company/',
			'/for-partners/',
			'/partner/',
			'/partners/',
		];
		foreach ($lowerCaseDirs as $lowerCaseDir) {
			$directory = new Directory(Application::getDocumentRoot() . $lowerCaseDir);
			if ($directory->isExists()) {
				foreach ($directory->getChildren() as $child) {
					if ($child->getName() != strtolower($child->getName())) {
						$path = $child->getPath();
						$path = str_replace(Application::getDocumentRoot(), '', $path);
						if ($child->isDirectory()) {
							$path .= '/';
							static::registerError(Loc::getMessage(
								'INTERVOLGA_EDU.DIR_NOT_LOWER_CASE',
								[
									'#PATH#' => $path,
								]
							));
						} else {
							static::registerError(Loc::getMessage(
								'INTERVOLGA_EDU.FILE_NOT_LOWER_CASE',
								[
									'#PATH#' => $path,
								]
							));
						}
					}
				}
			}

		}
	}

	public static function testPartnersDir()
	{
		$forbiddenNames = [
			'partneram',
		];
		$directory = new Directory(Application::getDocumentRoot());
		foreach ($directory->getChildren() as $child) {
			if ($child->isDirectory()) {
				$dirName = strtolower($child->getName());
				if (in_array($dirName, $forbiddenNames)) {
					static::registerError(
						Loc::getMessage(
							'INTERVOLGA_EDU.PARTNERS_DIR_FORBIDDEN_NAME',
							['#NAME#' => $child->getName()]
						)
					);
				}
			}
		}
	}

	public static function testLocalPhpInterface()
	{
		$path = Application::getDocumentRoot() . '/local/php_interface/init.php';
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