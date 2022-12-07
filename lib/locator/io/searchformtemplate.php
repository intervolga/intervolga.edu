<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class SearchFormTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/search.form/header/',
			'/local/templates/.default/components/bitrix/search.form/top/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.SEARCH_FORM_TEMPLATE');
	}
}
