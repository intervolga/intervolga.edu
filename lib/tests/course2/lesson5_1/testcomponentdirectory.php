<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_1;

use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponent;
use Intervolga\Edu\Locator\IO\CustomComponent;
use Intervolga\Edu\Locator\IO\CustomComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
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
		return CustomComponentTemplate::class;
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return CustomComponent::class;
	}

}