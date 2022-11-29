<?php
namespace Intervolga\Edu\Util\Registry\Iblock;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;

abstract class BaseIblock
{
	abstract public static function getFilter(): array;

	abstract public static function getName(): string;

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
		while ($fetch = $getList->fetch()) {
			$result = $fetch;
		}

		return $result;
	}

	public static function getPossibleTips()
	{
		$result = [];
		$filter = static::getFilter();
		foreach ($filter as $field => $value) {
			if (mb_substr($field, 0, 1) == '=')
			{
				$field = mb_substr($field, 1);
			}
			if (!is_array($value))
			{
				$value = [$value];
			}
			$result[] = $field . '=' . implode('||', $value);
		}

		return implode(';', $result);
	}
}
