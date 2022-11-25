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
$testsTree = Tester::getTestsTree();
try {
	Tester::run();
} catch (Throwable $throwable) {
	$fatalThrowable = $throwable;
}
$errorsTree = Tester::getErrorsTree();
$tabs = [];
foreach ($testsTree as $courseCode => $course) {
	$tabs[] = [
		'DIV' => $courseCode,
		'TAB' => Loc::getMessage('INTERVOLGA_EDU.COURSE_HEADER', ['#LESSON#' => $course['TITLE']]),
		'TITLE' => Loc::getMessage('INTERVOLGA_EDU.TEST_RESULTS'),
	];
}
if ($fatalThrowable) {
	$message = new CAdminMessage([
		'MESSAGE' => Loc::getMessage('INTERVOLGA_EDU.FATAL_ERROR', ['#ERROR#' => $fatalThrowable->getMessage()]),
		'DETAILS' => $fatalThrowable->getTraceAsString(),
	]);
	echo $message->show();
}
$tabControl = new CAdminTabControl('tabControl', $tabs);
$tabControl->begin();
foreach ($testsTree as $courseCode => $course) {
	$tabControl->beginNextTab();
	foreach ($course['LESSONS'] as $lessonCode => $lesson) {
		echo '<h2>' . Loc::getMessage('INTERVOLGA_EDU.LESSON_HEADER', ['#LESSON#' => $lesson['TITLE']]) . '</h2>';
		$counter = 1;
		foreach ($lesson['TESTS'] as $testCode => $testTitle) {
			$errors = $errorsTree[$courseCode][$lessonCode][$testCode];
			$messageParams = [
				'HTML' => true,
				'MESSAGE' => Loc::getMessage('INTERVOLGA_EDU.TEST_HEADER', ['#TEST#' => $counter . '. ' . $testTitle]),
			];
			if ($errors) {
				$messageParams['DETAILS'] = implode('<br>', $errors);
			} else {
				$messageParams['DETAILS'] = Loc::getMessage('INTERVOLGA_EDU.TEST_NO_ERRORS');
				$messageParams['TYPE'] = 'OK';
			}
			$message = new CAdminMessage($messageParams);
			echo $message->show();
			$counter++;
		}
	}
}
$tabControl->end();