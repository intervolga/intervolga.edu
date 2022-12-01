<?php
namespace Intervolga\Edu\Tests\Course1\Lesson42;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

class TestRegisterPageOption extends BaseTest
{
	public static function run()
	{
		$customPage = Option::get('main', 'custom_register_page');
		if (mb_strlen($customPage)) {
			preg_match_all(
				'/^(\/[^\/]+)+$/m',
				$customPage,
				$matches,
				PREG_SET_ORDER
			);
			if (!$matches) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.REGISTER_PAGE_OPTION_INVALID', [
					'#OPTION#' => $customPage,
				]));
			}
		} else {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.REGISTER_PAGE_OPTION_NOT_SET'));
		}
	}
}