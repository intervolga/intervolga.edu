<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_1;

use Intervolga\Edu\FilesTree\Component\SimpleComponent;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\VacanciesListTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\VacanciesListComponent;
use Intervolga\Edu\Tests\BaseComponentTest;

class TestComponentDirectory extends BaseComponentTest
{
	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return SimpleComponent::class;
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getTemplateLocator()
	{
		return VacanciesListTemplate::class;
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return VacanciesListComponent::class;
	}

}