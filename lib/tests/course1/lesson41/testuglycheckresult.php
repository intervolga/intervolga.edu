<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\Registry\RegexRegistry;

class TestUglyCheckResult extends BaseTest
{
	public static function run()
	{
		$files = PathMaskParser::getFileSystemEntriesByMasks(
			[
				'/local/templates/*/components/bitrix/*/*.php',
				'/local/templates/*/components/bitrix/*/*/*.php',
				'/local/templates/*/components/bitrix/*/*/*/*.php',
			]
		);
		$regexes = RegexRegistry::getUglyCodeFragments();

		foreach ($files as $file) {
			foreach ($regexes as $regex) {
				/**
				 * @var File $file
				 */
				Assert::fileContentNotMatches($file, $regex);
			}
		}
	}
}