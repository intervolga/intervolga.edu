<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\IblockLocator;

Loc::loadMessages(__FILE__);

abstract class BaseTestIblockElement extends BaseTest
{
	/**
	 * @return int
	 */
	protected static function getCount()
	{
		return \CIBlockElement::GetList(['cnt'], [
			'ACTIVE' => 'Y',
			'IBLOCK_ID' => static::getIblockLocator()::find()['ID'],
		], []);
	}

	/**
	 * @return \CIBlockResult|int
	 */
	protected static function getElements()
	{
		return \CIBlockElement::GetList(
			[],
			[
				'ACTIVE' => 'Y',
				'IBLOCK_ID' => static::getIblockLocator()::find()['ID'],
			]
		);
	}

	/**
	 * @return string|IblockLocator
	 */
	abstract protected static function getIblockLocator();

	abstract protected static function checkElement(array $element): void;

	protected static function run()
	{
		Assert::iblockLocator(static::getIblockLocator());
		if (static::getIblockLocator()::find()) {
			$elements = static::getElements();
			while ($element = $elements->fetch()) {
				static::checkElement($element);
			}
		}
	}

	public static function interceptErrors()
	{
		return true;
	}
}