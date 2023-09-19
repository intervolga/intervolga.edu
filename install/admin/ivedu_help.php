<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
use Bitrix\Main\Loader;

$mid = 'intervolga.edu';
Loader::includeModule($mid);

require($_SERVER["DOCUMENT_ROOT"] . IV_EDU_MODULE_DIR . "/admin/help.php");