<?php
namespace Intervolga\Edu\Util\Registry;

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
				'B_PROLOG_INCLUDED === true || die()'
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
				'<?'
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
				'if (!empty($arResult))'
			),
			new Regex(
				'/if \(empty\(\$arResult\)\)/mi',
				'if (empty($arResult))'
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
				'$arItem'
			),
		];
	}
}
