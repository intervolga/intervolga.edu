<?php
namespace Intervolga\Edu\Tests\Course3\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\ClassLocator\CustomModuleClass;
use Intervolga\Edu\Locator\ClassLocator\CustomModuleTable;
use Intervolga\Edu\Tests\BaseTest;

class ClassesChecker extends BaseTest
{
	protected static function run()
	{
		Assert::classLocator(CustomModuleClass::class);
		Assert::classLocator(CustomModuleTable::class);
		if ($class = CustomModuleTable::find()) {
			Assert::phpSniffer([$class->getFileName()], ['oldOrmClass']);
		}
	}
}