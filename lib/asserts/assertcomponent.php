<?php
namespace Intervolga\Edu\Asserts;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;

Loc::loadMessages(__FILE__);

class AssertComponent extends Assert
{
	/**
	 * @param string|ComponentLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function componentLocator($value, string $message = '')
	{
		if ($find = $value::find()) {
			static::registerLocatorFound(ComponentLocator::class, $value, $find);
		} else {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_COMPONENT_LOCATOR',
				[
					'#COMPONENT#' => $value::getPossibleTips(),
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
		if ($find = $value::find()) {
			static::registerLocatorFound(TemplateLocator::class, $value, $find);
		} else {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_TEMPLATE_LOCATOR',
				[
					'#TEMPLATE#' => $value::getNameLoc(),
					'#COMPONENT#' => $value::getComponent()::getPossibleTips(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));
		}
	}

	/**
	 * @param string|ComponentLocator $value
	 * @param string $param
	 * @param string $expect
	 * @param string $message
	 * @throws AssertException
	 */
	public static function parameterEq($value, string $param, string $expect, string $message = '')
	{
		$parameters = $value::find()['PARAMETERS'];
		if ($parameters) {
			$paramToCheck = $parameters[$param];
			if (substr_count($param, '.')) {
				$paramParts = explode('.', $param);
				$paramToCheck = $parameters[$paramParts[0]][$paramParts[1]];
			}
			if ($paramToCheck != $expect) {
				static::registerError(static::getCustomOrLocMessage(
					'INTERVOLGA_EDU.ASSERT_COMPONENT_PARAMETER_EQ',
					[
						'#COMPONENT#' => $value::getPossibleTips(),
						'#PARAM#' => $param,
						'#VALUE#' => static::valueToString($paramToCheck),
						'#EXPECT#' => static::valueToString($expect),
					],
					$message
				));
			}
		}
	}
}