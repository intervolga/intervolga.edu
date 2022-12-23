<?php
namespace Intervolga\Edu\Asserts;

use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;

class AssertComponent extends Assert
{
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
					'#COMPONENT#' => $value::getCode(),
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
					'#COMPONENT#' => $value::getComponent()::getCode(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));

		}
	}
}