<?php
namespace Intervolga\Edu\Locator\Event;

use Bitrix\Main\Localization\Loc;

class OnBeforeUserUpdateLocator extends EventLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.ON_BEFORE_USER_UPDATE_EVENT');
	}

	protected static function getParams(): array
	{
		return [
			'MODULE_ID' => 'main',
			'MESSAGE_ID' => 'OnBeforeUserUpdate',
			'AFTER_FILTER' => [
				'TO_MODULE_ID' => false,
			],
		];
	}
}