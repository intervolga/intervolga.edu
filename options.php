<?php
B_PROLOG_INCLUDED === true || die();
if (LANGUAGE_ID != 'ru') {
	$message = new CAdminMessage('Switch language to RU');
	echo $message->show();

	return;
}

/**
 * @var string $mid module id from GET
 */

use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Type\DateTime;
use Intervolga\Edu\Tester;
use Intervolga\Edu\Util\Update;

CJSCore::Init([
	'jquery',
	'date'
]);
Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;
$APPLICATION->setAdditionalCSS('/local/modules/intervolga.edu/admin.css');

$module_id = 'intervolga.edu';
Loader::includeModule($module_id);

$options = [
	'general' => [

	],
];

$request = Context::getCurrent()->getRequest();
if ($request->isPost()) {
	if ($optionName = $request->getPost('ADD')) {
		Option::set($module_id, $optionName, date('d.m.Y H:i'));
	} elseif ($optionName = $request->getPost('REMOVE')) {
		Option::delete($module_id, [
			'name' => $optionName
		]);
	} elseif ($zipName = $request->getPost('UNPACK')) {
		Update::unpack($zipName);
	}
	LocalRedirect($request->getRequestUri());
}

$fatalThrowable = null;
try {
	$testsTree = Tester::getTestsTree();
	Tester::run();
} catch (Throwable $throwable) {
	$fatalThrowable = $throwable;
}
$errorsTree = Tester::getErrorsTree();
$okStat = [];

$claimsDatetimes = Option::getForModule($module_id);
$isFemale = CUser::GetByID($USER->GetID())->fetch()['PERSONAL_GENDER'] == 'F';
foreach ($errorsTree as $courseCode => $lessonCodes) {
	$courseOkCount = 0;
	foreach ($lessonCodes as $lessonCode => $testErrors) {
		$lessonOkCount = 0;
		foreach ($testErrors as $testClassName => $testError) {
			$newTestCode = strtolower($testsTree[$courseCode]['LESSONS'][$lessonCode]['TESTS'][$testClassName]['CODE']);
			$reportId = $courseCode . "_" . $lessonCode . "_" . $newTestCode . "_problem";
			if (!$testError || array_key_exists($reportId, $claimsDatetimes)) {
				$courseOkCount++;
				$lessonOkCount++;
			}
			if (!$testError && array_key_exists($reportId, $claimsDatetimes)) {
				Option::delete($module_id, [
					'name' => $reportId
				]);
			}
		}
		$reportCounts = 0;
		$okStat[$courseCode]['LESSONS'][$lessonCode]['ERRORS'] = $lessonOkCount;
	}
	$okStat[$courseCode]['ERRORS'] = $courseOkCount;
}
$tabs = [];
$courseNum = 1;
foreach ($testsTree as $courseCode => $course) {
	$tabs[] = [
		'DIV' => $courseCode,
		'TAB' => Loc::getMessage('INTERVOLGA_EDU.COURSE_TAB_HEADER', [
				'#NUM#' => $courseNum,
				'#DONE#' => $okStat[$courseCode]['ERRORS'],
				'#TOTAL#' => $course['COUNT'],
			]
		),
		'TITLE' => Loc::getMessage('INTERVOLGA_EDU.COURSE_HEADER', [
				'#COURSE#' => $course['TITLE'],
				'#DONE#' => $okStat[$courseCode]['ERRORS'],
				'#TOTAL#' => $course['COUNT'],
			]
		),
	];
	$courseNum++;
}
$tabs[] = [
	'DIV' => 'update',
	'TAB' => Loc::getMessage('INTERVOLGA_EDU.MODULE_TAB_UPDATE'),
	'TITLE' => Loc::getMessage('INTERVOLGA_EDU.MODULE_UPDATE', [
			'#VERSION#' => ModuleManager::getVersion('intervolga.edu')
		]
	),
];
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
				'MESSAGE' => Loc::getMessage(
					'INTERVOLGA_EDU.TEST_HEADER',
					[
						'#NUMBER#' => $counter,
						'#TEST#' => $test['TITLE'],
						'#CODE#' => $test['CODE'],
					]),
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
			$reportId = $courseCode . "_" . $lessonCode . "_" . strtolower($test['CODE']) . "_problem";

			if ($messageParams['TYPE'] !== 'OK') {
				$messCode = 'INTERVOLGA_EDU.REPORT_MALE';
				$code = 'ADD';
				$buttonClass = '';
				if (array_key_exists($reportId, $claimsDatetimes)) {
					$buttonClass = 'adm-btn';
					$messCode = 'INTERVOLGA_EDU.REMOVE_REPORT';
					$code = 'REMOVE';
				} else {
					$buttonClass = 'adm-btn adm-btn-save';
					if ($isFemale) {
						$messCode = 'INTERVOLGA_EDU.REPORT_FEMALE';
					}
				}
				$messageParams["DETAILS"] .= '<form method="post">';
				$messageParams["DETAILS"] .= '<button type="submit" class="' . $buttonClass . '" name="' . $code . '" value="' . $reportId . '">' . Loc::getMessage($messCode, ["#TIME#" => $claimsDatetimes[$reportId]]) . '</button>';
				$messageParams["DETAILS"] .= '</form>';
			}
			$message = new CAdminMessage($messageParams);
			echo $message->show();
			$counter++;
		}
	}
}
$tabControl->beginNextTab();
$links = [
	'master' => 'https://gitlab.intervolga.ru/common/intervolga.edu/-/archive/master/intervolga.edu-master.zip',
	'develop' => 'https://gitlab.intervolga.ru/common/intervolga.edu/-/archive/develop/intervolga.edu-develop.zip',
];
?>
	<h2>1. <?=Loc::getMessage('INTERVOLGA_EDU.DOWNLOAD_ZIP')?></h2>
	<?php foreach ($links as $branch => $href): ?>
		<a href="<?=$href?>" class="adm-btn" target="_blank"><?=$branch?></a>
		<br><br>
	<?php endforeach ?>
	<h2>2. <?=Loc::getMessage('INTERVOLGA_EDU.UPLOAD_ZIP')?></h2>
	<a href="/bitrix/admin/fileman_file_upload.php?lang=ru&site=s1&path=%2Flocal%2Fmodules"
	   class="adm-btn" target="_blank"><?=Loc::getMessage('INTERVOLGA_EDU.GOTO_UNZIP_DIR')?></a>
	<h2>3. <?=Loc::getMessage('INTERVOLGA_EDU.UNPACK')?></h2>
	<?php if (Update::getZipFiles()): ?>
		<?php foreach (Update::getZipFiles() as $file): ?>
			<form action="" method="post">
				<?=bitrix_sessid_post()?>
				<button type="submit" class="adm-btn adm-btn-save" name="UNPACK" value="<?=$file->getName()?>">
					<?=Loc::getMessage('INTERVOLGA_EDU.UNPACK_ZIP', [
						'#ZIP#' => $file->getName(),
						'#DATETIME#' => DateTime::createFromTimestamp($file->getModificationTime())->format('d.m.Y H:i'),
					])?>
				</button>
			</form>
			<br><br>
		<?php endforeach ?>
	<?php else: ?>
		<?=Loc::getMessage('INTERVOLGA_EDU.NO_ZIP_FILES')?>
	<?php endif ?>
<?php
$tabControl->end();