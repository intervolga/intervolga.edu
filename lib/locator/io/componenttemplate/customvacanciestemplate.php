<?php

namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Util\FileSystem;

class CustomVacanciesTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		$paths = [];
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['CUSTOM_COMPONENTS'] as $customComponent) {
			$paths[] = '/local/components/' . $customComponent . '/vacancies';
		}
		return $paths;
	}

	public static function getNameLoc(): string
	{
		return 'CustomVacanciesTemplate';
	}
}