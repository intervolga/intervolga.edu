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
$okStat = [];
foreach ($errorsTree as $courseCode => $lessonCodes) {
	$courseOkCount = 0;
	foreach ($lessonCodes as $lessonCode => $testErrors) {
		$lessonOkCount = 0;
		foreach ($testErrors as $testError) {
			if (!$testError) {
				$courseOkCount++;
				$lessonOkCount++;
			}
		}
		$okStat[$courseCode]['LESSONS'][$lessonCode]['ERRORS'] = $lessonOkCount;
	}
	$okStat[$courseCode]['ERRORS'] = $courseOkCount;
}
$tabs = [];
foreach ($testsTree as $courseCode => $course) {
	$tabs[] = [
		'DIV' => $courseCode,
		'TAB' => Loc::getMessage('INTERVOLGA_EDU.COURSE_HEADER', [
				'#COURSE#' => $course['TITLE'],
				'#DONE#' => $okStat[$courseCode]['ERRORS'],
				'#TOTAL#' => $course['COUNT'],
			]
		),
		'TITLE' => Loc::getMessage('INTERVOLGA_EDU.TEST_RESULTS'),
	];
}
if ($fatalThrowable) {
	$message = new CAdminMessage([
		'MESSAGE' => Loc::getMessage('INTERVOLGA_EDU.FATAL_ERROR', ['#ERROR#' => $fatalThrowable->getMessage()]),
		'DETAILS' => $fatalThrowable->getFile() . ':' . $fatalThrowable->getLine() . '<br>' . $fatalThrowable->getTraceAsString(),
	]);
	echo $message->show();
}
$tabControl = new CAdminTabControl('tabControl', $tabs);
$tabControl->begin();
foreach ($testsTree as $courseCode => $course) {
	$tabControl->beginNextTab();
	foreach ($course['LESSONS'] as $lessonCode => $lesson) {
		$title = Loc::getMessage('INTERVOLGA_EDU.LESSON_HEADER', [
			'#LESSON#' => $lesson['TITLE'],
			'#TOTAL#' => count($lesson['TESTS']),
			'#DONE#' => intval($okStat[$courseCode]['LESSONS'][$lessonCode]['ERRORS']),
		]);
		echo '<h2>' . $title . '</h2>';
		$counter = 1;
		foreach ($lesson['TESTS'] as $testCode => $test) {
			$errors = $errorsTree[$courseCode][$lessonCode][$testCode];
			$messageParams = [
				'HTML' => true,
				'MESSAGE' => Loc::getMessage('INTERVOLGA_EDU.TEST_HEADER', ['#TEST#' => $counter . '. ' . $test['TITLE']]),
			];
			if ($test['DESCRIPTION']) {
				$messageParams['DETAILS'] = '<div class="desc">' . $test['DESCRIPTION'] . '</div>';
			}
			if ($errors) {
				$messageParams['DETAILS'] .= implode('<br>', $errors);
			} else {
				$messageParams['DETAILS'] .= Loc::getMessage('INTERVOLGA_EDU.TEST_NO_ERRORS');
				$messageParams['TYPE'] = 'OK';
			}
			$message = new CAdminMessage($messageParams);
			echo $message->show();
			$counter++;
		}
	}
}
$tabControl->end();
?>
<style type="text/css">
	#tabControl_layout .adm-info-message {
		margin: 2px 0;
		padding: 3px 5px 3px 74px;
	}

	#tabControl_layout .adm-info-message .desc {
		padding-top: 3px;
		padding-bottom: 3px;
		font-size: smaller;
		font-style: italic;
	}
</style>
