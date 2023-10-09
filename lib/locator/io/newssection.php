<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class NewsSection extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/news/'
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.NEWS_DIRECTORY');
	}
}
