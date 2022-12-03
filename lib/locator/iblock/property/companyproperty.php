<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ReviewsIblock;

class CompanyProperty extends PropertyLocator
{
	public static function getIblock()
	{
		return ReviewsIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'COMPANY',
			],
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPANY_PROPERTY');
	}
}
