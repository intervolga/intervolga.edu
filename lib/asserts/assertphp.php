<?php
namespace Intervolga\Edu\Asserts;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Util\Regex;

class AssertPhp extends Assert
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
			new Regex(
				'/CModule::IncludeModule/mi',
				'CModule::IncludeModule'
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

	public static function goodCode(File $phpFile)
	{
		static::noOldCore($phpFile);
		static::customCoreCheck($phpFile);
		static::longPhpTags($phpFile);
		static::styleCode($phpFile);
	}

	public static function noOldCore(File $phpFile)
	{
		foreach (static::getOldCore() as $regex) {
			Assert::fileContentNotMatches($phpFile, $regex);
		}
	}

	public static function customCoreCheck(File $phpFile)
	{
		foreach (static::getCustomCore() as $regex) {
			Assert::fileContentMatches($phpFile, $regex);
		}
	}

	public static function longPhpTags(File $phpFile)
	{
		foreach (static::getShortPhpTag() as $regex) {
			Assert::fileContentNotMatches($phpFile, $regex);
		}
	}

	public static function styleCode(File $phpFile)
	{
		foreach (static::getUglyCodeFragments() as $regex) {
			Assert::fileContentNotMatches($phpFile, $regex);
		}
		foreach (static::getPrefixNotaionFragments() as $regex) {
			Assert::fileContentNotMatches($phpFile, $regex);
		}
	}
}