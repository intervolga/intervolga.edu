<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(Application::getDocumentRoot() . '/bitrix/modules/main/options.php');

class TestOption extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	/**
	 * @throws AssertException
	 */
	protected static function run()
	{
		Assert::checkModuleOption('main', 'optimize_css_files', 'Y', Loc::getMessage('MAIN_OPTIMIZE_CSS'));
		Assert::checkModuleOption('main', 'optimize_js_files', 'Y', Loc::getMessage('MAIN_OPTIMIZE_JS'));
		Assert::checkModuleOption('main', 'compres_css_js_files', 'Y', Loc::getMessage('MAIN_COMPRES_CSS_JS'));

		Assert::checkModuleOption('main', 'use_minified_assets', 'N', Loc::getMessage('MAIN_USE_MINIFIED_ASSETS'));
		Assert::checkModuleOption('main', 'move_js_to_body', 'N', Loc::getMessage('MAIN_MOVE_JS_TO_BODY'));
	}

}