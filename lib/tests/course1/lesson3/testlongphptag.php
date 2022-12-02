<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\RegexRegistry;

class TestLongPhpTag extends BaseTest
{
	protected static function run()
	{
		$regexes = RegexRegistry::getShortPhpTag();

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
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