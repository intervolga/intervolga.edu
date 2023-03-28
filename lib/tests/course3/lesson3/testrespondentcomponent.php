<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Intervolga\Edu\FilesTree\Component\Component;
use Intervolga\Edu\FilesTree\Component\SimpleComponent;
use Intervolga\Edu\Locator\IO\CustomRespondents;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTest;

class TestRespondentComponent extends BaseComponentTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return CustomRespondents::class;
	}

	/**
	 * @return string|Component
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
		return CustomRespondents::class;
	}
}