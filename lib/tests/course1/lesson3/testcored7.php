<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Fileset;
use Intervolga\Edu\Util\Regex;

class TestCoreD7 extends BaseTest
{
	public static function run()
	{
		$regexes = [
			new Regex('/SetAdditionalCSS/mi', '$APPLICATION->SetAdditionalCSS()', '\Bitrix\Main\Page\Asset::addCss()'),
			new Regex('/AddHeadScript/mi', '$APPLICATION->AddHeadScript()', '\Bitrix\Main\Page\Asset::addJs()'),
			new Regex('/[^:]getMessage/mi', 'GetMessage()', '\Bitrix\Main\Localization\Loc::getMessage()'),
			new Regex('/IncludeTemplateLangFile/mi', 'IncludeTemplateLangFile()', '\Bitrix\Main\Localization\Loc::loadMessages()'),
		];

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		static::testFilesetContentByRegex($files, $regexes, Loc::getMessage('INTERVOLGA_EDU.OLD_CODE_USAGE'));
	}
}