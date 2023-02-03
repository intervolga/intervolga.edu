<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class CustomVacanciesTemplate extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.LOCATOR_IO_CUSTOM_VACANCIES_TEMPLATE');
	}

	protected static function getPaths(): array
	{
		$paths = [];
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['CUSTOM_COMPONENTS'] as $customComponent) {
			$paths[] = '/local/components/' . $customComponent . '/vacancies/templates/.default';
		}

		return $paths;
	}
}