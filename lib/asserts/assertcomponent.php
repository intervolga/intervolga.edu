<?php
namespace Intervolga\Edu\Asserts;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;

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

	/**
	 * @param string|ComponentLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function componentLocator($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_COMPONENT_LOCATOR',
				[
					'#COMPONENT#' => $value::getComponentName(),
				],
				$message
			));

		}
	}
	/**
	 * @param string|TemplateLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function templateLocator($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_TEMPLATE_LOCATOR',
				[
					'#TEMPLATE#' => $value::getNameLoc(),
					'#COMPONENT#' => $value::getComponent()::getComponentName(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));

		}
	}
}