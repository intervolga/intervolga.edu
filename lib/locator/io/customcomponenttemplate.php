<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class CustomComponentTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/components/custom/vacancies.list/templates/.default',
			'/local/components/custom/vacancy.list/templates/.default',
			'/local/components/mycomponents/vacancies.list/templates/.default',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_COMPONENT_TEMPLATE');
	}

}