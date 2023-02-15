<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertPhp;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\NewsTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Util\Sniffer;

abstract class BaseComponentTemplateTest extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	public static function getTestLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COMPONENT_TEMPLATE_NAME', [
			'#TEMPLATE#' => static::getLocator()::getNameLoc(),
		]);
	}

	/**
	 * @return string|DirectoryLocator
	 */
	abstract protected static function getLocator();

	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COMPONENT_TEMPLATE_DESCRIPTION');
	}

	protected static function run()
	{
		$locatorClass = static::getLocator();
		Assert::directoryLocator($locatorClass);
		if ($templateDir = $locatorClass::find(static::getComponentTemplateTree())) {
			/**
			 * @var ComponentTemplate $templateDir
			 */
			static::testTemplateTrash($templateDir);
			static::testTemplateCode($templateDir);
		}
	}

	/**
	 * @return string|ComponentTemplate
	 */
	abstract protected static function getComponentTemplateTree();

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

	protected static function checkRequiredFilesTemplate($templateDir)
	{
		if ($templateDir instanceof NewsTemplate) {
			Assert::fseExists($templateDir->getNewsFile());
			Assert::fseExists($templateDir->getDetailFile());
		} else {
			Assert::fseExists($templateDir->getTemplateFile());
		}
	}

	protected static function testTemplateLangRuTrash(ComponentTemplate $templateDir)
	{
		if ($templateDir->getLangRuDir()->isExists()) {
			foreach ($templateDir->getLangRuDir()->getChildren() as $child) {
				if (!in_array($child->getName(), static::getKnownFilesNames($templateDir))) {
					Assert::fseNotExists($child);
				}
			}
		}
	}

	protected static function getKnownFilesNames(ComponentTemplate $templateDir)
	{
		$names = [];
		foreach ($templateDir->getKnownFiles() as $file) {
			$names[] = $file->getName();
		}

		return $names;
	}

	protected static function testTemplateCode(ComponentTemplate $templateDir)
	{
		$files = [];
		foreach ($templateDir->getKnownPhpFiles() as $knownPhpFile) {
			if ($knownPhpFile->isExists()) {
				$files[] = $knownPhpFile->getPath();
			}
		}
		Assert::phpSniffer($files, [
			'general',
			'templateChecker'
		]);
	}
}