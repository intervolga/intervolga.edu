<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class PartnersSection extends DirectoryLocator
{
	public static function getPaths(): array
	{
		return [
			'/for-partners/',
			'/partners/',
			'/partner/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PARTNERS_DIRECTORY');
	}
}
