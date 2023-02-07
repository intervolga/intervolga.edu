<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\DesktopTemplateTree;
use Intervolga\Edu\Locator\IO\ComponentTemplate\DesktopTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class DesktopComponentTest extends BaseComponentTemplateTest
{
	protected static function run()
	{
		$locatorClass = static::getLocator();
		Assert::directoryLocator($locatorClass);
		if ($templateDir = $locatorClass::find(static::getComponentTemplateTree())) {
			/**
			 * @var ComponentTemplate $templateDir
			 */
			static::testTemplateTrash($templateDir);
		}
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return DesktopTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return DesktopTemplateTree::class;
	}

	protected static function checkRequiredFilesTemplate($templateDir)
	{
		Assert::fseExists($templateDir->getTemplateFile());
		Assert::fseExists($templateDir->getResultModifier());
		Assert::fseExists($templateDir->getParametersFile());
	}

	protected static function checkNotExistingFiles($templateDir)
	{
		Assert::fseNotExists($templateDir->getDescriptionFile());
	}
}