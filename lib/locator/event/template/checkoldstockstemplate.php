<?php
namespace Intervolga\Edu\Locator\Event\Template;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Event\Type\CheckOldStocksType;
use Intervolga\Edu\Locator\Event\Type\TypeLocator;

Loc::loadMessages(__FILE__);

class CheckOldStocksTemplate extends TemplateLocator
{
	/**
	 * @return string|TypeLocator
	 */
	public static function getTypeLocator(): string
	{
		return CheckOldStocksType::class;
	}

	public static function getNameLoc(): string
	{
		$class = static::getTypeLocator();
		return $class::getNameLoc();
	}
}