<?php
namespace Intervolga\Edu\Locator\Module\InstallFiles\Admin;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\CustomModule;
use Intervolga\Edu\Locator\Module\ModuleFileLocator;

class AdminTableFile extends ModuleFileLocator
{

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.INSTALL_ADMIN_TABLE');
	}

	protected static function getPaths(): array
	{
		$result = [];
		if (CustomModule::find()) {
			$result = [
				'/install/admin/' . static::getSelfModuleName() . '_edit.php'
			];
		}

		return $result;
	}
}