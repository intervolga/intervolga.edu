<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\PromoIblock;
use Intervolga\Edu\Locator\Iblock\Property\CatalogBindingProperty;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentParameters;

class TestCatalogBindingProperty extends BaseTest
{
	protected static function run()
	{
		if (!empty(static::getLocator()::find())) {
			Assert::propertyLocator(static::getPropertiesLocators());
			Assert::greaterEq(static::getPropertiesLocators()->getCountNotEmtyProperty(), 3);
			Assert::eq(static::getPropertiesLocators()->getPropertyParameters()['PROPERTY_TYPE'], 'E');
		}
	}

	protected static function getLocator()
	{
		return PromoIblock::class;
	}

	private static function getPropertiesLocators() {
		return CatalogBindingProperty::class;
	}
}