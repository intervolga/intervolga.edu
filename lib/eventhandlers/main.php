<?php

namespace Intervolga\Edu\Eventhandlers;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class Main
{
	public static function OnPanelCreateHandler()
	{
		global $APPLICATION;
		$url = '/bitrix/admin/settings.php?lang=ru&mid=intervolga.edu';

		$APPLICATION->AddPanelButton([
			'TEXT' => Loc::getMessage('INTERVOLGA_EDU.MODULE_NAME'),
			'HREF' => $url,
			'SRC' => '/bitrix/images/intervolga.edu/logo-academy.png',
			'TYPE' => 'BIG',
			'MAIN_SORT' => 1400,
		]);
	}
}
