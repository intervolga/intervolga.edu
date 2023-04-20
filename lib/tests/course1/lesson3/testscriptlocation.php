<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\directory\DefaultTemplates;
use Intervolga\Edu\Locator\IO\directory\ImgDefaultTemplates;
use Intervolga\Edu\Locator\IO\directory\InnerTemplates;
use Intervolga\Edu\Locator\IO\directory\JsDefaultTemplates;
use Intervolga\Edu\Locator\IO\directory\MainTemplates;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

class TestScriptLocation extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		static::checkLocations(MainTemplates::class, 'false');
		static::checkLocations(InnerTemplates::class, 'false');
		static::checkLocations(DefaultTemplates::class, 'false', false);
		static::checkLocations(DefaultTemplates::class, 'true', true, false);

		Assert::directoryLocator(JsDefaultTemplates::class);
		static::checkScriptLocation(JsDefaultTemplates::class, 'true', false);
		Assert::directoryLocator(ImgDefaultTemplates::class);
		static::checkImgLocation(ImgDefaultTemplates::class, 'true');
	}

	/**
	 * @param string|DirectoryLocator $directory
	 */
	protected static function checkLocations($directory, string $assert, $folders = true, $files = true)
	{
		Assert::directoryLocator($directory);
		if ($directory::find()) {
			static::checkScriptLocation($directory, $assert, $folders, $files);
			static::checkImgLocation($directory, $assert, $files);
		}
	}

	/**
	 * @param string|DirectoryLocator $directory
	 */
	protected static function checkScriptLocation($directory, string $assert, $folders = true, $files = true)
	{

		if ($templateDir = $directory::find()) {
			if ($folders) {
				$folders = Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_FOLDERS_LIST');
				static::checkDirectories($templateDir, $folders, $assert);
			}
			if ($files) {
				$files = Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_SCRIPT_LIST');
				static::checkFiles($templateDir, $files, $assert);
			}
		}
	}

	/**
	 * @param Directory|null $templateDir
	 */
	protected static function checkDirectories(Directory $templateDir, $folders, $assert)
	{
		foreach ($folders as $folder) {
			Assert::$assert(FileSystem::getInnerDirectory($templateDir, $folder)->isExists(),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_FOLDER_IN_DIRECTORY_' . mb_strtoupper($assert),
					[
						'#FOLDER#' => $folder,
						'#DIRECTORY_NAME#' => $templateDir->getName(),
						'#DIRECTORY_PATH#' => Admin::getFileManUrl($templateDir),
					]
				)
			);
		}
	}

	/**
	 * @param Directory|null $templateDir
	 */
	protected static function checkFiles(Directory $templateDir, $files, $assert)
	{
		foreach ($files as $file) {
			Assert::$assert(FileSystem::getInnerFile($templateDir, $file)->isExists(),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_FILE_IN_DIRECTORY_' . mb_strtoupper($assert),
					[
						'#FILE#' => $file,
						'#DIRECTORY_NAME#' => $templateDir->getName(),
						'#DIRECTORY_PATH#' => Admin::getFileManUrl($templateDir),
					]
				)
			);
		}
	}

	/**
	 * @param string|DirectoryLocator $directory
	 */
	protected static function checkImgLocation($directory, string $assert, $files = true)
	{
		if ($templateDir = $directory::find()) {
			if ($files) {
				$files = Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_IMG_LIST');
				static::checkFiles($templateDir, $files, $assert);
			}
		}
	}
}