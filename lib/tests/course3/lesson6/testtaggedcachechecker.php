<?php
namespace Intervolga\Edu\Tests\Course3\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\CustomRespondents;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestTaggedCacheChecker extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(CustomRespondents::class);
		if (CustomRespondents::find()) {
			Assert::fileNotEmpty(CustomRespondents::getComponentFile());
			Assert::fileContentMatches(CustomRespondents::getComponentFile(), new Regex('/CACHE_MANAGER/i', 'CACHE_MANAGER'));
			Assert::fileContentMatches(CustomRespondents::getComponentFile(), new Regex('/StartTagCache/i', 'StartTagCache'));
			Assert::fileContentMatches(CustomRespondents::getComponentFile(), new Regex('/RegisterTag/i', 'RegisterTag'));
		}
	}
}