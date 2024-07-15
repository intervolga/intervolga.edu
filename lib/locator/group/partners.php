<?php
namespace Intervolga\Edu\Locator\Group;

use Bitrix\Main\Localization\Loc;

class Partners extends GroupLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.GROUP_PARTNERS');
	}

	public static function getCodeGroup(): array
	{
		return ['partners'];
	}

	public static function getDisplayText($find): string
	{
		return $find['NAME'];
	}
}
