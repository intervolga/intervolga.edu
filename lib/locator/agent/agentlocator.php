<?php
namespace Intervolga\Edu\Locator\Agent;

abstract class AgentLocator
{
	abstract public static function getFilter(): array;

	abstract public static function getNameLoc(): string;

	public static function find(): array
	{
		$result = [];


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
}