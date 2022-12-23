<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;

abstract class BaseTestTemplateParameters extends BaseTest
{
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
				'NAME' =>'CACHE_TYPE',
				'EXPECTED'=>'A',
				'MESSAGE'=>'INTERVOLGA_EDU.CACHE_TYPE_A'
			],
			[
				'NAME' =>'CACHE_GROUPS',
				'EXPECTED'=>'N',
				'MESSAGE'=>'INTERVOLGA_EDU.CACHE_GROUPS'
			]
		];
	}

	protected static function checkParameters($parametersExpected)
	{
		$parameters = static::getLocator()::find()['PARAMETERS'];
		AssertComponent::t1emplateComponentIsExist($parameters, static::getLocator()::getFilter());

		foreach ($parametersExpected as $parameterExpected) {
			Assert::eq(
				$parameters[$parameterExpected['NAME']],
				$parameterExpected['EXPECTED'],
				Loc::getMessage($parameterExpected['MESSAGE'])
			);

		}

	}

}