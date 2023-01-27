<?php
namespace Intervolga\Edu\Locator\Event\EventMessage;

use Bitrix\Main\Mail\Internal\EventMessageTable;
use Intervolga\Edu\Locator\BaseLocator;

abstract class EventMessageLocator extends BaseLocator
{

	public static function find()
	{
		$result = EventMessageTable::getList([
			'filter' => static::getFilter(),
		])->fetch();

		return $result;
	}

	abstract public static function getFilter(): array;

	public static function getDisplayText($find): string
	{
		return $find['EVENT_NAME'];
	}

	abstract public static function getNameLoc(): string;
}