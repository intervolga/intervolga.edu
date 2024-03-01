<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Localization\Loc;
use COption;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestAutocaching extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	public static function run()
	{
		Assert::eq(COption::GetOptionString("main", "component_cache_on"), 'Y',
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_3.COMPONENT_CACHE_ON'));
		Assert::eq(COption::GetOptionString("main", "component_managed_cache_on"), 'Y',
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_3.COMPONENT_MANAGED_CACHE_ON'));
	}
}