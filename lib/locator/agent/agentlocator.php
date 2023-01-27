<?php
namespace Intervolga\Edu\Locator\Agent;

use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Util\Admin;

abstract class AgentLocator extends BaseLocator
{
	abstract public static function getNames(): array;

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

	public static function getDisplayText($find): string
	{
		return '[' . $find['ID'] . '] ' . $find['NAME'];
	}

	public static function getDisplayHref($find): string
	{
		return Admin::getAgentUrl($find);
	}
}