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

Tester::run();

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

$errors = Tester::getErrorsTree();
/**
 * @var \Intervolga\Edu\Tests\BaseTest $testClass
 */
foreach ($errors as $testClass => $testErrors) {
	?>
	<h2><?=$testClass::getTitle()?></h2>
	<?php
	if ($testErrors) {
		$message = new CAdminMessage(['MESSAGE' => implode('<br>', $testErrors)]);
		echo $message->show();
	} else {
		$message = new CAdminMessage([
			'MESSAGE' => 'OK',
			'TYPE' => 'OK'
		]);
		echo $message->show();
	}
}

$tabControl->End();