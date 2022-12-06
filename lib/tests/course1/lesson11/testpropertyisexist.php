<?php

namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\Property\AvailableProperty;

use Intervolga\Edu\Tests\BaseTestIblock;

class TestPropertyIsExist extends BaseTestIblock
{
	/**
	 * @return string|IblockLocator
	 */
	protected static function getLocator()
	{
		return ProductsIblock::class;
	}
	protected static function getPropertiesLocators(): array
	{
		return [
			AvailableProperty::class
		];
	}
	protected static function getMinCount(): int
	{
		return 1;
	}
	
	protected static function run()
	{
		if ($iblock = static::getLocator()::find()) {
			foreach ( $properties = self::getPropertiesLocators() as $property) {
				Assert::propertyLocator($property);
			}
		}
	}
	
	
}
{
	
}