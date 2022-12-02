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
			),
			new Regex(
				'/AddHeadScript/mi',
				'$APPLICATION->AddHeadScript',
			),
			new Regex(
				'/[^:]getMessage/mi',
				'GetMessage'
			),
			new Regex(
				'/IncludeTemplateLangFile/mi',
				'IncludeTemplateLangFile'
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
