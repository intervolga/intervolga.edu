<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Intervolga\Edu\Locator\IO\DirectoryLocator;

class DesktopTemplate extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return 'десктопе';
	}

	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/desktop/.default/',
		];
	}
}