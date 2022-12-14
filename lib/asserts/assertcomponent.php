<?php

namespace Intervolga\Edu\Asserts;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Localization\Loc;

class AssertComponent extends Assert
{
	public static function checkComponentInTable($filter)
	{
		$count = ParametersTable::getCount($filter);
		Assert::notEmpty($count, Loc::getMessage('INTERVOLGA_EDU.ASSERT_COMPONENT_NOT_FOUND'));
	}
}