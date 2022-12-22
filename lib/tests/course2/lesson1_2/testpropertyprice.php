<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\Property\PriceProperty;
use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestPropertyPrice extends BaseTest
{
	protected static function run()
	{
		Assert::notEmpty(static::getPropertiesLocators()::getIblock()::find());
		Assert::propertyLocator(static::getPropertiesLocators(), Loc::getMessage('INTERVOLGA_EDU.PRICE_PROPERTY_S'));
	}

	/**
	 * @return string|PropertyLocator
	 */
	private static function getPropertiesLocators()
	{
		return PriceProperty::class;
	}
}