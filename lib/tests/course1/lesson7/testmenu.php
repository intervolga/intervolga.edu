<?php
namespace Intervolga\Edu\Tests\Course1\Lesson7;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\Menu;
use Intervolga\Edu\Tests\BaseTest;

class TestMenu extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		AssertComponent::componentLocator(static::getLocator());
		$components = static::getLocator()::findAll();
		foreach ($components as $component) {
			Assert::eq(
				$component['PARAMETERS']['MENU_CACHE_TYPE'],
				'N',
				Loc::getMessage('INTERVOLGA_EDU.ASSERT_COMPONENT_PARAMETERS_CACHE_TYPE',
					[
						'#COMPONENT#' => static::getLocator()::getPossibleTips(),
						'#TEMPLATE#' => $component['PARAMETERS']['COMPONENT_TEMPLATE'],
						'#PATH#' => $component['REAL_PATH'],
					]
				)
			);

			Assert::eq(
				$component['PARAMETERS']['MENU_CACHE_USE_GROUPS'],
				'N',
				Loc::getMessage('INTERVOLGA_EDU.ASSERT_COMPONENT_PARAMETERS_CACHE_GROUPS',
					[
						'#COMPONENT#' => static::getLocator()::getPossibleTips(),
						'#TEMPLATE#' => $component['PARAMETERS']['COMPONENT_TEMPLATE'],
						'#PATH#' => $component['REAL_PATH'],
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
}