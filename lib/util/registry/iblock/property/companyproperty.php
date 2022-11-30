<?php
namespace Intervolga\Edu\Util\Registry\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class CompanyProperty extends BaseProperty
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
