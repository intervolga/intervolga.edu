<?php
namespace Intervolga\Edu\Locator\Component;

use Bitrix\Main\Localization\Loc;

class CustomVacanciesList extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['intervolga:vacancies.list'];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPONENT_CUSTOM_VACANCIES_LIST');
	}
}