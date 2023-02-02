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
		$paths = [];
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['CUSTOM_COMPONENTS'] as $customComponent) {
			$paths[] = '/local/components/' . $customComponent . '/vacancies';
		}
		return $paths;
	}
}
