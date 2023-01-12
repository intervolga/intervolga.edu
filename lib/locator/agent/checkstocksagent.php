<?php
namespace Intervolga\Edu\Locator\Agent;

use Bitrix\Main\Localization\Loc;

class CheckStocksAgent extends AgentLocator
{
	public static function getNames(): array
	{
		return [
			'AgentCheckStocks',
			'agentCheckStocks',
			'CheckStocksAgent',
			'checkStocksAgent',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CHECK_STOCKS_AGENT');
	}
}
