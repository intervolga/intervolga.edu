<?php
namespace Intervolga\Edu\Tests\Course2\Lesson9;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\WizardTree;
use Intervolga\Edu\Locator\IO\Wizard;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class WizardTemplateChecker extends BaseComponentTemplateTest
{
	protected static function getLocator()
	{
		return Wizard::class;
	}

	protected static function getComponentTemplateTree()
	{
		return WizardTree::class;
	}

	protected static function checkRequiredFilesTemplate($templateDir)
	{
		Assert::fseExists($templateDir->getVersionFile());
		Assert::fseExists($templateDir->getWizardFile());
		Assert::fseExists($templateDir->getDescriptionFile());
	}
}