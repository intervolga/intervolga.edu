<?php
namespace Intervolga\Edu\Tests\Course1\Lesson10;

use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\SearchFormTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestSearchTemplate extends BaseComponentTemplateTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return SearchFormTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return SimpleComponentTemplate::class;
	}
}
