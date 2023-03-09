<?php
namespace Intervolga\Edu\Tests\Course2\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\ComponentTemplate\CustomVacanciesTemplate;
use Intervolga\Edu\Locator\IO\CustomVacancies as CustomVacanciesComponentLocator;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComplexComponentTemplateTest;

class TestInnerTemplates extends BaseComplexComponentTemplateTest
{
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
		return CustomVacanciesTemplate::class;
	}
}