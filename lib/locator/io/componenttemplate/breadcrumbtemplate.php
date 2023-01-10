<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class BreadcrumbTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/breadcrumb/nav/',
			'/local/templates/.default/components/bitrix/breadcrumb/breadcrumb/',
			'/local/templates/.default/components/bitrix/breadcrumb/breadcrumbs/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.BREADCRUMB_TEMPLATE');
	}
}
