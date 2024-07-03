<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\Component\Component;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

abstract class BaseComponentTest extends BaseComponentTemplateTest
{
	public static function interceptErrors()
	{
		return true;
	}

	public static function getTestLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COMPONENT_NAME',
			[
				'#COMPONENT#' => static::getLocator()::getNameLoc(),
			]
		);
	}

	/**
	 * @return string|DirectoryLocator
	 */
	abstract protected static function getLocator();

	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COMPONENT_DESCRIPTION');
	}

	protected static function run()
	{
		$locatorComponent = static::getLocator();
		Assert::directoryLocator($locatorComponent);
		if ($componentDir = $locatorComponent::find(static::getComponentTemplateTree())) {
			/**
			 * @var Component $componentDir
			 */
			static::testComponentTrash($componentDir);
		}
	}

	/**
	 * @return string|Component
	 */
	abstract protected static function getComponentTemplateTree();

	protected static function testComponentTrash(Component $componentDir)
	{
		foreach ($componentDir->getUnknownFileSystemEntries() as $unknownFileSystemEntry) {
			if ($unknownFileSystemEntry->getName() == $componentDir->getTemplatesDir()->getName()) {
				$locatorTemplate = static::getTemplateLocator();
				Assert::directoryLocator($locatorTemplate);
				if ($templateDir = $locatorTemplate::find(static::getComponentTemplateTree()::getTemplateTree())) {
					/**
					 * @var ComponentTemplate $templateDir
					 */
					static::testTemplateTrash($templateDir);
					static::testTemplateCode($templateDir);
				}
			} else {
				Assert::fseNotExists($unknownFileSystemEntry);
			}
		}

		static::checkRequiredFilesComponent($componentDir);

		foreach ($componentDir->getLangForeignDirs() as $langForeignDir) {
			Assert::directoryNotExists($langForeignDir);
		}
		static::testComponentLangRuTrash($componentDir);
	}

	/**
	 * @return string|DirectoryLocator
	 */
	abstract protected static function getTemplateLocator();

	protected static function checkRequiredFilesComponent(Component $componentDir)
	{
		Assert::fseExists($componentDir->getParametersFile());
		Assert::fseExists($componentDir->getDescriptionFile());
		if (!$componentDir->getComponentFile()->isExists()) {
			Assert::fseExists($componentDir->getClassFile());
		} else {
			Assert::fseExists($componentDir->getComponentFile());
		}
	}

	protected static function testComponentLangRuTrash(Component $componentDir)
	{
		if ($componentDir->getLangRuDir()->isExists()) {
			foreach ($componentDir->getLangRuDir()->getChildren() as $child) {
				if (!in_array($child->getName(), [
					$componentDir->getDescriptionFile()->getName(),
					$componentDir->getParametersFile()->getName(),
					$componentDir->getClassFile()->getName(),
					$componentDir->getComponentFile()->getName()
				])) {
					Assert::fseNotExists($child);
				}
			}
		}
	}
}