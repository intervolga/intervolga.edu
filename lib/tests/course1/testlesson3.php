<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

Loc::loadMessages(__FILE__);

class TestLesson3 extends BaseTest
{
	const MAX_LINES_IN_REPORT = 5;

	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COURSE_1_LESSON_3');
	}

	public static function run()
	{
		static::testTemplates();
		static::testCustomCoreCheck();
		static::testLongPhpTag();
		static::testScripts();
		// TODO переводы
		static::testCoreD7();
	}

	protected static function testTemplates()
	{
		$templatesAllowed = [
			'main',
			'inner',
			'.default',
		];

		$templatesDirectory = new Directory(Application::getDocumentRoot() . '/local/templates/');
		foreach ($templatesDirectory->getChildren() as $child) {
			if ($child->isDirectory()) {
				if (!in_array($child->getName(), $templatesAllowed)) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.UNKNOWN_TEMPLATE_FOUND', [
						'#NAME#' => $child->getName(),
						'#ADMIN_LINK#' => Admin::getFileManUrl($child),
					]));
				}
			}
		}
	}

	protected static function testCustomCoreCheck()
	{
		$files = static::getLessonFilesToCheck();
		$example = 'B_PROLOG_INCLUDED === true || die()';
		$re = '/B_PROLOG_INCLUDED ?=== ?true ?\|\| ?die(\(\))?/mi';

		foreach ($files as $file) {
			if ($file->isExists() && $file->isFile()) {
				$content = $file->getContents();
				preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);
				if (!$matches) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.CUSTOM_CORE_CHECK_NOT_FOUND', [
						'#PATH#' => $file->getName(),
						'#ADMIN_LINK#' => Admin::getFileManUrl($file),
						'#EXAMPLE#' => $example,
					]));
				}
			}
		}
	}

	/**
	 * @return \Bitrix\Main\IO\FileSystemEntry[]
	 */
	protected static function getLessonFilesToCheck()
	{
		$templatesToCheck = [
			'/local/templates/',
			[
				'main/',
				'inner/'
			],
			[
				'header.php',
				'footer.php'
			]
		];

		return FileSystem::getComboEntries($templatesToCheck);
	}

	protected static function testLongPhpTag()
	{
		$files = static::getLessonFilesToCheck();
		$re = '/<\?[^=p].*/m'; // Not <?=, mot <?p...
		$errors = [];
		foreach ($files as $file) {
			if ($file->isExists() && $file->isFile()) {
				$content = $file->getContents();
				preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);
				if ($matches) {
					foreach ($matches as $match) {
						$errors[] = Loc::getMessage('INTERVOLGA_EDU.SHORT_PHP_TAG_FOUND', [
							'#LINE#' => htmlspecialchars($match[0]),
							'#PATH#' => $file->getName(),
							'#ADMIN_LINK#' => Admin::getFileManUrl($file),
						]);
					}
				}
			}
		}

		if (count($errors)>static::MAX_LINES_IN_REPORT) {
			$countWas = count($errors);
			$errors = array_slice($errors, 0, static::MAX_LINES_IN_REPORT);
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.NUM_SHOWN', [
				'#NUM#' => static::MAX_LINES_IN_REPORT,
				'#TOTAL#' => $countWas,
				]));
		}
		foreach ($errors as $error) {
			static::registerError($error);
		}
	}

	protected static function testScripts()
	{
		$innerHeaderPath = '/local/templates/inner/header.php';
		$mainHeaderPath = '/local/templates/main/header.php';

		$jsLibsToCheckInMain = [
			'slides.min.jquery.js',
			'jquery.carouFredSel-6.1.0-packed.js',
		];

		$mainHeaderFile = new File(Application::getDocumentRoot() . $mainHeaderPath);
		$innerHeaderFile = new File(Application::getDocumentRoot() . $innerHeaderPath);
		foreach ($jsLibsToCheckInMain as $jsLibToCheck) {
			if ($mainHeaderFile->isExists() && $mainHeaderFile->isFile()) {
				if (!substr_count($mainHeaderFile->getContents(), $jsLibToCheck)) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.ADD_THIS_JS', [
						'#JS#' => $jsLibToCheck,
						'#PATH#' => FileSystem::getLocalPath($mainHeaderFile),
						'#ADMIN_LINK#' => Admin::getFileManUrl($mainHeaderFile),
					]));
				}
			}
			if ($innerHeaderFile->isExists() && $innerHeaderFile->isFile()) {
				if (substr_count($innerHeaderFile->getContents(), $jsLibToCheck)) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.DELETE_THIS_JS', [
						'#JS#' => $jsLibToCheck,
						'#PATH#' => FileSystem::getLocalPath($innerHeaderFile),
						'#ADMIN_LINK#' => Admin::getFileManUrl($innerHeaderFile),
					]));
				}
			}
		}
	}

	protected static function testCoreD7()
	{
		$oldFunctions = [
			'/SetAdditionalCSS/mi' => [
				'OLD' => '$APPLICATION->SetAdditionalCSS()',
				'NEW' => '\Bitrix\Main\Page\Asset::addCss()',
			],
			'/AddHeadScript/mi' => [
				'OLD' => '$APPLICATION->AddHeadScript()',
				'NEW' => '\Bitrix\Main\Page\Asset::addJs()',
			],
			'/[^:]getMessage/mi' => [
				'OLD' => 'GetMessage()',
				'NEW' => '\Bitrix\Main\Localization\Loc::getMessage()',
			],
			'/IncludeTemplateLangFile/mi' => [
				'OLD' => 'IncludeTemplateLangFile()',
				'NEW' => '\Bitrix\Main\Localization\Loc::loadMessages()',
			],
		];

		$files = static::getLessonFilesToCheck();

		foreach ($files as $file) {
			if ($file->isExists() && $file->isFile()) {
				$content = $file->getContents();
				foreach ($oldFunctions as $oldFunctionRe => $comments) {
					preg_match_all($oldFunctionRe, $content, $matches, PREG_SET_ORDER, 0);
					if ($matches) {
						static::registerError(Loc::getMessage('INTERVOLGA_EDU.OLD_FUNCTION_FOUND', [
							'#PATH#' => FileSystem::getLocalPath($file),
							'#ADMIN_LINK#' => Admin::getFileManUrl($file),
							'#OLD#' => $comments['OLD'],
							'#NEW#' => $comments['NEW'],
						]));
					}
				}
			}
		}
	}
}