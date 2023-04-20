<?php
namespace Intervolga\Edu\Eventhandlers;

class Main
{
	function OnPanelCreateHandler()
	{
		global $APPLICATION;
		$action = $APPLICATION->GetPopupLink([
			"URL" => "/bitrix/admin/settings.php?lang=ru&mid=intervolga.edu",
			"PARAMS" => [
				"width" => 780,
				"height" => 570,
				"resizable" => true,
				"min_width" => 780,
				"min_height" => 400
			]]);
		$menu = [];
		$menu[] = [
			'TEXT' => 'В popup\'е',
			'ACTION' => $action,

		];

		$APPLICATION->AddPanelButton([
			'ID' => '228',
			'TEXT' => 'Проверка академии',
			'HREF' => '/bitrix/admin/settings.php?lang=ru&mid=intervolga.edu',
			'SRC' => '/bitrix/images/intervolga.edu/logo-academy.png',
			'TYPE' => 'BIG',
			'MAIN_SORT' => 1400,
			'MENU' => $menu
		]);

	}
}
