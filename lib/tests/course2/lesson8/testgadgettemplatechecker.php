<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\FilesTree;
use Intervolga\Edu\FilesTree\GadgetTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\Gadgets;
use Intervolga\Edu\Tests\BaseTest;

class TestGadgetTemplateChecker extends BaseTest
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
	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COMPONENT_TEMPLATE_DESCRIPTION');
	}
	protected static function run()
	{
		$locatorClass = static::getLocator();
		Assert::directoryLocator($locatorClass);
		if ($gadgetDir = $locatorClass::find(static::getComponentTemplateTree())) {
			/**
			 * @var ComponentTemplate $gadgetDir
			 */
			static::testGadgetTrash($gadgetDir);
			static::testGadgetCode($gadgetDir);
		}
	}
	protected static function testGadgetTrash(FilesTree $gadgetDir)
	{
		foreach ($gadgetDir->getUnknownFileSystemEntries() as $unknownFileSystemEntry) {
			Assert::fseNotExists($unknownFileSystemEntry);
		}
		static::checkRequiredFilesTemplate($gadgetDir);

		foreach ($gadgetDir->getLangForeignDirs() as $langForeignDir) {
			Assert::directoryNotExists($langForeignDir);
		}
		static::testTemplateLangRuTrash($gadgetDir);
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return Gadgets::class;
	}

	/**
	 * @return string|FilesTree
	 */
	protected static function getComponentTemplateTree()
	{
		return GadgetTemplate::class;
	}

	protected static function checkRequiredFilesTemplate($gadgetDir)
	{
		Assert::fseExists($gadgetDir->getDescriptionFile());
		Assert::fseExists($gadgetDir->getParametersFile());
		Assert::fseExists($gadgetDir->getIndexFile());
	}

	protected static function testTemplateLangRuTrash(FilesTree $gadgetDir)
	{
		if ($gadgetDir->getLangRuDir()->isExists()) {
			foreach ($gadgetDir->getLangRuDir()->getChildren() as $child) {

				if ($child->isDirectory()) {
					if (!in_array($child->getName(), static::getKnownDirNames($gadgetDir))) {
						Assert::directoryNotExists($child);
					}
				} elseif ($child->isFile()) {
					if (!in_array($child->getName(), static::getKnownFilesNames($gadgetDir))) {
						Assert::fseNotExists($child);
					}
				}
			}
		}
	}

	protected static function getKnownDirNames(FilesTree $gadgetDir)
	{
		$names = [];
		foreach ($gadgetDir->getKnownDirs() as $file) {
			$names[] = $file->getName();
		}

		return $names;
	}

	protected static function getKnownFilesNames(FilesTree $gadgetDir)
	{
		$names = [];
		foreach ($gadgetDir->getKnownFiles() as $file) {
			$names[] = $file->getName();
		}

		return $names;
	}

	protected static function testGadgetCode(FilesTree $gadgetDir)
	{
		$files = [];
		foreach ($gadgetDir->getKnownPhpFiles() as $knownPhpFile) {
			if ($knownPhpFile->isExists()) {
				$files[] = $knownPhpFile->getPath();
			}
		}
		Assert::phpSniffer($files, [
			'general',
		]);
	}
}