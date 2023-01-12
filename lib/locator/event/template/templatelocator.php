<?php
namespace Intervolga\Edu\Locator\Event\Template;

use Bitrix\Main\Mail\Internal\EventTable;
use Intervolga\Edu\Locator\Event\Message\MessageLocator;

abstract class TemplateLocator
{
	/**
	 * @return string|MessageLocator
	 */
	abstract public static function getMessageLocator(): string;

	abstract public static function getNameLoc(): string;

	public static function find(): array
	{
		$result = [];

		$message = static::getMessageLocator()::find();
		if ($message)
		{
			$fetch = EventTable::getList([
				'filter'=> [
					'=EVENT_NAME' => $message['EVENT_NAME'],
				],
			])->fetch();
			if ($fetch) {
				$result = $fetch;
			}
		}

		return $result;
	}

	public static function getPossibleTips(): string
	{
		return static::getMessageLocator()::getPossibleTips();
	}
}