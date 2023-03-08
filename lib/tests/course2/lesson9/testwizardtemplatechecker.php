<?php
namespace Intervolga\Edu\Tests\Course2\Lesson9;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\WizardTree;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\Wizard;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestWizardTemplate extends BaseComponentTemplateTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return Wizard::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return WizardTree::class;
	}

	protected static function checkNotExistingFilesTemplate($templateDir) {}

	protected static function checkRequiredFilesTemplate($templateDir)
	{
		Assert::fseExists($templateDir->getVersionFile());
		Assert::fseExists($templateDir->getWizardFile());
		Assert::fseExists($templateDir->getDescriptionFile());
	}
}