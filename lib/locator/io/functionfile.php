<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class FunctionFile extends FileLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/php_interface/function.php',
			'/local/php_interface/functions.php',
			'/local/php_interface/include/function.php',
			'/local/php_interface/include/functions.php',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.FUNCTION_FILE');
	}
}
