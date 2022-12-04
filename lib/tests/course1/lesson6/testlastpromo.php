<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\LastPromoTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestLastPromo extends BaseComponentTemplateTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return LastPromoTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return SimpleComponentTemplate::class;
	}
}
