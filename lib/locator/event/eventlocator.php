<?php
namespace Intervolga\Edu\Locator\Event;

use Intervolga\Edu\Locator\BaseLocator;

abstract class EventLocator extends BaseLocator
{
	abstract protected static function getParams(): array;

	/**
	 * @return bool|mixed|null
	 */
	abstract public static function find();

	/**
	 * @return array
	 */
	public static function getRules(): array
	{
		return static::getParams()['RULES'] ?? [];
	}
	/**
	 * @return string
	 */
	public static function getModuleID(): string
	{
		return static::getParams()['MODULE_ID'] ?? '';
	}

	/**
	 * @return string
	 */
	public static function getMessageID(): string
	{
		return static::getParams()['MESSAGE_ID'] ?? '';
	}

	public static function getPossibleTips()
	{
		$result = [];
		$filter = static::getRules();
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
		return $find['MESSAGE_ID'];
	}
}