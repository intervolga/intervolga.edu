<?php
namespace Intervolga\Edu\Tests\Course3\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\ClassLocator\CustomModuleParentTable;
use Intervolga\Edu\Locator\ClassLocator\CustomModuleTable;
use Intervolga\Edu\Locator\Module\ModuleInclude;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestClasses extends BaseTest
{
	protected static function run()
	{
		Assert::moduleFileExists(ModuleInclude::class);
		Assert::fileContentMatches(ModuleInclude::find(),
			new Regex('/Loader::registerAutoLoadClasses/', 'Loader::registerAutoLoadClasses()'));

		Assert::classLocator(CustomModuleParentTable::class);
		Assert::classLocator(CustomModuleTable::class);
		if ($class = CustomModuleTable::find()) {
			Assert::phpSniffer([$class->getFileName()], ['oldOrmClass']);
		}
	}
}