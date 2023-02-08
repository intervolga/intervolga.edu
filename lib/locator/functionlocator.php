<?php
namespace Intervolga\Edu\Locator;

abstract class FunctionLocator extends BaseLocator
{
	/**
	 * @return string[]
	 */
	abstract protected static function getPossibleNames();

	/**
	 * @return string
	 */
	public static function find()
	{
		$result = null;
		foreach (static::getPossibleNames() as $name) {
			if (function_exists($name)) {
				$result = $name;
			}
		}

		return $result;
	}

	public static function getDisplayText($find): string
	{
		return $find;
	}

	public static function getPossibleTips()
	{
		$names = static::getPossibleNames();

		return implode('||', $names);
	}
}