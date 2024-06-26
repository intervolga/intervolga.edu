<?php
namespace Intervolga\Edu\Locator\Module;

use Bitrix\Main\Localization\Loc;

class ModuleInclude extends ModuleFileLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.MODULE_INCLUDE');
	}

	protected static function getPaths(): array
	{
		return [
			'/include.php'
		];
	}
}