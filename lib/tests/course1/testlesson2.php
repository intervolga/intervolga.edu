<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Tests\Filesets\FilesetBuilder;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

Loc::loadMessages(__FILE__);

class TestLesson2 extends BaseTest
{
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COURSE_1_LESSON_2');
	}

	public static function run()
	{
		static::testDeleted();
		static::testLowerCase();
		static::testPartnersDir();
		static::testPartnersPage();
		static::testMenu();
		static::testLocalPhpInterface();
		static::testDumpFunction();
	}

	protected static function testDeleted()
	{
		$fileset = FilesetBuilder::getPublic(true, false);
		$regex = '/\/services$/ui';	// /services/
		static::testIfFilesetMatches($fileset, $regex, Loc::getMessage('INTERVOLGA_EDU.SERVICES_DELETE'));
	}

	protected static function testLowerCase()
	{
		$fileset = FilesetBuilder::getPublic(true, true);
		$regex = '/[A-Z]/u';	// A-Z
		static::testIfFilesetMatches($fileset, $regex, Loc::getMessage('INTERVOLGA_EDU.NOT_LOWER_CASE'));
	}

	protected static function testPartnersDir()
	{
		$partnersSection = FilesetBuilder::getPartnersSection();

		if (!$partnersSection) {
			static::registerError(
				Loc::getMessage(
					'INTERVOLGA_EDU.PARTNERS_DIR_NOT_FOUND',
					['#POSSIBLE#' => implode(', ', FilesetBuilder::POSSIBLE_PARTNERS_NAMES)]
				)
			);
		}
	}

	protected static function testPartnersPage()
	{
		foreach (FilesetBuilder::POSSIBLE_PARTNERS_NAMES as $possiblePartnerName) {
			$directory = new Directory(Application::getDocumentRoot() . $possiblePartnerName);
			if ($directory->isExists() && $directory->isDirectory()) {
				$indexPath = $directory->getPath() . '/index.php';
				$indexFile = new File($indexPath);
				$content = $indexFile->getContents();
				if (substr_count($content, '<img')) {
					if (!substr_count($content, '/upload/')) {
						static::registerError(Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_UPLOAD_SRC', [
							'#ADMIN_LINK#' => Admin::getFileManUrl($indexFile),
						]));
					}
				} else {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_IMG_TAG', [
						'#ADMIN_LINK#' => Admin::getFileManUrl($indexFile),
					]));
				}
				if (!substr_count($content, '<table')) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_TABLE_TAG', [
						'#ADMIN_LINK#' => Admin::getFileManUrl($indexFile),
					]));
				}
			}
		}
	}

	protected static function testMenu()
	{
		$publicDirs = FileSystem::getPublicDirsLevelOne();
		$menuFiles = FileSystem::getFilesRecursiveByPathRegex($publicDirs, '/\.menu\.php/m');
		$menuFiles = array_merge($menuFiles, FileSystem::getFilesNonRecursiveByPathRegex([new Directory(Application::getDocumentRoot())], '/\.menu\.php/m'));
		foreach ($menuFiles as $menuFile) {
			$content = $menuFile->getContents();
			$re = '/(\/.*)?index\.php/m';
			preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);
			foreach ($matches as $match) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.FOUND_INDEX_PHP_MENU_LINK', [
					'#PATH#' => FileSystem::getLocalPath($menuFile),
					'#ADMIN_LINK#' => Admin::getFileManUrl($menuFile),
					'#LINK#' => $match[0],
				]));
			}
		}
	}

	protected static function testLocalPhpInterface()
	{
		$path = Application::getDocumentRoot() . '/local/php_interface/init.php';
		if (!File::isFileExists($path)) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.LOCAL_PHP_INTERFACE_NOT_FOUND'));
		}
	}

	protected static function testDumpFunction()
	{
		if (!function_exists('test_dump')) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.TEST_DUMP_NOT_FOUND'));
		}
	}
}