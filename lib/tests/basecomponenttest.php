<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponent;
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

	/** локатор для компонента
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
			 * @var ComponentTemplate $componentDir
			 */
			static::testComponentTrash($componentDir);
		}
	}

	/** дерево компонента
	 * @return string|ComponentTemplate
	 */
	abstract protected static function getComponentTemplateTree();

	protected static function testComponentTrash(ComponentTemplate $componentDir)
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
		Assert::fseExists($componentDir->getParametersFile());
		Assert::fseExists($componentDir->getDescriptionFile());
		if (!$componentDir->getComponentFile()->isExists()) {
			Assert::fseExists($componentDir->getClassFile());
		} else {
			Assert::fseExists($componentDir->getComponentFile());
		}

		foreach ($componentDir->getLangForeignDirs() as $langForeignDir) {
			Assert::directoryNotExists($langForeignDir);
		}
		static::testComponentLangRuTrash($componentDir);
	}

	/** локатор для шаблона
	 * @return string|DirectoryLocator
	 */
	abstract protected static function getTemplateLocator();

	protected static function testComponentLangRuTrash(ComponentTemplate $componentDir)
	{
		if ($componentDir->getLangRuDir()->isExists()) {
			foreach ($componentDir->getLangRuDir()->getChildren() as $child) {
				if ($componentDir instanceof SimpleComponent) {
					if (!in_array($child->getName(), [
						$componentDir->getDescriptionFile()->getName(),
						$componentDir->getParametersFile()->getName(),
						$componentDir->getComponentFile()->getName()
					])) {
						Assert::fseNotExists($child);
					}
				}
			}
		}
	}
}