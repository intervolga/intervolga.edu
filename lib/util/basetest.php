<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\FileSystemEntry;
use Bitrix\Main\Localization\Loc;

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
		return Loc::getMessage('INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode()));
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
	 * @param Fileset $fileset
	 * @param string $regex
	 * @param string $reason
	 */
	protected static function testIfFilesetMatches($fileset, $regex, $reason)
	{
		$filesetRegexed = $fileset->getByRegex($regex);

		foreach ($filesetRegexed->getFileSystemEntries() as $fileSystemEntry) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.ACTION_REQUIRED', [
				'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
				'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
				'#REASON#' => $reason,
			]));
		}
	}

	/**
	 * @param Fileset $fileset
	 * @param Regex[] $regexes
	 * @param string $reason
	 */
	protected static function testFilesetContentByRegex($fileset, $regexes, $reason)
	{
		foreach ($fileset->getFileSystemEntries() as $fileSystemEntry) {
			if ($fileSystemEntry->isFile()) {
				$content = $fileSystemEntry->getContents();
				foreach ($regexes as $regexObject) {
					preg_match_all($regexObject->getRegex(), $content, $matches, PREG_SET_ORDER, 0);
					if ($matches) {
						$tip = $regexObject->getTipToReplace();
						if ($tip) {
							$code = 'INTERVOLGA_EDU.CONTENT_REPLACE_REQUIRED';
						} else {
							$code = 'INTERVOLGA_EDU.CONTENT_DELETE_REQUIRED';
						}
						static::registerError(Loc::getMessage($code, [
							'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
							'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
							'#REGEX_EXPLAIN#' => htmlspecialchars($regexObject->getRegexExplanation()),
							'#NEW#' => htmlspecialchars($tip),
							'#REASON#' => $reason,
						]));
					}
				}
			}
		}
	}

	/**
	 * @param Fileset $fileset
	 * @param Regex[] $regexes
	 * @param string $reason
	 */
	protected static function testFilesetContentNotFoundByRegex($fileset, $regexes, $reason)
	{
		foreach ($fileset->getFileSystemEntries() as $fileSystemEntry) {
			if ($fileSystemEntry->isFile()) {
				$content = $fileSystemEntry->getContents();
				foreach ($regexes as $regexObject) {
					preg_match_all($regexObject->getRegex(), $content, $matches, PREG_SET_ORDER, 0);
					if (!$matches) {
						static::registerError(Loc::getMessage('INTERVOLGA_EDU.CONTENT_ADD_REQUIRED', [
							'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
							'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
							'#REGEX_EXPLAIN#' => htmlspecialchars($regexObject->getRegexExplanation()),
							'#REASON#' => $reason,
						]));
					}
				}
			}
		}
	}

	protected static function registerErrorIfFileSystemEntryExists(FileSystemEntry $fileSystemEntry, $reason)
	{
		if ($fileSystemEntry->isExists())
		{
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.DELETE_FILE_SYSTEM_ENTRY', [
				'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
				'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
				'#REASON#' => $reason,
			]));
		}
	}
}
