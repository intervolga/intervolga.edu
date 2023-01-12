<?php
namespace Intervolga\Edu\Locator\Agent;

abstract class AgentLocator
{
	abstract public static function getNames(): array;

	abstract public static function getNameLoc(): string;

	public static function find(): array
	{
		$result = [];

		$getList = \CAgent::getList();
		while ($fetch = $getList->fetch()) {
			foreach (static::getNames() as $name) {
				if (substr_count($fetch['NAME'], $name)) {
					$result = $fetch;
					break;
				}
			}
		}

		return $result;
	}

	public static function getPossibleTips()
	{
		$names = static::getNames();

		return implode('||', $names);
	}
}