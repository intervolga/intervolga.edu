<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use CIBlockProperty;
use Intervolga\Edu\Locator\Iblock\PromoIblock;
use Intervolga\Edu\Locator\Iblock\RespondentIblock;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;

class ConnectRespondentProperty extends PropertyLocator
{
	public static function getIblock()
	{
		return ResultsPollingIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'RESPONDENT',
				'CONNECT_RESPONDENT',
				'LINK_RESPONDENT'
			],
			'PROPERTY_TYPE' => [
				'E'
			]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.RESPONDENT_PROPERTY');
	}

}
