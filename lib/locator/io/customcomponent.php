<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class CustomComponent extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/components/custom/vacancies.list',
			'/local/components/custom/vacancy.list',
			'/local/components/mycomponents/vacancies.list',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_COMPONENT');
	}

}
{

}