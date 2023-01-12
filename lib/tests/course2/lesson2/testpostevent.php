<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Event\Message\CheckOldStocksMessage;
use Intervolga\Edu\Locator\Event\Template\CheckOldStocksTemplate;
use Intervolga\Edu\Tests\BaseTest;

class TestPostEvent extends BaseTest
{
	protected static function run()
	{
		Assert::eventMessageExists(CheckOldStocksMessage::class);
		Assert::eventTemplateExists(CheckOldStocksTemplate::class);
	}
}