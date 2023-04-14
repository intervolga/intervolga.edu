<?php
namespace Intervolga\Edu\Locator\Module\AdminFiles;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Module\ModuleFileLocator;

class MenuFile extends ModuleFileLocator
{
	public static function getNameLoc(): string
	{
			return Loc::getMessage('INTERVOLGA_EDU.ADMIN_FILES_MENU');
	}

	protected static function getPaths(): array
	{
		return [
			'/admin/menu.php',
		];
	}
}