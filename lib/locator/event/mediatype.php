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
			'RULES' => [
				'DESCRIPTION' => Loc::getMessage('INTERVOLGA_EDU.EVENT_CLASS_DESCRIPTION')
			]
		];
	}

	/**
	 * @return array|null
	 */
	public static function find(): ?array
	{
		$events = GetModuleEvents(static::getParams()['MODULE_ID'], static::getParams()['MESSAGE_ID']);
		$result = null;
		$rules = static::getParams()['RULES'];
		while ($event = $events->fetch()) {
			$tempEvent = ExecuteModuleEvent($event);
			$isCurrent = true;
			foreach ($rules as $k => $rule) {
				if ($tempEvent[$k] !== $rule) {
					$isCurrent = false;
					break;
				}
			}
			if ($isCurrent) {
				$result = $tempEvent;
				break;
			}
		}

		return $result;
	}
}