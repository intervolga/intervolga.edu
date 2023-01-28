<?php
namespace Intervolga\Edu\Locator\Event;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class MediaType extends EventLocator
{
	protected static function getParams(): array
	{
		return [
			'MODULE_ID' => 'main',
			'MESSAGE_ID' => 'OnUserTypeBuildList',
			'RESULT' => [
				'DESCRIPTION' => Loc::getMessage('INTERVOLGA_EDU.EVENT_CLASS_DESCRIPTION')
			]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.EVENT_CLASS_DESCRIPTION');
	}

	/**
	 * @return array|null
	 */
	public static function find(): ?array
	{
		$result = [];
		$events = GetModuleEvents(static::getParams()['MODULE_ID'], static::getParams()['MESSAGE_ID']);
		$resultFilter = static::getResult();
		while ($event = $events->fetch()) {
			$found = true;
			if ($resultFilter) {
				$eventResult = ExecuteModuleEvent($event);
				foreach ($resultFilter as $filter => $value) {
					if ($eventResult[$filter] !== $value) {
						$found = false;
						break;
					}
				}
			}
			if ($found) {
				$result = $event;
				if ($resultFilter) {
					$result['RESULT'] = $eventResult;
				}
				break;
			}
		}

		return $result;
	}
}