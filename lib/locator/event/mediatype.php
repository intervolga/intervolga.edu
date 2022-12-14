<?php
namespace Intervolga\Edu\Locator\Event;

use Bitrix\Main\Localization\Loc;

class MediaType extends EventLocator
{
	public static function getRequiredBaseType(): string
	{
		return 'int';
	}

	protected static function getParams(): array
	{
		return [
			'MODULE_ID' => 'main',
			'MESSAGE_ID' => 'OnUserTypeBuildList',
			'DESCRIPTION' => Loc::getMessage('INTERVOLGA_EDU.EVENT_CLASS_DESCRIPTION'),
		];
	}

	protected static $userTypeId;

	/**
	 * @return array|null
	 */
	public static function find()
	{
		$events = GetModuleEvents(static::getParams()['MODULE_ID'], static::getParams()['MESSAGE_ID']);
		$result = null;

		while ($event = $events->fetch()) {
			$tempEvent = ExecuteModuleEvent($event);
			if ($tempEvent['DESCRIPTION'] == static::getParams()['DESCRIPTION']) {
				$result = $tempEvent;
				break;
			}
		}

		static::$userTypeId = $result['USER_TYPE_ID'];

		return $result;
	}

	/**
	 * @param array $resultHandler
	 * @return bool
	 */
	public static function checkBaseType(array $resultHandler): bool
	{
		if (!static::getParams()['REQUIRED_TYPE']) {
			if ($resultHandler['BASE_TYPE'] === static::getParams()['REQUIRED_TYPE']) {
				return true;
			}

			return false;
		}

		return true;
	}

	public static function getDescription(): string
	{
		return static::getParams()['DESCRIPTION'] ?? '';
	}

	public static function getUserTypeId(): string
	{
		return static::$userTypeId ?? '';
	}
}