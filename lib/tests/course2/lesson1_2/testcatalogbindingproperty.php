<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\Property\CatalogBindingProperty;
use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestCatalogBindingProperty extends BaseTest
{
	protected const MIN_COUNT_IBLOCK = 3;

	protected static function run()
	{
		Assert::iblockLocator(static::getPropertiesLocators()::getIblock());
		Assert::propertyLocator(static::getPropertiesLocators());
		Assert::greaterEq(static::getPropertiesLocators()::getCountNotEmptyProperty(), static::MIN_COUNT_IBLOCK);
	}

	/**
	 * @return string|PropertyLocator
	 */
	private static function getPropertiesLocators()
	{
		return CatalogBindingProperty::class;
	}
}