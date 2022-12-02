<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\RegexRegistry;

class TestCoreD7 extends BaseTest
{
	public static function run()
	{
		$regexes = RegexRegistry::getOldCore();

		/**
		 * @var File[] $files
		 */
		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		foreach ($files as $file) {
			foreach ($regexes as $regex) {
				Assert::fileContentNotMatches($file, $regex);
			}
		}
	}
}