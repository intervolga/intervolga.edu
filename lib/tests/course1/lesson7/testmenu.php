<?php
namespace Intervolga\Edu\Tests\Course1\Lesson7;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\Menu;
use Intervolga\Edu\Tests\BaseTest;

class TestMenu extends BaseTest
{

	protected static function run()
	{
		AssertComponent::checkComponentInTable(static::getLocator());
		$parametersMenu = static::getComponentParameters(static::getLocator()::getComponentName());
		foreach ($parametersMenu as $parameter) {
			Assert::eq(
				$parameter['MENU_CACHE_TYPE'],
				'N',
				Loc::getMessage('INTERVOLGA_EDU.ASSERT_COMPONENT_PARAMETERS_CACHE_TYPE',
					[
						'#COMPONENT#' => var_export(static::getLocator()::getComponentName(), true),
						'#TEMPLATE#' => var_export($parameter['COMPONENT_TEMPLATE'], true),
					]
				)
			);

			Assert::eq(
				$parameter['MENU_CACHE_USE_GROUPS'],
				'N',
				Loc::getMessage('INTERVOLGA_EDU.ASSERT_COMPONENT_PARAMETERS_CACHE_GROUPS',
					[
						'#COMPONENT#' => var_export(static::getLocator()::getComponentName(), true),
						'#TEMPLATE#' => var_export($parameter['COMPONENT_TEMPLATE'], true),
					]
				)
			);
		}

	}

	/**
	 * @return string|ComponentLocator
	 */
	protected static function getLocator()
	{
		return Menu::class;
	}

	protected static function getComponentParameters($componentName)
	{
		$filter = [
			'=COMPONENT_NAME' => $componentName,
		];

		$getList = ParametersTable::getList([
			'filter' => $filter,
			'select' => [
				'ID',
				'PARAMETERS',
			],
		]);
		while ($row = $getList->fetch()) {
			$parameters[] = unserialize($row['PARAMETERS']);
		}

		return $parameters;

	}
}