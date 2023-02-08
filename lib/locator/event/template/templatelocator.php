<?php
namespace Intervolga\Edu\Locator\Event\Template;

use Bitrix\Main\Mail\Internal\EventMessageTable;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Locator\Event\Type\TypeLocator;
use Intervolga\Edu\Util\Admin;

abstract class TemplateLocator extends BaseLocator
{
	/**
	 * @return string|TypeLocator
	 */
	abstract public static function getTypeLocator(): string;

	public static function find(): array
	{
		$result = [];

		$message = static::getTypeLocator()::find();
		if ($message)
		{
			$fetch = EventMessageTable::getList([
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
		return static::getTypeLocator()::getPossibleTips();
	}

	public static function getDisplayText($find): string
	{
		return '[' . $find['ID']. '] ' . $find['SUBJECT'];
	}

	protected static function getDisplayHref($find): string
	{
		return Admin::getEventMessageUrl($find);
	}
}