<?php
namespace Intervolga\Edu\Asserts;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileSystemEntry;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
use Intervolga\Edu\Locator\Iblock\Section\SectionLocator;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\FileLocator;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\Regex;

Loc::loadMessages(__FILE__);

class Assert
{
	protected static $interceptErrors = false;
	protected static $interceptedErrors = [];

	/**
	 * @param mixed $value
	 * @param mixed $expect
	 * @param string $message
	 * @throws AssertException
	 */
	public static function eq($value, $expect, string $message = '')
	{
		if ($value != $expect) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_EQUAL',
				[
					'#VALUE#' => static::valueToString($value),
					'#EXPECT#' => static::valueToString($expect),
				],
				$message
			));
		}
	}

	/**
	 * @param string $error
	 * @throws AssertException
	 */
	protected static function registerError(string $error)
	{
		if (static::$interceptErrors) {
			static::$interceptedErrors[] = new AssertException($error);
		} else {
			throw new AssertException($error);
		}
	}

	protected static function getCustomOrLocMessage(string $locCode, array $replace, $customMessage = ''): string
	{
		if ($customMessage) {
			$result = strtr($customMessage, $replace);
		} else {
			$result = Loc::getMessage($locCode, $replace);
		}

		return $result;
	}

	protected static function valueToString($value): string
	{
		return var_export($value, true);
	}

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function notEmpty($value, string $message = '')
	{
		if (empty($value)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_NOT_EMPTY',
				[
					'#VALUE#' => static::valueToString($value),
				],
				$message
			));
		}
	}

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function empty($value, string $message = '')
	{
		if (!empty($value)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_EMPTY',
				[
					'#VALUE#' => static::valueToString($value),
				],
				$message
			));
		}
	}

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function true($value, string $message = '')
	{
		if ($value !== true) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_TRUE',
				[
					'#VALUE#' => static::valueToString($value),
				],
				$message
			));
		}
	}

	public static function greater($value, $limit, string $message = '')
	{
		if ($value<=$limit) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_GREATER',
				[
					'#VALUE#' => static::valueToString($value),
					'#EXPECT#' => static::valueToString($limit),
				],
				$message
			));
		}
	}

	public static function greaterEq($value, $limit, string $message = '')
	{
		if ($value<$limit) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_GREATER_EQ',
				[
					'#VALUE#' => static::valueToString($value),
					'#EXPECT#' => static::valueToString($limit),
				],
				$message
			));
		}
	}

	public static function less($value, $limit, string $message = '')
	{
		if ($value>=$limit) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_LESS',
				[
					'#VALUE#' => static::valueToString($value),
					'#EXPECT#' => static::valueToString($limit),
				],
				$message
			));
		}
	}

	public static function lessEq($value, $limit, string $message = '')
	{
		if ($value>$limit) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_LESS_EQ',
				[
					'#VALUE#' => static::valueToString($value),
					'#EXPECT#' => static::valueToString($limit),
				],
				$message
			));
		}
	}

	/**
	 * @param string $value
	 * @param Regex $regex
	 * @param string $message
	 * @throws AssertException
	 */
	public static function matches(string $value, Regex $regex, string $message = '')
	{
		preg_match_all($regex->getRegex(), $value, $matches, PREG_SET_ORDER);
		if (!$matches) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_MATCHES',
				[
					'#EXPECT#' => htmlspecialchars($regex->getRegexExplanation()),
				],
				$message
			));
		}
	}

	/**
	 * @param string $value
	 * @param Regex $regex
	 * @param string $message
	 * @throws AssertException
	 */
	public static function notMatches(string $value, Regex $regex, string $message = '')
	{
		preg_match_all($regex->getRegex(), $value, $matches, PREG_SET_ORDER);
		if ($matches) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_NOT_MATCHES',
				[
					'#EXPECT#' => htmlspecialchars($regex->getRegexExplanation()),
				],
				$message
			));
		}
	}

	/**
	 * @param array $array
	 * @param int $number
	 * @param string $message
	 * @throws AssertException
	 */
	public static function count(array $array, int $number, string $message = '')
	{
		if (count($array) != $number) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_COUNT',
				[
					'#EXPECT#' => $number,
					'#VALUE#' => count($array),
				],
				$message
			));
		}
	}

	public static function keyExists($array, $key, $message = '')
	{
		if (!array_key_exists($key, $array)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_KEY_EXISTS',
				[
					'#VALUE#' => static::valueToString($key),
				],
				$message
			));
		}
	}

	public static function keyNotExists($array, $key, $message = '')
	{
		if (array_key_exists($key, $array)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_KEY_NOT_EXISTS',
				[
					'#VALUE#' => static::valueToString($key),
				],
				$message
			));
		}
	}

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function functionExists($value, string $message = '')
	{
		if (!function_exists($value)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_FUNCTION_EXISTS',
				[
					'#VALUE#' => static::valueToString($value),
				],
				$message
			));
		}
	}

	/**
	 * @param FileSystemEntry $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function fseNotExists(FileSystemEntry $value, string $message = '')
	{
		if ($value->isExists()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_FSE_NOT_EXISTS',
				[
					'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $value->getName(),
						'#PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					]),
					'#NAME#' => $value->getName(),
					'#PATH#' => FileSystem::getLocalPath($value),
					'#FILEMAN_URL#' => Admin::getFileManUrl($value),
				],
				$message
			));
		}
	}

	/**
	 * @param File $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function fileNotExists(File $value, string $message = '')
	{
		if ($value->isExists()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_FILE_NOT_EXISTS',
				[
					'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $value->getName(),
						'#PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					]),
					'#NAME#' => $value->getName(),
					'#PATH#' => FileSystem::getLocalPath($value),
					'#FILEMAN_URL#' => Admin::getFileManUrl($value),
				],
				$message
			));
		}
	}

	/**
	 * @param FileSystemEntry $value
	 * @param Regex $regex
	 * @param string $message
	 * @throws AssertException
	 */
	public static function fseNameMatches(FileSystemEntry $value, Regex $regex, string $message = '')
	{
		$matches = [];
		preg_match_all($regex->getRegex(), $value->getName(), $matches, PREG_SET_ORDER);
		if (!$matches) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_FSE_NAME_MATCH',
				[
					'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $value->getName(),
						'#PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					]),
					'#EXPECT#' => htmlspecialchars($regex->getRegexExplanation()),
					'#NAME#' => $value->getName(),
					'#PATH#' => FileSystem::getLocalPath($value),
					'#FILEMAN_URL#' => Admin::getFileManUrl($value),
				],
				$message
			));
		}
	}

	public static function fileContentNotMatches(File $value, Regex $regex, string $message = '')
	{
		static::fseExists($value);
		$content = $value->getContents();
		if ($content) {
			preg_match_all($regex->getRegex(), $content, $matches, PREG_SET_ORDER);
			if ($matches) {
				static::registerError(static::getCustomOrLocMessage(
					'INTERVOLGA_EDU.ASSERT_FILE_CONTENT_NOT_MATCH',
					[
						'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
							'#NAME#' => $value->getName(),
							'#PATH#' => FileSystem::getLocalPath($value),
							'#FILEMAN_URL#' => Admin::getFileManUrl($value),
						]),
						'#EXPECT#' => htmlspecialchars($regex->getRegexExplanation()),
						'#NAME#' => $value->getName(),
						'#PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					],
					$message
				));
			}
		}
	}

	/**
	 * @param FileSystemEntry $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function fseExists(FileSystemEntry $value, string $message = '')
	{
		if (!$value->isExists()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_FSE_EXISTS',
				[
					'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $value->getName(),
						'#PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					]),
					'#NAME#' => $value->getName(),
					'#PATH#' => FileSystem::getLocalPath($value),
					'#FILEMAN_URL#' => Admin::getFileManUrl($value),
				],
				$message
			));
		}
	}

	public static function fileContentMatches(File $value, Regex $regex, string $message = '')
	{
		static::fseExists($value);
		$content = $value->getContents();
		if ($content) {
			preg_match_all($regex->getRegex(), $content, $matches, PREG_SET_ORDER);
			if (!$matches) {
				static::registerError(static::getCustomOrLocMessage(
					'INTERVOLGA_EDU.ASSERT_FILE_CONTENT_MATCH',
					[
						'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
							'#NAME#' => $value->getName(),
							'#PATH#' => FileSystem::getLocalPath($value),
							'#FILEMAN_URL#' => Admin::getFileManUrl($value),
						]),
						'#EXPECT#' => htmlspecialchars($regex->getRegexExplanation()),
						'#NAME#' => $value->getName(),
						'#LOCAL_PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					],
					$message
				));
			}
		}
	}

	/**
	 * @param Directory $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function directoryExists(Directory $value, string $message = '')
	{
		if (!$value->isExists()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_DIRECTORY_EXISTS',
				[
					'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $value->getName(),
						'#PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					]),
					'#NAME#' => $value->getName(),
					'#PATH#' => FileSystem::getLocalPath($value),
					'#FILEMAN_URL#' => Admin::getFileManUrl($value),
				],
				$message
			));
		}
	}

	/**
	 * @param Directory $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function directoryNotExists(Directory $value, string $message = '')
	{
		if ($value->isExists()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_DIRECTORY_NOT_EXISTS',
				[
					'#VALUE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $value->getName(),
						'#PATH#' => FileSystem::getLocalPath($value),
						'#FILEMAN_URL#' => Admin::getFileManUrl($value),
					]),
					'#NAME#' => $value->getName(),
					'#PATH#' => FileSystem::getLocalPath($value),
					'#FILEMAN_URL#' => Admin::getFileManUrl($value),
				],
				$message
			));
		}
	}

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function moduleInstalled($value, string $message = '')
	{
		if (!Loader::includeModule($value)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_MODULE_INSTALLED',
				[
					'#VALUE#' => static::valueToString($value),
				],
				$message
			));
		}
	}

	/**
	 * @param string|IblockLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function iblockLocator($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_IBLOCK_LOCATOR',
				[
					'#IBLOCK#' => $value::getNameLoc(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));

		}
	}

	/**
	 * @param string|SectionLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function sectionLocator($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_SECTION_LOCATOR',
				[
					'#SECTION#' => $value::getNameLoc(),
					'#IBLOCK#' => $value::getIblock()::getNameLoc(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));

		}
	}

	/**
	 * @param string|PropertyLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function propertyLocator($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_PROPERTY_LOCATOR',
				[
					'#PROPERTY#' => $value::getNameLoc(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));

		}
	}

	/**
	 * @param string|DirectoryLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function directoryLocator($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_DIRECTORY_LOCATOR',
				[
					'#DIRECTORY#' => $value::getNameLoc(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));

		}
	}

	/**
	 * @param string|FileLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function fileLocator($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_FILE_LOCATOR',
				[
					'#FILE#' => $value::getNameLoc(),
					'#POSSIBLE#' => $value::getPossibleTips(),
				],
				$message
			));

		}
	}

	public static function menuItemExists($menuPath, $item, string $message = '')
	{
		$menuFile = FileSystem::getFile($menuPath);
		static::fseExists($menuFile);
		$links = Menu::getMenuLinks($menuPath);
		if (!array_key_exists($item, $links)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_MENU_ITEM_EXISTS',
				[
					'#MENU#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $menuFile->getName(),
						'#PATH#' => FileSystem::getLocalPath($menuFile),
						'#FILEMAN_URL#' => Admin::getFileManUrl($menuFile),
					]),
					'#ITEM#' => $item,
					'#NAME#' => $menuFile->getName(),
					'#PATH#' => FileSystem::getLocalPath($menuFile),
					'#FILEMAN_URL#' => Admin::getFileManUrl($menuFile),
				],
				$message
			));
		}
	}

	public static function menuItemNotExists(string $menuPath, string $item, string $message = '')
	{
		$menuFile = FileSystem::getFile($menuPath);
		$links = Menu::getMenuLinks($menuPath);
		if (array_key_exists($item, $links)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_MENU_ITEM_NOT_EXISTS',
				[
					'#MENU#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $menuFile->getName(),
						'#PATH#' => FileSystem::getLocalPath($menuFile),
						'#FILEMAN_URL#' => Admin::getFileManUrl($menuFile),
					]),
					'#ITEM#' => $item,
					'#NAME#' => $menuFile->getName(),
					'#PATH#' => FileSystem::getLocalPath($menuFile),
					'#FILEMAN_URL#' => Admin::getFileManUrl($menuFile),
				],
				$message
			));
		}
	}

	/**
	 * @param string $message
	 * @throws AssertException
	 */
	public static function custom(string $message)
	{
		static::registerError($message);
	}

	public static function interceptErrorsOn()
	{
		if (!static::$interceptErrors) {
			static::$interceptErrors = true;
			static::$interceptedErrors = [];
		}
	}

	public static function interceptErrorsOff()
	{
		if (static::$interceptErrors) {
			static::$interceptErrors = false;
		}
	}

	public static function throwIntercepted()
	{
		if (static::$interceptedErrors) {
			$errors = static::$interceptedErrors;
			static::$interceptedErrors = [];
			throw AssertException::createMultiple($errors);
		}
	}
}
