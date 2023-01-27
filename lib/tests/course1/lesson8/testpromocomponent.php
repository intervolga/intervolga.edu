<?php
namespace Intervolga\Edu\Tests\Course1\Lesson8;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\NewsTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\PromoNewsTemplate;
use Intervolga\Edu\Tests\BaseComplexComponentTemplateTest;

class TestPromoComponent extends BaseComplexComponentTemplateTest
{
	protected static function getLocator()
	{
		return PromoNewsTemplate::class;
	}

	protected static function getComponentTemplateTree()
	{
		return NewsTemplate::class;
	}

	protected static function testTemplateTrash(ComponentTemplate $templateDir)
	{
		parent::testTemplateTrash($templateDir);
		if ($templateDir instanceof NewsTemplate) {
			Assert::fseNotExists($templateDir->getSectionFile());
			Assert::fseNotExists($templateDir->getSearchFile());
			Assert::fseNotExists($templateDir->getRssFile());
			Assert::fseNotExists($templateDir->getRssSectionFile());
		}
	}
}
