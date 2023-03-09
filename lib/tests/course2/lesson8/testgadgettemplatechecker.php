<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\FilesTree;
use Intervolga\Edu\FilesTree\GadgetTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\Gadgets;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestGadgetTemplateChecker extends BaseComponentTemplateTest
{
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

	protected static function checkRequiredFilesTemplate($templateDir)
	{
		Assert::fseExists($templateDir->getDescriptionFile());
		Assert::fseExists($templateDir->getParametersFile());
		Assert::fseExists($templateDir->getIndexFile());
	}

	protected static function checkNotExistingFilesTemplate($templateDir) {}
}