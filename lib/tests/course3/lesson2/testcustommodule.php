<?php
namespace Intervolga\Edu\Tests\Course3\Lesson2;

use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\CustomModuleTree;
use Intervolga\Edu\Locator\IO\CustomModule;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseCustomModuleTest;

class TestCustomModule extends BaseCustomModuleTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return CustomModule::class;
	}
	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return CustomModuleTree::class;
	}
}