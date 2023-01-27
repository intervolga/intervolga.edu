<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

abstract class IblockLocator extends BaseLocator
{
	abstract public static function getFilter(): array;

	public static function find(): array
	{
		$result = [];
		Loader::includeModule('iblock');
		$getList = IblockTable::getList([
			'order' => [
				'ID' => 'ASC',
			],
			'filter' => static::getFilter(),
		]);
		if ($fetch = $getList->fetch()) {
			$result = $fetch;
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

		return implode(';', $result);
	}

	public static function getDisplayText($find): string
	{
		return '[' . $find['ID'] . '] ' . $find['NAME'];
	}

	public static function getDisplayHref($find): string
	{
		return Admin::getIblockUrl($find);
	}
}
