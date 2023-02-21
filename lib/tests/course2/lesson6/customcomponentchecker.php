<?php
namespace Intervolga\Edu\Tests\Course2\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\FilesTree\Component\ComplexComponent;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\Locator\Component\CustomVacancies;
use Intervolga\Edu\Locator\IO\ComponentTemplate\CustomVacanciesTemplate;
use Intervolga\Edu\Locator\IO\CustomVacancies as CustomVacanciesComponentLocator;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTest;

class CustomComponentChecker extends BaseComponentTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(CustomVacancies::class);
		if (CustomVacancies::find()) {
			parent::run();
		}
	}

	protected static function checkRequiredFilesTemplate(ComponentTemplate $templateDir)
	{
		Assert::fseExists($templateDir->getResumeFile());
		Assert::fseExists($templateDir->getVacanciesFile());
		Assert::fseExists($templateDir->getVacancyFile());
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return CustomVacanciesComponentLocator::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return ComplexComponent::class;
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getTemplateLocator()
	{
		return CustomVacanciesTemplate::class;
	}
}