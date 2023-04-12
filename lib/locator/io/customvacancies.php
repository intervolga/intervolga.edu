<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class CustomVacancies extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.LOCATOR_IO_CUSTOM_VACANCIES');
	}

	protected static function getPaths(): array
	{
		$paths = [
			'/local/components/intervolga/vacancies/'
		];

		return $paths;
	}
}
