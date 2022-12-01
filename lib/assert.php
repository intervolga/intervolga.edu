<?php
namespace Intervolga\Edu;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\FileSystemEntry;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;
use Intervolga\Edu\Util\Registry\Iblock\BaseIblock;

Loc::loadMessages(__FILE__);

class Assert
{
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

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function functionExists($value, string $message = '')
	{
		if (!function_exists($value)) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.ASSERT_FUNCTION_EXISTS', [
				'#VALUE#' => $value,
			]));
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
					'#EXPECT#' => htmlspecialchars($regex->getTipToReplace()),
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
	 * @param string|BaseIblock $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function registryIblock($value, string $message = '')
	{
		if (!$value::find()) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.ASSERT_REGISTRY_IBLOCK', [
				'#IBLOCK#' => $value::getName(),
				'#POSSIBLE#' => $value::getPossibleTips(),
			]));
		}
	}

	protected static function valueToString($value): string
	{
		return var_export($value, true);
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

	/**
	 * @param string $error
	 * @throws AssertException
	 */
	protected static function registerError(string $error)
	{
		throw new AssertException($error);
	}
}
