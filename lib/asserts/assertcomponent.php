<?php

namespace Intervolga\Edu\Asserts;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Localization\Loc;

class AssertComponent extends Assert
{
	public static function checkComponentInTable($filter)
	{
		$count = ParametersTable::getCount($filter);
		$name = static::valueToString($filter);
		$name = substr($name, 32);
		$name = substr($name, 0, -4);

		Assert::notEmpty($count, Loc::getMessage('INTERVOLGA_EDU.ASSERT_COMPONENT_NOT_FOUND',
			[
				'#VALUE#' => $name,
			]));
	}
}