<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson5;

use Bitrix\Main\Localization\Loc;
use COption;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestConfigAccess extends BaseTest
{
	protected static function run()
	{
		Assert::eq(COption::GetOptionString('main', 'site_checker_access'), 'Y',
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_5.ACCESS_ERRORS'));
	}
}