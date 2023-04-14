<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Catalog;
use Intervolga\Edu\Tests\BaseTest;

class TestNavPage extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		AssertComponent::componentLocator(Catalog::class);
		if (Catalog::find()) {
			AssertComponent::parameterEq(
				Catalog::class,
				'PAGE_ELEMENT_COUNT',
				5
			);
			AssertComponent::parameterEq(
				Catalog::class,
				'PAGER_TEMPLATE',
				'arrows'
			);
			AssertComponent::parameterEq(
				Catalog::class,
				'DISPLAY_TOP_PAGER',
				'N'
			);
			AssertComponent::parameterEq(
				Catalog::class,
				'DISPLAY_BOTTOM_PAGER',
				'Y'
			);
		}
	}
}