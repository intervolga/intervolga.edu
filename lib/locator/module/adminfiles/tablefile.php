<?php
namespace Intervolga\Edu\Locator\Module\AdminFiles;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Module\ModuleFileLocator;

class TableFile extends ModuleFileLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.ADMIN_FILES_TABLE');
	}

	protected static function getPaths(): array
	{
		return [
			'/admin/table.php',
			'/admin/show_table.php',
		];
	}
}