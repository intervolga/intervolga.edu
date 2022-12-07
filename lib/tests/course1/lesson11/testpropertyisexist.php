<?php

namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\Property\AvailableProperty;
use Intervolga\Edu\Tests\BaseTest;

class TestPropertyIsExist extends BaseTest
{
	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COURSE1_LESSON11_PROPERTYISEXIST_DESCRIPTION');
	}
	
	protected static function run()
	{
		if (static::getLocator()::find()) {
			foreach (self::getPropertiesLocators() as $property) {
				Assert::propertyLocator($property);
				Assert::greaterEq(AvailableProperty::getCountNotEmtyProperty(), 1);
			}
		}
	}
	
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
			AvailableProperty::class,
		];
	}
}
