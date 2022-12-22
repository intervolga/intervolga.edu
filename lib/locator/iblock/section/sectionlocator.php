<?php
namespace Intervolga\Edu\Locator\Iblock\Section;

use Bitrix\Iblock\SectionTable;
use Bitrix\Main\Loader;
use Intervolga\Edu\Locator\Iblock\IblockLocator;

abstract class SectionLocator
{
	abstract public static function getNameLoc(): string;

	public static function find(): array
	{
		$result = [];
		Loader::includeModule('iblock');
		$iblockClass = static::getIblock();
		$iblockArray = $iblockClass::find();
		if ($iblockArray) {
			$getList = SectionTable::getList([
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

	/**
	 * @return string|IblockLocator
	 */
	abstract public static function getIblock();

	abstract public static function getFilter(): array;

	/**
	 * @return string
	 */
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

		return implode(';', $result);
	}
}