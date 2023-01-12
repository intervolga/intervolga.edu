<?php
namespace Intervolga\Edu\Locator\Event\Message;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class CheckOldStocksMessage extends MessageLocator
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
		return Loc::getMessage('INTERVOLGA_EDU.CHECK_OLDER_STOCKS_MESSAGE');
	}
}