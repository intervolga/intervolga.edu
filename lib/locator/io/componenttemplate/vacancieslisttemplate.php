<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class VacanciesListTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/components/intervolga/vacancies.list/templates/.default/',
			'/local/components/intervolga/vacancy.list/templates/.default/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.VACANCIES_LIST_TEMPLATE');
	}

}