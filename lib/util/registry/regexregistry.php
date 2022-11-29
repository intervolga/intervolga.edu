<?php
namespace Intervolga\Edu\Util\Registry;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Regex;

class RegexRegistry
{
	/**
	 * @return Regex[]
	 */
	public static function getOldCore()
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

	/**
	 * @return Regex[]
	 */
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

	/**
	 * @return Regex[]
	 */
	public static function getShortPhpTag()
	{
		return [
			new Regex(
				'/<\?[^=p].*/m',
				'<?',
				Loc::getMessage('INTERVOLGA_EDU.SHORT_PHP_TAG_RESTRICTED')
			),
		];
	}

	/**
	 * @return Regex[]
	 */
	public static function getUglyCodeFragments()
	{
		return [
			new Regex(
				'/if \(!empty\(\$arResult\)\)/mi',
				'if (!empty($arResult))',
				Loc::getMessage('INTERVOLGA_EDU.UGLY_RESULT_CHECK_FOUND', ['#NEW#' => 'if ($arResult)'])
			),
			new Regex(
				'/if \(empty\(\$arResult\)\)/mi',
				'if (empty($arResult))',
				Loc::getMessage('INTERVOLGA_EDU.UGLY_RESULT_CHECK_FOUND', ['#NEW#' => 'if (!$arResult)'])
			),
		];
	}

	/**
	 * @return Regex[]
	 */
	public static function getPrefixNotaionFragments()
	{
		return [
			new Regex(
				'/\$arItem/mi',
				'$arItem',
				Loc::getMessage('INTERVOLGA_EDU.PREFIX_NOTATION_SUCKS', ['#NEW#' => '$item'])
			),
		];
	}
}
