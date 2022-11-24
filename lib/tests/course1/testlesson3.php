<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
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
		// Asset::getInstance()->add
		static::testLongPhpTag();
		// Плагины jquery для слайдера и для карусели подключить только в шаблоне главной страницы
		// переводы
		// GetMessage заменяй на аналог в новом ядре
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
			$errors = array_slice($errors, 0, static::MAX_LINES_IN_REPORT);
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.NUM_SHOWN', ['#NUM#' => static::MAX_LINES_IN_REPORT]));
		}
		foreach ($errors as $error) {
			static::registerError($error);
		}
	}
}