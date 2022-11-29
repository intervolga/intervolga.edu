<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\PathsRegistry;
use Intervolga\Edu\Util\Regex;

class TestMenu extends BaseTest
{
	public static function run()
	{
		$menuFiles = PathMaskParser::getFileSystemEntriesByMask('*.menu.php');
		$publicDirs = PathsRegistry::getPublicDirsLevelOne();
		$innerMenuFiles = PathMaskParser::getFileSystemEntriesByMasks(
			[
				'*.menu.php',
				'*/*.menu.php',
				'*/*/*.menu.php',
			],
			$publicDirs
		);
		$menuFiles = array_merge($menuFiles, $innerMenuFiles);
		$regexes = [
			new Regex('/(\/.*)?index\.php/i', 'index.php', Loc::getMessage('INTERVOLGA_EDU.FOUND_INDEX_PHP_MENU_LINK')),
		];
		static::registerErrorIfFileContentFoundByRegex($menuFiles, $regexes);
	}
}