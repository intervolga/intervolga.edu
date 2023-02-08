<?php
namespace Intervolga\Edu\Locator\Event;

use Bitrix\Main\Localization\Loc;

class OnBeforeIblockElementDeleteLocator extends EventLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.ON_ELEMENT_DELETE_EVENT');
	}

	protected static function getParams(): array
	{
		return [
			'MODULE_ID' => 'iblock',
			'MESSAGE_ID' => 'OnBeforeIBlockElementDelete',
			'AFTER_FILTER' => [
				'TO_MODULE_ID' => false,
			],
		];
	}
}