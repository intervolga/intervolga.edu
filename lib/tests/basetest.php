<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

Loc::loadMessages(__FILE__);

abstract class BaseTest
{
	protected static $errors = [];

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

	protected static function testFilesetToBeDeleted($fileset, $regex, $reason)
	{
		$imagesDirs = $fileset->getByRegex($regex);

		foreach ($imagesDirs->getFileSystemEntries() as $fileSystemEntry) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.REMOVE_REQUIRED', [
				'#PATH#' => FileSystem::getLocalPath($fileSystemEntry),
				'#ADMIN_LINK#' => Admin::getFileManUrl($fileSystemEntry),
				'#REASON#' => $reason,
			]));
		}
	}
}
