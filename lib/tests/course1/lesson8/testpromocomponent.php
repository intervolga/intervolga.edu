<?php
namespace Intervolga\Edu\Tests\Course1\Lesson8;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComplexComponentTemplate;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\ComponentTemplate\NewsTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\PromoNewsTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestPromoComponent extends BaseComponentTemplateTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return PromoNewsTemplate::class;
	}

	/**
	 * @return string|ComplexComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return NewsTemplate::class;
	}

	protected static function checkNotExistingFilesComponentTemplate(ComponentTemplate $templateDir)
	{
		Assert::fseNotExists($templateDir->getSectionFile());
		Assert::fseNotExists($templateDir->getSearchFile());
		Assert::fseNotExists($templateDir->getRssFile());
		Assert::fseNotExists($templateDir->getRssSectionFile());
	}
}
