<?php
namespace Intervolga\Edu\Util\Registry\Directory;

use Bitrix\Main\Localization\Loc;

class PartnersDirectory extends BaseDirectory
{
	public static function getPaths(): array
	{
		return [
			'/for-partners/',
			'/partners/',
			'/partner/',
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PARTNERS_DIRECTORY');
	}
}
