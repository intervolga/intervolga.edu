<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\GadgetTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\DesktopTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class GadgetComponentTest extends BaseComponentTemplateTest
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
		return GadgetTemplate::class;
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