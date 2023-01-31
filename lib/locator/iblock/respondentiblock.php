<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Main\Localization\Loc;

class RespondentIblock extends IblockLocator
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'respondent',
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_RESPONDENT');
	}
}