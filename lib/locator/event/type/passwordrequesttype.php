<?php
namespace Intervolga\Edu\Locator\Event\Type;

use Bitrix\Main\Localization\Loc;

class PasswordRequestType extends TypeLocator
{
	public static function getFilter(): array
	{
		return [
			'=EVENT_NAME' =>
				[
					'CHECK_OLDER_STOCKS',
				]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PASSWORD_REQUEST_TYPE');
	}
}