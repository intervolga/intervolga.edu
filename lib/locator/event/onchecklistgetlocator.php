<?php
namespace Intervolga\Edu\Locator\Event;

use Bitrix\Main\Localization\Loc;

class OnCheckListGetLocator extends EventLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.ON_CHECK_LIST_GET');
	}

	protected static function getParams(): array
	{
		return [
			'MODULE_ID' => 'main',
			'MESSAGE_ID' => 'OnCheckListGet',
		];
	}
}