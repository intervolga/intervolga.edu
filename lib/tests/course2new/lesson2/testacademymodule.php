<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestAcademyModule extends BaseTest
{
	const CUSTOM_MODULE_ID = 'mycompany.custom';

	protected static function run()
	{
		Assert::directoryExists(FileSystem::getDirectory('/local/modules/company.custom/'),
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.NOT_IN_LOCAL'));

		Assert::true(ModuleManager::isModuleInstalled(static::CUSTOM_MODULE_ID),
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.MODULE'));
	}
}