<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class MainHeaderTemplate extends FileLocator
{

	protected static function getPaths(): array
	{
		return [
			'/local/templates/main/header.php',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.MAIN_HEADER_TEMPLATE');
	}
}