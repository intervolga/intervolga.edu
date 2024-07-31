<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Intervolga\Edu\FilesTree\Component\RespondentsComponent as TreeRespondentsComponent;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\RespondentTemplate as IORespondentTemplate;
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
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return TreeRespondentsComponent::class;
	}
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getTemplateLocator()
	{
		return IORespondentTemplate::class;
	}
}