<?php
namespace Intervolga\Edu\Tests\Course3\Lesson5;

use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\GalleryTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestTemplate extends BaseComponentTemplateTest
{

	protected static function getLocator()
	{
		return GalleryTemplate::class;
	}

	protected static function getComponentTemplateTree()
	{
		return SimpleComponentTemplate::class;
	}
}