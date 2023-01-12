<?php
namespace Intervolga\Edu\Locator\Event\Template;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Event\Message\CheckOldStocksMessage;
use Intervolga\Edu\Locator\Event\Message\MessageLocator;

Loc::loadMessages(__FILE__);

class CheckOldStocksTemplate extends TemplateLocator
{
	/**
	 * @return string|MessageLocator
	 */
	public static function getMessageLocator(): string
	{
		return CheckOldStocksMessage::class;
	}

	public static function getNameLoc(): string
	{
		$class = static::getMessageLocator();
		return $class::getNameLoc();
	}
}