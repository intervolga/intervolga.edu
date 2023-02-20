<?php
namespace Intervolga\Edu\Locator\Component;

use Bitrix\Main\Localization\Loc;

class CustomVacancies extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['intervolga:vacancies'];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPONENT_CUSTOM_VACANCIES');
	}
}