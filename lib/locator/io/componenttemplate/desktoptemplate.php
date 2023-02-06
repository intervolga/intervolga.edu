<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class DesktopTemplate extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPONENT_TEMPLATE_DESKTOP');
	}

	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/desktop/.default/',
		];
	}
}