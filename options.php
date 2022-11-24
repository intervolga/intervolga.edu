<?php
B_PROLOG_INCLUDED === true || die();

/**
 * @var string $mid module id from GET
 */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tester;

CJSCore::Init([
	'jquery',
	'date'
]);
Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;

$module_id = 'intervolga.edu';
Loader::includeModule($module_id);

$options = [
	'general' => [

	],
];

$fatalThrowable = null;
try {
	Tester::run();
} catch (Throwable $throwable) {
	$fatalThrowable = $throwable;
}

$tabs = [
	[
		'DIV' => 'general',
		'TAB' => Loc::getMessage('INTERVOLGA_EDU.TAB_GENERAL'),
		'TITLE' => Loc::getMessage('INTERVOLGA_EDU.TAB_GENERAL'),
	],
];
if ($USER->IsAdmin()) {
	if (check_bitrix_sessid() && strlen($_POST['save'])>0) {
		foreach ($options as $option) {
			__AdmSettingsSaveOptions($module_id, $option);
		}
		LocalRedirect($APPLICATION->GetCurPageParam());
	}
}
$tabControl = new CAdminTabControl('tabControl', $tabs);
$tabControl->Begin();
$tabControl->BeginNextTab();
if ($fatalThrowable)
{
	echo '<h2>' . Loc::getMessage('INTERVOLGA_EDU.FATAL_ERROR') . '</h2>';
	$message = new CAdminMessage([
		'MESSAGE' => $fatalThrowable->getMessage(),
		'DETAILS' => $fatalThrowable->getTraceAsString(),
	]);
	echo $message->show();
}

$errors = Tester::getErrorsTree();
/**
 * @var \Intervolga\Edu\Tests\BaseTest $testClass
 */
foreach ($errors as $testClass => $testErrors) {
	echo '<h2>' . $testClass::getTitle() . '</h2>';
	if ($testErrors) {
		$message = new CAdminMessage([
			'HTML' => true,
			'MESSAGE' => implode('<br>', $testErrors)
		]);
		echo $message->show();
	} else {
		$message = new CAdminMessage([
			'MESSAGE' => Loc::getMessage('INTERVOLGA_EDU.NO_ERRORS'),
			'TYPE' => 'OK'
		]);
		echo $message->show();
	}
}

$tabControl->End();