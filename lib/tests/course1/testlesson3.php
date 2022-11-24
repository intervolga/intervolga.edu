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
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COURSE_1_LESSON_3');
	}

	public static function run()
	{
		static::testTemplates();
		static::testCustomCoreCheck();
		// B_PROLOG_INCLUDED === true || die();
		// Asset::getInstance()->add
		// <?php
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
		$example = 'B_PROLOG_INCLUDED === true || die()';
		$re = '/B_PROLOG_INCLUDED ?=== ?true ?\|\| ?die(\(\))?/mi';

		$files = FileSystem::getComboEntries($templatesToCheck);
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
}