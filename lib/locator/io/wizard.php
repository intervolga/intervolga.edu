<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class Wizard extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_WIZARD');
	}

	protected static function getPaths(): array
	{
		return [
			'/bitrix/wizards/mywizards/calculator/',
			'/bitrix/wizards/custom/calculator/',
			'/bitrix/wizards/intervolga/calculator/',
		];
	}
}