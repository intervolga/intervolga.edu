<?php
namespace Intervolga\Edu\Tests;

abstract class BaseTest
{
	/**
	 * @return string[]
	 */
	public static function getErrors()
	{
		return ['Not implemented yet'];
	}

	public static function getErrorsPrefixed()
	{
		$result = [];
		$errors = static::getErrors();
		foreach ($errors as $error) {
			$result[] = '[' . get_called_class() .'] ' . $error;
		}

		return $result;
	}
}
