<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Bitrix\Main\ModuleManager;

class TestAcademModule extends BaseTest
{
	const ACADEMY_MODULE_ID = "bitrix.academy";

	protected static function run()
	{
		Assert::true(ModuleManager::isModuleInstalled(static::ACADEMY_MODULE_ID),
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_2.MODULE'));
	}
}