<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\Template\SliderTree;
use Intervolga\Edu\Locator\IO\SliderStockTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class SliderTestCode extends BaseComponentTemplateTest
{
	protected static function getLocator()
	{
		return SliderStockTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return SliderTree::class;
	}
}