<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class Desktop extends FileLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.DESKTOP');
	}

	protected static function getPaths(): array
	{
		return [
			'/desktop.php',
		];
	}
}