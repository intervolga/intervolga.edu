<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

abstract class BaseTest
{
	protected static $errors = [];

	public static function getCourse()
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[0]);
	}

	public static function getCourseLoc()
	{
		return Loc::getMessage('INTERVOLGA_EDU.COURSE_' . mb_strtoupper(static::getCourse()));
	}

	public static function getLesson()
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[1]);
	}

	public static function getLessonLoc()
	{
		return Loc::getMessage('INTERVOLGA_EDU.COURSE_' . mb_strtoupper(static::getCourse()) . '_LESSON_'. mb_strtoupper(static::getLesson()));
	}

	/**
	 * @return string
	 */
	public static function getTitle()
	{
		return str_replace(__NAMESPACE__ . '\\', '', get_called_class());
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
}
