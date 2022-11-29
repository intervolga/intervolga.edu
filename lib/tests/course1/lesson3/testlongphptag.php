<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\RegexRegistry;

class TestLongPhpTag extends BaseTest
{
	public static function run()
	{
		$regexes = RegexRegistry::getShortPhpTag();

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		static::registerErrorIfFileContentFoundByRegex($files, $regexes);
	}
}