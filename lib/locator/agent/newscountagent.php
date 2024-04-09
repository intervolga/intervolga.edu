<?php
namespace Intervolga\Edu\Locator\Agent;

use Bitrix\Main\Localization\Loc;

class NewsCountAgent extends AgentLocator
{
	public static function getNames(): array
	{
		return [
			'checkNewsCountAgent',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.NEW_ACAD.NEWS_AGENT');
	}
}
