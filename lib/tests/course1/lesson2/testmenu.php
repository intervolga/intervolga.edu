<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Fileset;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestMenu extends BaseTest
{
	public static function run()
	{
		$publicDirs = FileSystem::getPublicDirsLevelOne();
		$menuFiles = FileSystem::getFilesRecursiveByPathRegex($publicDirs, '/\.menu\.php/m');
		$menuFiles = array_merge($menuFiles, FileSystem::getFilesNonRecursiveByPathRegex([new Directory(Application::getDocumentRoot())], '/\.menu\.php/m'));

		$regexes = [
			new Regex('/(\/.*)?index\.php/i', 'index.php', Loc::getMessage('INTERVOLGA_EDU.FOUND_INDEX_PHP_MENU_LINK')),
		];
		static::testFilesetContentFoundByRegex(new Fileset($menuFiles), $regexes);
	}
}