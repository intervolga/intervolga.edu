<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\Regex;
use Intervolga\Edu\Util\Registry\PathsRegistry;

class TestMenu extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
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
		$regex = new Regex(
			'/(\/.*)?index\.php/i',
			'index.php'
		);
		foreach ($menuFiles as $menuFile) {
			Assert::fileContentNotMatches(
				$menuFile,
				$regex
			);
		}
	}
}