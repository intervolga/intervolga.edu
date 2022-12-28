<?php
namespace Intervolga\Edu\Locator\Event;

abstract class EventLocator
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
}