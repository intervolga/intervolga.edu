<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\IncludeArea;

class PhoneIncludeArea extends TemplateLocator
{
	public static function getFilter(): array
	{
		return [
			'%PARAMETERS'=> '/include/phone.php',
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