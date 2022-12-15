<?php

namespace Intervolga\Edu\Tests\Course2\Lesson1;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\Property\PriceProperty;
use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestPropertyPrice extends BaseTest
{
	protected static function run()
	{
		Assert::notEmpty(static::getPropertiesLocators()::getIblock()::find());
		Assert::propertyLocator(static::getPropertiesLocators());
		Assert::eq(static::getPropertiesLocators()::getPropertyParameters()['PROPERTY_TYPE'], 'S');
	}

	/**
	 * @return string|PropertyLocator
	 */
	private static function getPropertiesLocators()
	{
		return PriceProperty::class;
	}
}