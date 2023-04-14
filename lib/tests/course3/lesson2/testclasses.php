<?php
namespace Intervolga\Edu\Tests\Course3\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\ClassLocator\CustomModuleParentTable;
use Intervolga\Edu\Locator\ClassLocator\CustomModuleTable;
use Intervolga\Edu\Tests\BaseTest;

class TestClasses extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::classLocator(CustomModuleParentTable::class);
		Assert::classLocator(CustomModuleTable::class);
		if ($class = CustomModuleTable::find()) {
			Assert::phpSniffer([$class->getFileName()], ['oldOrmClass']);
		}
	}
}