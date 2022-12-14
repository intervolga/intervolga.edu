<?php
namespace Intervolga\Edu\Asserts;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Localization\Loc;

class AssertComponent extends Assert
{
	public static function checkComponentInTable($componentName)
	{
		$count = ParametersTable::getCount(['=COMPONENT_NAME' => $componentName]);
		Assert::notEmpty($count, Loc::getMessage('INTERVOLGA_EDU.ASSERT_COMPONENT_NOT_FOUND',
			[
				'#VALUE#' => static::valueToString($componentName),
			]));
	}
}