<?php
namespace Intervolga\Edu\Locator\Event;

use Bitrix\Main\EventManager;
use Intervolga\Edu\Locator\BaseLocator;

abstract class EventLocator extends BaseLocator
{
	abstract protected static function getParams(): array;

	/**
	 * @return array
	 */
	public static function find()
	{
		$result = [];
		$events = static::getEvents(static::getParams()['MODULE_ID'], static::getParams()['MESSAGE_ID']);
		$events = array_reverse($events);
		$resultFilter = static::getResult();
		$afterFilter = static::getParams()['AFTER_FILTER'] ?? [];
		foreach ($events as $event) {
			$found = true;
			if ($afterFilter) {
				if (!static::checkEventByFilter($event, $afterFilter)) {
					$found = false;
				}
			}
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

	/**
	 * @return array
	 */
	public static function getResult(): array
	{
		return static::getParams()['RESULT'] ?? [];
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

	public static function getPossibleTips()
	{
		$result = [];
		$filter = static::getResult();
		foreach ($filter as $field => $value) {
			if (mb_substr($field, 0, 1) == '=') {
				$field = mb_substr($field, 1);
			}
			if (!is_array($value)) {
				$value = [$value];
			}
			$result[] = $field . '=' . implode('||', $value);
		}

		return implode(';', $result);
	}

	public static function getDisplayText($find): string
	{
		return $find['MESSAGE_ID'] . ' -> ' . $find['RESULT']['CLASS_NAME'];
	}

	/**
	 * @param string $module
	 * @param string $eventType
	 * @return array
	 */
	protected static function getEvents(string $module, string $eventType)
	{
		$eventManager = EventManager::getInstance();
		$events = $eventManager->findEventHandlers($module, $eventType);
		foreach ($events as $i => $event) {
			$event['FROM_MODULE_ID'] = $module;
			$event['MESSAGE_ID'] = $eventType;
			if (!$event['FROM_DB']) {
				$event['FROM_DB'] = 0;
			}
			if (!$event['TO_MODULE_ID']) {
				$event['TO_MODULE_ID'] = '';
			}
			if (!$event['TO_PATH']) {
				$event['TO_PATH'] = '';
			}
			if (!$event['FULL_PATH']) {
				$event['FULL_PATH'] = '';
			}
			ksort($event);
			$events[$i] = $event;
		}

		return $events;
	}

	protected static function checkEventByFilter(array $event, array $filter)
	{
		foreach ($filter as $key => $value) {
			if ($value === false) {
				if (strlen($event[$key])) {
					return false;
				}
			} else {
				if ($event[$key] != $value) {
					return false;
				}
			}
		}

		return true;
	}
}