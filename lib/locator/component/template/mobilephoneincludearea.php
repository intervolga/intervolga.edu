<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\IncludeArea;

class MobilePhoneIncludeArea extends TemplateLocator
{
	public static function getFilter(): array
	{
		return [
			'%PARAMETERS'=> '/include/mobilephone.php',
		];
	}

	/**
	 * @return string|ComponentLocator
	 */
	public static function getComponent(): string
	{
		return IncludeArea::class;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.MOBILE_PHONE_TEMPLATE');
	}
}