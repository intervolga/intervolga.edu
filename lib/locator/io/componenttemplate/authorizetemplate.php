<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class AuthorizeTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/system.auth.form/auth/',
			'/local/templates/.default/components/bitrix/system.auth.form/form/',
			'/local/templates/.default/components/bitrix/system.auth.form/top/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AUTHORIZE_TEMPLATE');
	}
}
