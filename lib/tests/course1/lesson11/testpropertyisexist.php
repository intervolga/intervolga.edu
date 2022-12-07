<?php

namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\Property\AvailableProperty;

use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
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
	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COURSE1_LESSON11_PROPERTYISEXIST_DESCRIPTION');
	}
	
	protected static function run()
	{
		if (static::getLocator()::find()) {
			foreach ( self::getPropertiesLocators() as $property) {
				Assert::propertyLocator($property);
				Assert::notEmpty(AvailableProperty::getPropertyBind());
			}
		}
	}
	
	
}
