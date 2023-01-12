<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Util\Admin;

abstract class PropertyLocator extends BaseLocator
{
	/**
	 * @return string|IblockLocator
	 */
	abstract public static function getIblock();

	abstract public static function getFilter(): array;

	public static function find(): array
	{
		$result = [];
		Loader::includeModule('iblock');
		$iblockClass = static::getIblock();
		$iblockArray = $iblockClass::find();
		if ($iblockArray) {
			$getList = PropertyTable::getList([
				'order' => [
					'ID' => 'ASC',
				],
				'filter' => array_merge(
					[
						'IBLOCK_ID' => $iblockArray['ID'],
					],
					static::getFilter()
				),
			]);
			if ($fetch = $getList->fetch()) {
				$result = $fetch;
			}
		}

		return $result;
	}

	public static function getPossibleTips()
	{
		$result = [];
		$filter = static::getFilter();
		foreach ($filter as $field => $value) {
			if (mb_substr($field, 0, 1) == '=') {
				$field = mb_substr($field, 1);
			}
			if (!is_array($value)) {
				$value = [$value];
			}
			$result[] = $field . '=' . implode('||', $value);
		}

		return implode(';', $result) . '; IBLOCK_' . static::getIblock()::getPossibleTips() . ')';
	}

	public static function getDisplayText($find): string
	{
		return '[' . $find['ID'] . '] ' . $find['NAME'];
	}
}
