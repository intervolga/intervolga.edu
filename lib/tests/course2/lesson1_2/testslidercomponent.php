<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\SliderTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestSliderComponent extends BaseComponentTemplateTest
{
	protected static function getLocator(): string
	{
		return SliderTemplate::class;
	}

	protected static function getComponentTemplateTree(): string
	{
		return SimpleComponentTemplate::class;
	}

	protected static function checkNotExistingFilesTemplate(ComponentTemplate $templateDir)
	{
		Assert::fseNotExists($templateDir->getImagesDir());
		Assert::fseNotExists($templateDir->getDescriptionFile());
	}
}