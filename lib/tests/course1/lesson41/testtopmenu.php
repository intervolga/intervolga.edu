<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\TopMenuTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestTopMenu extends BaseComponentTemplateTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return TopMenuTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return SimpleComponentTemplate::class;
	}
}
