<?php
namespace Intervolga\Edu\Tests;

abstract class BaseTest
{
	protected static $errors = [];

	/**
	 * @return string
	 */
	public static function getTitle()
	{
		return str_replace(__NAMESPACE__ . '\\', '', get_called_class());
	}

	public static function run()
	{
		static::registerError('Not implemented yet');
	}

	public static function runAndGetErrors()
	{
		$result = [];
		static::run();
		foreach (static::getErrors() as $error) {
			$result[] = '[' . get_called_class() . '] ' . $error;
		}

		return $result;
	}

	/**
	 * @param string $error
	 */
	protected static function registerError($error)
	{
		static::$errors[get_called_class()][] = $error;
	}

	/**
	 * @return string[]
	 */
	public static function getErrors()
	{
		return (array)static::$errors[get_called_class()];
	}
}
