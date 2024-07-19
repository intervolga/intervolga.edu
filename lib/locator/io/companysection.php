<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class CompanySection extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/company/'
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPANY_DIRECTORY');
	}
}
