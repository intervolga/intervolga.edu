<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

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
		static::registerErrorIfFileContentFoundByRegex($files, $regexes);
	}
}