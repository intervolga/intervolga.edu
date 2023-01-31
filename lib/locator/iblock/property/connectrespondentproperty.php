<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;

Loc::loadMessages(__FILE__);

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
