<?php
namespace Intervolga\Edu\Locator\Event\EventMessage;

use Bitrix\Main\Localization\Loc;

class UserPassRequest extends EventMessageLocator
{

	public static function getFilter(): array
	{
		return [
			'=EVENT_NAME' => 'USER_PASS_REQUEST',
			'=ACTIVE' => 'Y',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.LOCATOR.EVENT_MESSAGE.USER_PASS_REQUEST');
	}
}