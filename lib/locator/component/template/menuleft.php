<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Component\Menu;

class MenuLeft extends TemplateLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.MENU_LEFT_TEMPLATE');
	}

	public static function getComponent(): string
	{
		return Menu::class;
	}

	public static function getFilter(): array
	{
		return [
			'=TEMPLATE_NAME' => [
				'left',
				'left_menu',
			],
			'%REAL_PATH' => '/local/templates/inner/footer.php',
		];
	}

	/**
	 * @return string
	 */
	public static function getPossibleTips()
	{
		return implode(' || ', static::getFilter()['=TEMPLATE_NAME']);
	}
}