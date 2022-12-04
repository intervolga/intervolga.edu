<?php
namespace Intervolga\Edu\Tests\Course3\Lesson1;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\CustomModule;
use Intervolga\Edu\Tests\BaseTest;

class TestModule extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(CustomModule::class);
		$customModuleDir = CustomModule::find();
		Assert::moduleInstalled($customModuleDir->getName());
	}
}
