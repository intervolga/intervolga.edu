<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Fileset;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

Loc::loadMessages(__FILE__);

class TestLesson3 extends BaseTest
{
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
		$fileset = new Fileset($files);
		$regex = new Regex('/B_PROLOG_INCLUDED ?=== ?true ?\|\| ?die(\(\))?/mi', 'B_PROLOG_INCLUDED === true || die()');
		static::testFilesetContentNotFoundByRegex($fileset, [$regex], Loc::getMessage('INTERVOLGA_EDU.CUSTOM_CORE_CHECK'));
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
		$regexes = [
			new Regex('/<\?[^=p].*/m', '<?', '<?php'),
		];

		$files = static::getLessonFilesToCheck();
		$fileset = new Fileset($files);
		static::testFilesetContentByRegex($fileset, $regexes, Loc::getMessage('INTERVOLGA_EDU.SHORT_PHP_TAG_RESTRICTED'));
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
		$regexes = [
			new Regex('/SetAdditionalCSS/mi', '$APPLICATION->SetAdditionalCSS()', '\Bitrix\Main\Page\Asset::addCss()'),
			new Regex('/AddHeadScript/mi', '$APPLICATION->AddHeadScript()', '\Bitrix\Main\Page\Asset::addJs()'),
			new Regex('/[^:]getMessage/mi', 'GetMessage()', '\Bitrix\Main\Localization\Loc::getMessage()'),
			new Regex('/IncludeTemplateLangFile/mi', 'IncludeTemplateLangFile()', '\Bitrix\Main\Localization\Loc::loadMessages()'),
		];

		$files = static::getLessonFilesToCheck();
		$fileset = new Fileset($files);
		static::testFilesetContentByRegex($fileset, $regexes, Loc::getMessage('INTERVOLGA_EDU.OLD_CODE_USAGE'));
	}
}