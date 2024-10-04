<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
global $APPLICATION;
if ($APPLICATION->getGroupRight('intervolga.edu') > 'D') {
	$Menu = [
		'parent_menu' => 'global_menu_settings',
		'sort' => 100,
		'text' => 'intervolga.edu',
		'title' => 'intervolga.edu',
		'icon' => 'learning_menu_icon',
		'page_icon' => 'learning_menu_icon',
		'items_id' => 'intervolga.edu',
		'module_id' => 'intervolga.edu',
		'items' => []
	];
	$Menu['items'][] = [
		'text' => 'Проверка академии',
		'title' => 'Проверка академии',
		'url' => '/bitrix/admin/settings.php?lang=ru&mid=intervolga.edu&mid_menu=1',
		'more_url' => [],
	];
	return $Menu;
} else {
	return false;
}