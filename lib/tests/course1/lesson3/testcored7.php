<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\RegexRegistry;

class TestCoreD7 extends BaseTest
{
	public static function run()
	{
		$regexes = RegexRegistry::getNewCore();

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		static::registerErrorIfFileContentFoundByRegex($files, $regexes);
	}
}