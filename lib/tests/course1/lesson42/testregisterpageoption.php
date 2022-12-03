<?php
namespace Intervolga\Edu\Tests\Course1\Lesson42;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestRegisterPageOption extends BaseTest
{
	protected static function run()
	{
		$customPage = Option::get('main', 'custom_register_page');
		Assert::notEmpty($customPage, Loc::getMessage('INTERVOLGA_EDU.REGISTER_PAGE_OPTION_NOT_SET'));
		Assert::matches(
			$customPage,
			new Regex(
				'/^(\/[^\/]+)+$/m',
				Loc::getMessage('INTERVOLGA_EDU.REGISTER_PAGE_OPTION_VALID')
			)
		);
	}
}