<?php
namespace Intervolga\Edu\Tests\Course3\Lesson1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\PathsRegistry;

class TestModule extends BaseTest
{
	protected static function run()
	{
		$modulesDirs = PathsRegistry::getCustomModuleDirectories();
		Assert::notEmpty($modulesDirs, Loc::getMessage('INTERVOLGA_EDU.NO_INTERVOLGA_MODULES'));
		foreach ($modulesDirs as $moduleDir) {
			Assert::moduleInstalled($moduleDir->getName());
		}
	}
}
