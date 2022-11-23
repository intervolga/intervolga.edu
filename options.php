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
$errors = Tester::getErrorsTree();
/**
 * @var \Intervolga\Edu\Tests\BaseTest $testClass
 */
foreach ($errors as $testClass => $testErrors) {
	$options['general'][] = $testClass::getCode();
	if ($testErrors) {
		foreach ($testErrors as $testError) {
			$options['general'][] = [
				'',
				'',
				$testError,
				['statichtml']
			];
		}
	} else {
		$options['general'][] = ['note' => 'OK'];
	}
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
?>
<form method='POST'
	  action='<?=$APPLICATION->getCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&lang=<?=LANGUAGE_ID?>'>
	<?php $tabControl->BeginNextTab(); ?>
	<?php __AdmSettingsDrawList($module_id, $options['general']); ?>
	<?php $tabControl->Buttons([
		'disabled' => true,
	]); ?>
	<?=bitrix_sessid_post();?>
	<?php $tabControl->End(); ?>
</form>