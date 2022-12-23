<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;

abstract class BaseTestTemplateParameters extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		AssertComponent::templateLocator(static::getLocator());
		$parametersExpected = static::getParametersExpectedList();
		static::checkParameters($parametersExpected);
	}

	/**
	 * @return string|TemplateLocator
	 */
	abstract protected static function getLocator();

	protected static function getParametersExpectedList(): array
	{
		return [
			[
				'NAME' => 'CACHE_TYPE',
				'EXPECTED' => 'A',
				'MESSAGE' => 'INTERVOLGA_EDU.CACHE_TYPE_A',
			],
			[
				'NAME' => 'CACHE_GROUPS',
				'EXPECTED' => 'N',
				'MESSAGE' => 'INTERVOLGA_EDU.CACHE_GROUPS',
			]
		];
	}

	protected static function checkParameters($parametersExpected)
	{
		$template = static::getLocator()::find();
		if ($template) {
			foreach ($parametersExpected as $parameterExpected) {
				$replace = [
					'#COMPONENT#' => $template['COMPONENT_NAME'],
					'#TEMPLATE#' => $template['TEMPLATE_NAME'],
					'#PATH#' => $template['REAL_PATH'],
				];
				Assert::eq(
					$template['PARAMETERS'][$parameterExpected['NAME']],
					$parameterExpected['EXPECTED'],
					Loc::getMessage(
						$parameterExpected['MESSAGE'],
						$replace
					)
				);
			}
		}
	}
}