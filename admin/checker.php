<?php
use Bitrix\Main\Context;
use Bitrix\Main\Web\Json;
use Intervolga\Edu\Util\StandardsHelper;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

global $APPLICATION;
$result = [];
if ($APPLICATION->getFileAccessPermission("/bitrix/admin/")>='R') {
	$contentType = Context::getCurrent()->getRequest()->getPost('contentType');
	$content = Context::getCurrent()->getRequest()->getPost('content');
	$flags = Context::getCurrent()->getRequest()->getPost('flags');
	\Bitrix\Main\Loader::includeModule('intervolga.edu');
	$result = StandardsHelper::getJson($contentType, $content, $flags);
}

echo Json::encode($result);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');