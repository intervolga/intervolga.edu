<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestCoreD7 extends BaseTest
{
	public static function run()
	{
		$regexes = [
			new Regex(
				'/SetAdditionalCSS/mi',
				'$APPLICATION->SetAdditionalCSS',
				Loc::getMessage('INTERVOLGA_EDU.OLD_CODE_REPLACE', ['#NEW#' => '\Bitrix\Main\Page\Asset::addCss'])
			),
			new Regex(
				'/AddHeadScript/mi',
				'$APPLICATION->AddHeadScript',
				Loc::getMessage('INTERVOLGA_EDU.OLD_CODE_REPLACE', ['#NEW#' => '\Bitrix\Main\Page\Asset::addJs'])
			),
			new Regex(
				'/[^:]getMessage/mi',
				'GetMessage',
				Loc::getMessage('INTERVOLGA_EDU.OLD_CODE_REPLACE', ['#NEW#' => '\Bitrix\Main\Localization\Loc::getMessage'])
			),
			new Regex(
				'/IncludeTemplateLangFile/mi',
				'IncludeTemplateLangFile',
				Loc::getMessage('INTERVOLGA_EDU.OLD_CODE_REPLACE', ['#NEW#' => '\Bitrix\Main\Localization\Loc::loadMessages'])
			),
		];

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		static::registerErrorIfFileContentFoundByRegex($files, $regexes);
	}
}