<?php
namespace Intervolga\Edu\Locator\IO\directory;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class DefaultTemplates extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.DEFAULT_TEMPLATE_DIRECTORY');
	}

	protected static function getPaths(): array
	{
		return
			[
				'/local/templates/.default/',
			];
	}
}