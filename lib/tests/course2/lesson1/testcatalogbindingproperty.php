<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\Property\CatalogBindingProperty;
use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestCatalogBindingProperty extends BaseTest
{
	protected static function run()
	{
		Assert::notEmpty(static::getPropertiesLocators()::getIblock()::find());
		Assert::propertyLocator(static::getPropertiesLocators());
		Assert::greaterEq(static::getPropertiesLocators()::getCountNotEmptyProperty(), 3);
		Assert::eq(static::getPropertiesLocators()::getPropertyParameters()['PROPERTY_TYPE'], 'E');

	}

	/**
	 * @return string|PropertyLocator
	 */
	private static function getPropertiesLocators()
	{
		return CatalogBindingProperty::class;
	}
}