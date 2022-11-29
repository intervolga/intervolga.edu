<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;

abstract class BaseTestIblock extends BaseTest
{
	const ALL_USERS_GROUP = 2;

	protected static function commonChecks(array $iblock, array $options, int $countElements)
	{
		static::checkIblockType($iblock);
		static::checkElementsLog($iblock);
		static::checkPermission($iblock);
		static::checkElementsCount($iblock, $countElements);
		if ($options) {
			static::checkOneTab($iblock, $options);
		} else {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.IBLOCK_OPTIONS_LOST', [
				'#IBLOCK_LINK#' => Admin::getIblockElementAddUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			]));
		}
	}

	protected static function checkElementsCount(array $iblock, int $count)
	{
		if (static::countElements($iblock['ID'])<$count) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.IBLOCK_ELEMENTS_NOT_ENOUGH', [
				'#IBLOCK_LINK#' => Admin::getIblockElementsUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
				'#COUNT#' => $count,
			]));
		}
	}

	protected static function checkOneTab(array $iblock, array $options)
	{
		if (count($options['TABS'])>1) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.USE_ONE_TAB_FOR_IBLOCK_FORM', [
				'#IBLOCK_LINK#' => Admin::getIblockElementAddUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			]));
		}
	}

	protected static function checkIblockType(array $iblock)
	{
		if ($iblock['IBLOCK_TYPE_ID'] != 'content') {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.WRONG_IBLOCK_TYPE', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
				'#TYPE#' => 'content',
			]));
		}
	}

	protected static function checkElementsLog(array $iblock)
	{
		$fields = \CIBlock::getFields($iblock['ID']);
		$options = [
			$fields['LOG_ELEMENT_ADD']['IS_REQUIRED'],
			$fields['LOG_ELEMENT_EDIT']['IS_REQUIRED'],
			$fields['LOG_ELEMENT_DELETE']['IS_REQUIRED'],
		];
		if (in_array('N', $options)) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.ENABLE_ELEMENTS_LOG', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			]));
		}
	}

	protected static function checkPermission(array $iblock)
	{
		$tmp = \CIBlock::getGroupPermissions($iblock['ID']);
		if ($tmp[static::ALL_USERS_GROUP] != 'R') {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.SET_PERMISSION_EVERYONE_R', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
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