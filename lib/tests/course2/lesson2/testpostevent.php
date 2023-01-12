<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Event\Type\CheckOldStocksType;
use Intervolga\Edu\Locator\Event\Template\CheckOldStocksTemplate;
use Intervolga\Edu\Tests\BaseTest;

class TestPostEvent extends BaseTest
{
	protected static function run()
	{
		Assert::eventMessageExists(CheckOldStocksType::class);
		Assert::eventTemplateExists(CheckOldStocksTemplate::class);
	}
}