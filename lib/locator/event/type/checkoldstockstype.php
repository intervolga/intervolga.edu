<?php
namespace Intervolga\Edu\Locator\Event\Type;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class CheckOldStocksType extends TypeLocator
{
	public static function getFilter(): array
	{
		return [
			'=EVENT_NAME' =>
				[
					'CHECK_OLDER_STOCKS',
					'STOCK_ENDED'
				]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CHECK_OLDER_STOCKS_TYPE');
	}
}