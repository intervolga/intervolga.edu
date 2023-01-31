<?php
namespace Intervolga\Edu\Locator\Event\Type;

use Bitrix\Main\Mail\Internal\EventTypeTable;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Util\Admin;

abstract class TypeLocator extends BaseLocator
{
	abstract public static function getFilter(): array;

	public static function find(): array
	{
		$result = [];

		$fetch = EventTypeTable::getList([
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

	public static function getDisplayText($find): string
	{
		return $find['EVENT_NAME'];
	}

	public static function getDisplayHref($find): string
	{
		return Admin::getEventTypeUrl($find);
	}
}