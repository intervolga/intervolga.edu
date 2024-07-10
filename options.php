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

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Type\DateTime;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Tester;
use Intervolga\Edu\Util\Help;

CJSCore::Init([
	'jquery',
	'date',
	'popup',
]);
Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;

$module_id = 'intervolga.edu';
Loader::includeModule($module_id);

$APPLICATION->setAdditionalCSS('/bitrix/js/' . $module_id . '/admin.css');
Asset::getInstance()->addJs('/bitrix/js/' . $module_id . '/admin.js');

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
	}
	if ($fileId = $request->getPost('deleteFile')) {
		$file = CFile::GetByID($fileId);
		if($file){
			try{
				CFile::Delete($fileId);
			}catch (Exception $exception){
				//TODO:сделать логирование от модуля?
				//\Bitrix\Main\Diag\Debug::writeToFile($exception);
			}
		}
	}
	if ($commentName = $request->getPost('COMMENT')) {
		if ($comment = $request->getPost($commentName . 'Comment')) {
			Option::delete($module_id, [
				'name' => $commentName . "Comment"
			]);
			Option::set($module_id, $commentName . "Comment", $comment);
		}
		if ($_FILES) {
			foreach ($_FILES as $key => $item) {
				if (strripos($key, $commentName . 'Photo') === 0 && $item['tmp_name']) {
					$path = mb_strcut($key, 0, strpos($key, 'Photo'));
					$temp = array_merge($item, [
						'MODULE_ID' => $module_id,
						'description' => $path,
					]);
					try {
						CFile::SaveFile($temp, $module_id, false, false, $path);
						Option::set($module_id, $key, $temp['PHOTO']);
					} catch (Exception $e) {
						//TODO:сделать логирование от модуля?
						//\Bitrix\Main\Diag\Debug::writeToFile($e);
					}
				}
			}
		}

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
$stat = [];

$claimsDatetimes = Option::getForModule($module_id);
$isFemale = CUser::GetByID($USER->GetID())->fetch()['PERSONAL_GENDER'] == 'F';
foreach ($errorsTree as $courseCode => $lessonCodes) {
	$stat[$courseCode]['FAILED'] = 0;
	$stat[$courseCode]['DONE'] = 0;
	foreach ($lessonCodes as $lessonCode => $lessonTests) {
		$stat[$courseCode]['LESSONS'][$lessonCode]['ERRORS'] = 0;
		foreach ($lessonTests as $testClassName => $testError) {
			$newTestCode = strtolower($testsTree[$courseCode]['LESSONS'][$lessonCode]['TESTS'][$testClassName]['CODE']);
			$reportId = $courseCode . "_" . $lessonCode . "_" . $newTestCode . "_problem";
			if ($testError && !array_key_exists($reportId, $claimsDatetimes)) {
				$stat[$courseCode]['LESSONS'][$lessonCode]['ERRORS']++;
			}
			if (!$testError && array_key_exists($reportId, $claimsDatetimes)) {
				Option::delete($module_id, [
					'name' => $reportId
				]);
			}
		}
		if ($stat[$courseCode]['LESSONS'][$lessonCode]['ERRORS']) {
			$stat[$courseCode]['FAILED']++;
		} else {
			$stat[$courseCode]['DONE']++;
		}
	}
}
$tabs = [];

foreach ($testsTree as $courseCode => $course) {
	$tabs[] = [
		'DIV' => $courseCode,
		'TAB' => Loc::getMessage('INTERVOLGA_EDU.COURSE_TAB_HEADER', [
				'#NUM#' => str_replace('course', '', $courseCode),
				'#DONE#' => $stat[$courseCode]['DONE'],
				'#TOTAL#' => count($course['LESSONS']),
			]
		),
		'TITLE' => Loc::getMessage('INTERVOLGA_EDU.COURSE_HEADER', [
				'#COURSE#' => $course['TITLE'],
				'#DONE#' => $stat[$courseCode]['DONE'],
				'#TOTAL#' => count($course['LESSONS']),
			]
		),
		'ONSELECT' => 'intervolgaEduOnTabChanged("' . $courseCode . '");',
	];
}
$tabs[] = [
	'DIV' => 'info',
	'TAB' => Loc::getMessage('INTERVOLGA_EDU.MODULE_TAB_INFO'),
	'TITLE' => Loc::getMessage('INTERVOLGA_EDU.MODULE_INFO'),
	'ONSELECT' => 'intervolgaEduOnTabChanged("info");',
];
if ($fatalThrowable) {
	$message = new CAdminMessage([
		'MESSAGE' => Loc::getMessage('INTERVOLGA_EDU.FATAL_ERROR', ['#ERROR#' => $fatalThrowable->getMessage()]),
		'DETAILS' => $fatalThrowable->getFile() . ':' . $fatalThrowable->getLine() . '<br>' . $fatalThrowable->getTraceAsString(),
	]);
	echo $message->show();
}

$results = CFile::GetList([], ['MODULE_ID' => $module_id]);
$photos = [];
while ($result = $results->Fetch()) {
	$photos[$result['DESCRIPTION']][] = $result;
}

$tabControl = new CAdminTabControl('tabControl', $tabs);
$tabControl->begin();
$locatorsFound = Tester::getLocatorsFound();

foreach ($testsTree as $courseCode => $course) {
	$tabControl->beginNextTab();
	?>
	<tr>
		<td>
			<h2 id="<?=$courseCode?>contents"><?=Loc::getMessage('INTERVOLGA_EDU.COURSE_CONTENTS')?></h2>
			<ul class="lessons-contents">
				<?php foreach ($course['LESSONS'] as $lessonCode => $lesson): ?>
					<?php
					$title = Loc::getMessage('INTERVOLGA_EDU.LESSON_HEADER', [
						'#LESSON#' => $lesson['TITLE'],
						'#TOTAL#' => count($lesson['TESTS']),
						'#DONE#' => count($lesson['TESTS']) - intval($stat[$courseCode]['LESSONS'][$lessonCode]['ERRORS']),
					]);
					?>
					<li>
						<a href="#<?=$courseCode?><?=$lessonCode?>">
							<?php if (!$stat[$courseCode]['LESSONS'][$lessonCode]['ERRORS']): ?>
								<?=Loc::getMessage('INTERVOLGA_EDU.LESSON_OK')?>
							<?php else: ?>
								<?=Loc::getMessage('INTERVOLGA_EDU.LESSON_FAIL')?>
							<?php endif ?>
							<?=$lesson['TITLE']?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
			<?php
			$prevLessonCode = '';
			$nextLessonCode = '';
			$lessonCodes = array_keys($course['LESSONS']);
			$currentLessonIndex = 0;
			foreach ($course['LESSONS'] as $lessonCode => $lesson) {
				if ($currentLessonIndex<count($lessonCodes) + 1) {
					$nextLessonCode = $lessonCodes[$currentLessonIndex + 1];
				}
				$title = Loc::getMessage('INTERVOLGA_EDU.LESSON_HEADER', [
					'#LESSON#' => $lesson['TITLE'],
					'#TOTAL#' => count($lesson['TESTS']),
					'#DONE#' => count($lesson['TESTS']) - intval($stat[$courseCode]['LESSONS'][$lessonCode]['ERRORS']),
				]);
				$help = Help::get($courseCode, $lessonCode);
				?>
				<h2 id="<?=$courseCode . $lessonCode?>">
					<?php if (!$stat[$courseCode]['LESSONS'][$lessonCode]['ERRORS']): ?>
						<?=Loc::getMessage('INTERVOLGA_EDU.LESSON_OK')?>
					<?php else: ?>
						<?=Loc::getMessage('INTERVOLGA_EDU.LESSON_FAIL')?>
					<?php endif ?>
					<?=$title?>
					<span class="contents-link">
						<?php if ($prevLessonCode): ?>
							<a href="#<?=$courseCode?><?=$prevLessonCode?>">
								<?=Loc::getMessage('INTERVOLGA_EDU.GO_BACK')?>
							</a>
						<?php else: ?>
							<?=Loc::getMessage('INTERVOLGA_EDU.GO_BACK')?>
						<?php endif ?>
						&nbsp;
						<a href="#<?=$courseCode?>contents">
							<?=Loc::getMessage('INTERVOLGA_EDU.GO_UP')?>
						</a>
						&nbsp;
						<?php if ($nextLessonCode): ?>
							<a href="#<?=$courseCode?><?=$nextLessonCode?>">
								<?=Loc::getMessage('INTERVOLGA_EDU.GO_FORWARD')?>
							</a>
						<?php else: ?>
							<?=Loc::getMessage('INTERVOLGA_EDU.GO_FORWARD')?>
						<?php endif ?>
					</span>
				</h2>
				<?php if (strlen($help)): ?>
					<div class="help">
						<h3><?=Loc::getMessage('INTERVOLGA_EDU.LESSON_HELP')?></h3>
						<div>
							<?=$help?>
						</div>
					</div>
				<?php endif ?>
				<?php
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

					if ($test['INPUTS']) {
						$messageParams["DETAILS"] .= '<br>';
						$messageParams["DETAILS"] .= '<form method="post" enctype="multipart/form-data">';
						$messageParams["DETAILS"] .= '<br>';
						$formID = $courseCode . $lessonCode . $test['CODE'];

						foreach ($test['INPUTS'] as $input) {
							if ($input['TYPE'] === 'image') {
								$photos = $photos[$formID];
								foreach ($photos as $photo) {
									$pathPhoto = '/upload/' . $photo['SUBDIR'] . '/' . $photo['FILE_NAME'];
									$messageParams["DETAILS"] .= '<div style="display:none;" id="' . $photo['FILE_NAME'] . '_photo"> <img src="' . $pathPhoto . '"><br>';
									$messageParams["DETAILS"] .= ' <a href="' . $pathPhoto . '">' . Loc::getMessage('INTERVOLGA_EDU.FOLLOW_PHOTO') . '</a></div>';
									$messageParams["DETAILS"] .= '<div><a class="show-img" id="' . $photo['FILE_NAME'] . '" onclick="showPopup(this)">' . $photo['FILE_NAME'] . '</a>';
									$messageParams["DETAILS"] .= '<button style="margin-left: 3px" type="submit" name="deleteFile" title="Удалить файл" class="iv-delete-link" value="'.$photo['ID'].'"></button></div>';
								}
							} elseif ($input['TYPE'] === 'text-area') {
								$messageParams["DETAILS"] .= '<b>' . $input['DESCRIBE'] . '</b> <br>';
								$tip = Option::get($module_id, $formID . "Comment");
								$messageParams["DETAILS"] .= '<textarea name="' . $formID . 'Comment" rows="5" cols="80">' . $tip . '</textarea>';
							}
							if($photos){
								$messageParams["DETAILS"] .= '<br>';
							}
							$messageParams["DETAILS"] .= CFile::InputFile($formID. 'Photo', 20, 0, '/upload/intervolga.edu/');
						}
						$messageParams["DETAILS"] .= '<button type="submit" style="margin-left: 10px" class="adm-btn" name="COMMENT" value="' . $formID . '">' . Loc::getMessage('INTERVOLGA_EDU.SEND_PHOTO') . '</button>';
						$messageParams["DETAILS"] .= '</form>';
						$messageParams["DETAILS"] .= '<br>';
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

					if ($locatorsFound[$testCode]) {
						$locatorsInfo = [];
						foreach ($locatorsFound[$testCode] as $parentLocator => $locatorClasses) {
							foreach ($locatorClasses as $locatorClass => $founds) {
								foreach ($founds as $found) {
									/**
									 * @var BaseLocator $parentLocator
									 * @var BaseLocator $locatorClass
									 */
									$locatorsInfo [] = $locatorClass::getReport($parentLocator, $found);
								}
							}
						}
						$messageParams["DETAILS"] .= '<div class="locators-info">' . implode('<br>', $locatorsInfo) . '</div>';
					}

					$message = new CAdminMessage($messageParams);
					echo $message->show();
					$counter++;
				}
				$prevLessonCode = $lessonCode;
				$currentLessonIndex++;
			}
			?>
			<div class="contents-link">
				<a href="#<?=$courseCode?>contents"><?=Loc::getMessage('INTERVOLGA_EDU.GO_UP')?></a>
			</div>
		</td>
	</tr>
	<?php
}
$tabControl->beginNextTab();
$arModuleVersion = [];
include Application::getDocumentRoot() . IV_EDU_MODULE_DIR . '/install/version.php';
$versionDate = $arModuleVersion['VERSION_DATE'];
if ($versionDate) {
	$dateTime = DateTime::tryParse($versionDate, 'Y-m-d H:i:s');
	if ($dateTime) {
		$versionDate = $dateTime->format('d.m.Y H:i');
	}
}
?>
	<tr>
		<td>
			<div><?=Loc::getMessage('INTERVOLGA_EDU.MODULE_VERSION', [
					'#VERSION#' => $arModuleVersion['VERSION'],
				])?></div>
			<div><?=Loc::getMessage('INTERVOLGA_EDU.MODULE_VERSION_DATE', [
					'#VERSION_DATE#' => $versionDate,
				])?></div>
			<div><?=Loc::getMessage('INTERVOLGA_EDU.MODULE_TESTS_COUNT', [
					'#COUNT#' => Tester::getTestClassesCount(),
				])?></div>
		</td>
	</tr>
<?php
$tabControl->end();