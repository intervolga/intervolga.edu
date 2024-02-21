<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestMainModuleSettings extends BaseTest
{
	const MAIN_MODULE_SETTINGS = [
		'site_name',
		'server_name',
		'bx_fast_download',
		'optimize_css_files',
		'optimize_js_files',
		'use_minified_assets',
		'move_js_to_body',
		'compres_css_js_files'
	];

	protected static function run()
	{
		$moduleSettings = Option::getForModule('main');

		foreach (static::MAIN_MODULE_SETTINGS as $setting) {
			Assert::eq($moduleSettings[$setting], 'Y',
				Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.MAIN_MODULE_SETTINGS",
					[
						'#SETTING#' => Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.$setting")
					]
				)
			);
		}

	}
}