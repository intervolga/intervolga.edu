<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\AdminFormOptions;
use Intervolga\Edu\Util\Regex;

abstract class BaseTestIblock extends BaseTest
{
	const ALL_USERS_GROUP = 2;

	/**
	 * @return string|IblockLocator
	 */
	abstract protected static function getLocator();

	abstract protected static function getMinCount(): int;

	/**
	 * @return PropertyLocator[]
	 */
	protected static function getPropertiesLocators(): array
	{
		return [];
	}

	public static function interceptErrors()
	{
		return true;
	}

	public static function getTestLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_IBLOCK_NAME', [
			'#IBLOCK#' => static::getLocator()::getNameLoc(),
		]);
	}

	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_IBLOCK_DESCRIPTION');
	}

	protected static function run()
	{
		Assert::iblockLocator(static::getLocator());
		if ($iblock = static::getLocator()::find()) {
			$options = AdminFormOptions::getForIblock($iblock['ID']);
			static::testIblockType($iblock);
			static::testElementsLog($iblock);
			static::testPermission($iblock);
			static::testElementsCount($iblock);
			static::testProperties($iblock);
			Assert::notEmpty($options, Loc::getMessage('INTERVOLGA_EDU.IBLOCK_OPTIONS_LOST', [
				'#IBLOCK_LINK#' => Admin::getIblockElementAddUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			]));
			static::testOneTab($iblock, $options);
			foreach (static::getPropertiesLocators() as $propertyLocator) {
				Assert::propertyLocator($propertyLocator);
			}
		}
	}

	protected static function testElementsCount(array $iblock)
	{
		Assert::greaterEq(
			static::countElements($iblock['ID']),
			static::getMinCount(),
			Loc::getMessage(
				'INTERVOLGA_EDU.IBLOCK_ELEMENTS_NOT_ENOUGH',
				[
					'#IBLOCK_LINK#' => Admin::getIblockElementsUrl($iblock),
					'#IBLOCK#' => $iblock['NAME'],
					'#EXPECT#' => static::getMinCount(),
				]
			)
		);
	}

	protected static function testOneTab(array $iblock, array $options)
	{
		Assert::eq(
			count($options['TABS']),
			1,
			Loc::getMessage('INTERVOLGA_EDU.USE_ONE_TAB_FOR_IBLOCK_FORM', [
				'#IBLOCK_LINK#' => Admin::getIblockElementAddUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
	}

	protected static function testIblockType(array $iblock)
	{
		Assert::eq(
			$iblock['IBLOCK_TYPE_ID'],
			'content',
			Loc::getMessage('INTERVOLGA_EDU.WRONG_IBLOCK_TYPE', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
				'#TYPE#' => 'content',
			])
		);
	}

	protected static function testElementsLog(array $iblock)
	{
		$fields = \CIBlock::getFields($iblock['ID']);
		Assert::eq(
			$fields['LOG_ELEMENT_ADD']['IS_REQUIRED'],
			'Y',
			Loc::getMessage('INTERVOLGA_EDU.ENABLE_ELEMENTS_LOG', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
		Assert::eq(
			$fields['LOG_ELEMENT_EDIT']['IS_REQUIRED'],
			'Y',
			Loc::getMessage('INTERVOLGA_EDU.ENABLE_ELEMENTS_LOG', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
		Assert::eq(
			$fields['LOG_ELEMENT_DELETE']['IS_REQUIRED'],
			'Y',
			Loc::getMessage('INTERVOLGA_EDU.ENABLE_ELEMENTS_LOG', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
	}

	protected static function testPermission(array $iblock)
	{
		$tmp = \CIBlock::getGroupPermissions($iblock['ID']);
		Assert::eq(
			$tmp[static::ALL_USERS_GROUP],
			'R',
			Loc::getMessage('INTERVOLGA_EDU.SET_PERMISSION_EVERYONE_R', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
	}

	protected static function testProperties(array $iblock)
	{
		$properties = \CIBlock::getProperties($iblock['ID']);
		while ($property = $properties->fetch()['CODE']) {
			Assert::matches($property, new Regex('/^[_A-Z0-9]*$/', 'PRICE'),
				Loc::getMessage('INTERVOLGA_EDU.IB_PROPERTY_HAS_LOWER_CASE',
					[
						'#IB#' => $iblock['NAME'],
						'#PROPERTY#' => $property
					]));
		}
	}

	protected static function countElements(int $iblockId): int
	{
		return ElementTable::getCount([
			'IBLOCK_ID' => $iblockId,
			'ACTIVE' => 'Y'
		]);
	}
}