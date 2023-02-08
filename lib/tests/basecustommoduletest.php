<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;

abstract class BaseCustomModuleTest extends BaseComponentTemplateTest
{
	public static function getTestLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_CUSTOM_MODULE_NAME', [
			'#MODULE_NAME#' => static::getLocator()::getNameLoc(),
		]);
	}

	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_CUSTOM_MODULE_DESCRIPTION');
	}

	protected static function testTemplateTrash(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getUnknownFileSystemEntries() as $unknownFileSystemEntry) {
			Assert::fseNotExists($unknownFileSystemEntry);
		}

		static::checkRequiredFilesTemplate($templateDir);

		foreach ($templateDir->getLangForeignDirs() as $langForeignDir) {
			Assert::directoryNotExists($langForeignDir);
		}
		static::testTemplateLangRuTrash($templateDir);
	}

	protected static function checkRequiredFilesTemplate(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getKnownDirs() as $directory) {
			Assert::directoryExists($directory);
		}

		foreach ($templateDir->getKnownFiles() as $files) {
			Assert::fseExists($files);
		}
	}
}