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
	 * @param array $resultHandler
	 * @return bool
	 */
	abstract public static function checkBaseType(array $resultHandler): bool;

}