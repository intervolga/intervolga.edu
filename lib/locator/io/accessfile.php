<?php
namespace Intervolga\Edu\Locator\IO;

class AccessFile extends FileLocator
{

	public static function getNameLoc(): string
	{
		return '.access.php';
	}

	protected static function getPaths(): array
	{
		return ['/.access.php'];
	}
}