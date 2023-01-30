<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Main\Localization\Loc;

class ResultsPollingIblock extends IblockLocator
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'result_polling',
				'result.polling',
				'results_polling',
				'results.polling',
				'polling',
				'results.polling',
				'results_polling',
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_RESULTS_POLLING');
	}
}