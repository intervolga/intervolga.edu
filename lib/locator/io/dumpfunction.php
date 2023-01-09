<?php
namespace Intervolga\Edu\Locator\IO;

class DumpFunction extends FileLocator
{

	public static function getNameLoc(): string
	{
		return 'dump function';
	}

	public static function getPossibleTips()
	{
		return implode('||', static::getPossibleName());
	}

	public static function getPossibleName()
	{
		return [
			'test_dump',
			'dump',
			'dump_test'
		];
	}

	public static function findFunctionDump()
	{
		$names = static::getPossibleName();
		foreach ($names as $name) {
			if (function_exists($name)) {
				return $name;
			}
		}

		return false;
	}

	protected static function getPaths(): array
	{
		$result = [];
		foreach (static::getPossibleName() as $name) {
			$result [] = '/local/php_interface/' . $name . '.php';
		}

		return $result;
	}
}