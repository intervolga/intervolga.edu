<?php
namespace Intervolga\Edu\Eventhandlers;

class Main
{
	function OnPanelCreateHandler()
	{
		global $APPLICATION;
		$APPLICATION->AddPanelButton([
			"ID" => "228",
			"TEXT" => "Проверка академии",
			"HREF" => "/bitrix/admin/settings.php?lang=ru&mid=intervolga.edu",
			"SRC" => "/bitrix/images/intervolga.edu/logo-academy.png",
			"TYPE" => "BIG",
			"MAIN_SORT" => 1400,
		]);

	}
}
