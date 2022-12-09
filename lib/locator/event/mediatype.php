<?php
namespace Intervolga\Edu\Locator\Event;

class MediaType extends EventLocator
{

	protected static function getParams(): array
	{
		return [
			"MODULE_ID" => "main",
			"MESSAGE_ID" => "OnUserTypeBuildList",
			"DESCRIPTION" => "Привязка к коллекции медиабиблиотеки",
			"REQUIRED_TYPE" => "int"
		];
	}

	/**
	 * @return bool|mixed|null
	 */
	public static function getModuleEvent()
	{
		$events = GetModuleEvents(static::getParams()["MODULE_ID"],static::getParams()["MESSAGE_ID"] );
		$result = null;
		while ($event = $events->Fetch()) {
			$tempEvent = ExecuteModuleEvent($event);
			if ($tempEvent["DESCRIPTION"] == static::getParams()["DESCRIPTION"]) {
				$result = $tempEvent;
				break;
			}
		}
		return $result;
	}

	/**
	 * @param array $resultHandler
	 * @return bool
	 */
	public static function checkBaseType(array $resultHandler) : bool
	{
		if (!static::getParams()["REQUIRED_TYPE"]) {
			if ($resultHandler["BASE_TYPE"] === static::getParams()["REQUIRED_TYPE"]) {
				return true;
			}

			return false;
		}
		return true;
	}

	public static function getRequiredType() : string
	{
		return static::getParams()["REQUIRED_TYPE"] ?? "";
	}

	public static function getDescription() : string
	{
		return static::getParams()["DESCRIPTION"] ?? "";
	}
}