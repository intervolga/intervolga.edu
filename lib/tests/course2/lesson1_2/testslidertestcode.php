<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\Template\SliderTree;
use Intervolga\Edu\Locator\IO\SliderStockTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestSliderTestCode extends BaseComponentTemplateTest
{
	protected static function getLocator(): string
    {
		return SliderStockTemplate::class;
	}

	/**
	 * @return string
     */
	protected static function getComponentTemplateTree(): string
    {
		return SliderTree::class;
	}

    /**
     * @throws AssertException
     */
    protected static function checkNotExistingFilesTemplate(ComponentTemplate $templateDir)
    {
        Assert::fseNotExists($templateDir->getImagesDir());
        Assert::fseNotExists($templateDir->getDescriptionFile());
    }
}