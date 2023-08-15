<?php
namespace Intervolga\Edu\Locator\IO\directory;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class MainTemplates extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.MAIN_TEMPLATE_DIRECTORY');
	}

	protected static function getPaths(): array
	{
		return
			[
				'/local/templates/main/',
			];
	}
}