<?php
namespace Intervolga\Edu\Locator\Event\Message;

use Bitrix\Main\Mail\Internal\EventMessageTable;

abstract class MessageLocator
{
	abstract public static function getFilter(): array;

	abstract public static function getNameLoc(): string;

	public static function find(): array
	{
		$result = [];

		$fetch = EventMessageTable::getList([
			'filter' => static::getFilter(),
		])->fetch();
		if ($fetch) {
			$result = $fetch;
		}

		return $result;
	}

	public static function getPossibleTips(): string
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