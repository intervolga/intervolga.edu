<?php
namespace Intervolga\Edu\Util\Registry;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Regex;

class RegexRegistry
{
	/**
	 * @return Regex[]
	 */
	public static function getNewCore()
	{
		return [
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
	}

	public static function getCustomCore()
	{
		return [
			new Regex(
				'/B_PROLOG_INCLUDED ?=== ?true ?\|\| ?die(\(\))?/mi',
				'B_PROLOG_INCLUDED === true || die()',
				Loc::getMessage('INTERVOLGA_EDU.CUSTOM_CORE_CHECK')
			)
		];
	}

	public static function getLongPhpTag()
	{
		return [
			new Regex(
				'/<\?[^=p].*/m',
				'<?',
				Loc::getMessage('INTERVOLGA_EDU.SHORT_PHP_TAG_RESTRICTED')
			),
		];
	}
}
