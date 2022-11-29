<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\IO\FileSystemEntry;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Param;
use Intervolga\Edu\Util\Regex;

Loc::loadMessages(__FILE__);

abstract class BaseTest
{
	protected static $errors = [];

	public static function getCourseCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[0]);
	}

	public static function getCourseLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()));
	}

	public static function getLessonCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[1]);
	}

	public static function getLessonLoc(): string
	{
		$code = 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode());
		$loc = Loc::getMessage($code);
		if (mb_strlen($loc)) {
			return $loc;
		} else {
			return $code;
		}
	}

	public static function getTestCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return preg_replace('/^Test/', '', $tmpArray[2]);
	}

	public static function getTestLoc(): string
	{
		$code = 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode()) . '_' . mb_strtoupper(static::getTestCode());
		$loc = Loc::getMessage($code);
		if (mb_strlen($loc)) {
			return $loc;
		} else {
			return $code;
		}
	}

	public static function run()
	{
		static::registerError('Not implemented yet');
	}

	/**
	 * @param string $error
	 */
	protected static function registerError($error)
	{
		static::$errors[get_called_class()][] = $error;
	}

	/**
	 * @return string[]
	 */
	public static function getErrors()
	{
		return (array)static::$errors[get_called_class()];
	}

	/**
	 * @param FileSystemEntry[] $files
	 * @param Regex[] $regexes
	 */
	protected static function registerErrorIfFileContentNotFoundByRegex(array $files, array $regexes)
	{
		foreach ($files as $fileSystemEntry) {
			if ($fileSystemEntry->isFile()) {
				$content = $fileSystemEntry->getContents();
				foreach ($regexes as $regexObject) {
					preg_match_all($regexObject->getRegex(), $content, $matches, PREG_SET_ORDER, 0);
					if (!$matches) {
						static::registerError(Loc::getMessage('INTERVOLGA_EDU.CONTENT_NOT_FOUND', [
							'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
							'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
							'#REGEX_EXPLAIN#' => htmlspecialchars($regexObject->getRegexExplanation()),
							'#REASON#' => htmlspecialchars($regexObject->getTipToReplace()),
						]));
					}
				}
			}
		}
	}

	/**
	 * @param FileSystemEntry[] $fileSystemEntries
	 * @param Regex[] $regexes
	 */
	protected static function registerErrorIfFileContentFoundByRegex(array $fileSystemEntries, array $regexes)
	{
		foreach ($fileSystemEntries as $fileSystemEntry) {
			if ($fileSystemEntry->isFile()) {
				$content = $fileSystemEntry->getContents();
				foreach ($regexes as $regexObject) {
					preg_match_all($regexObject->getRegex(), $content, $matches, PREG_SET_ORDER);
					if ($matches) {
						static::registerError(Loc::getMessage('INTERVOLGA_EDU.CONTENT_FOUND', [
							'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
							'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
							'#REGEX_EXPLAIN#' => htmlspecialchars($regexObject->getRegexExplanation()),
							'#REASON#' => htmlspecialchars($regexObject->getTipToReplace()),
						]));
					}
				}
			}
		}
	}

	protected static function registerErrorIfFileSystemEntryExists(FileSystemEntry $fileSystemEntry, $reason)
	{
		if ($fileSystemEntry->isExists()) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.DELETE_FILE_SYSTEM_ENTRY', [
				'#PATH#' => $fileSystemEntry->getName(),
				'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
				'#REASON#' => $reason,
			]));
		}
	}

	protected static function registerErrorIfFileSystemEntryLost(FileSystemEntry $fileSystemEntry, $reason)
	{
		if (!$fileSystemEntry->isExists()) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.LOST_FILE_SYSTEM_ENTRY', [
				'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
				'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
				'#REASON#' => $reason,
			]));
		}
	}

	/**
	 * @param FileSystemEntry[] $fileSystemEntries
	 * @param string $reason
	 */
	protected static function registerErrorIfAllFileSystemEntriesLost(array $fileSystemEntries, $reason)
	{
		$found = false;
		$links = [];
		foreach ($fileSystemEntries as $fileSystemEntry) {
			if ($fileSystemEntry->isExists()) {
				$found = true;
			} else {
				$links[] = Loc::getMessage('INTERVOLGA_EDU.FILE_SYSTEM_ENTRY', [
					'#PATH#' => $fileSystemEntry->getName(),
					'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
				]);
			}
		}
		if (!$found) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.ALL_FILE_SYSTEM_ENTRIES_LOST', [
				'#LINKS#' => implode(', ', $links),
				'#REASON#' => $reason,
			]));
		}
	}

	/**
	 * @param FileSystemEntry[] $fileSystemEntries
	 * @param Regex[] $regexes
	 */
	protected static function registerErrorForFileSystemEntriesNameMatch(array $fileSystemEntries, array $regexes)
	{
		foreach ($fileSystemEntries as $fileSystemEntry) {
			foreach ($regexes as $regexObject) {
				$matches = [];
				preg_match_all($regexObject->getRegex(), $fileSystemEntry->getName(), $matches, PREG_SET_ORDER);
				if ($matches) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.FILE_SYSTEM_ENTRY_MATCH', [
						'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
						'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
						'#REGEX_EXPLAIN#' => htmlspecialchars($regexObject->getRegexExplanation()),
						'#REASON#' => htmlspecialchars($regexObject->getTipToReplace()),
					]));
				}
			}
		}
	}

	protected static function registerErrorIfIblockPropertyLost(array $iblock, array $property, string $name, string $possible)
	{
		if (!$property) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.PROPERTY_NOT_FOUND', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
				'#PROPERTY#' => $name,
				'#POSSIBLE#' => $possible,
			]));
		}
	}

	protected static function registerErrorIfIblockLost(array $iblock, string $name, string $possible)
	{
		if (!$iblock) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.IBLOCK_NOT_FOUND', [
				'#IBLOCK#' => $name,
				'#POSSIBLE#' => $possible,
			]));
		}
	}
	/**
	 * @param Param[] $params
	 * @param array $iblock
	 */
	protected static function registerErrorIfIblockParamCheckFailed(array $params, array $iblock)
	{
		static::registerErrorIfParamCheckFailed($params, Loc::getMessage('INTERVOLGA_EDU.IBLOCK_CONTEXT', [
			'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
			'#IBLOCK#' => $iblock['NAME'],
		]));
	}

	/**
	 * @param Param[] $params
	 * @param string $context
	 */
	protected static function registerErrorIfParamCheckFailed(array $params, string $context)
	{
		foreach ($params as $param) {
			if ($param->getValue() != $param->getAssertValue())
			{
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.PARAM_CHECK_FAILED', [
					'#CONTEXT#' => $context,
					'#PARAM#' => $param->getName(),
					'#ASSERT_VALUE#' => $param->getAssertValue(),
				]));
			}
		}
	}
}
