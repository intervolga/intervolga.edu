<?php
namespace Intervolga\Edu\Tests\Course3\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\CustomRespondents;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestCacheComponentCheker extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(CustomRespondents::class);
		if (CustomRespondents::find()) {
			Assert::fileNotEmpty(CustomRespondents::getComponentFile());
			Assert::fileContentMatches(CustomRespondents::getComponentFile(), new Regex('/CPHPCache/i', 'CPHPCache'));
			Assert::fileContentMatches(CustomRespondents::getComponentFile(), new Regex('/InitCache/i', 'InitCache'));
			Assert::fileContentMatches(CustomRespondents::getComponentFile(), new Regex('/StartDataCache/i', 'StartDataCache'));
		}
	}
}