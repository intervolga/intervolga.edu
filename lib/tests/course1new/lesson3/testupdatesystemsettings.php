<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestUpdateSystemSettings extends BaseTest
{
	const UPDATE_SYSTEM_SETTINGS = [
		'update_devsrv'
	];

	protected static function run()
	{
		$moduleSettings = Option::getForModule('main');
		Assert::eq($moduleSettings['update_devsrv'], 'Y',
			Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.UPDATE_SYSTEM_SETTINGS"));
	}
}