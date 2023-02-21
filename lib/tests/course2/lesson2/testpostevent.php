<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;

use Bitrix\Main\Localization\Loc;
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
		$template = CheckOldStocksTemplate::find();
		Assert::eq($template['EMAIL_FROM'], '#DEFAULT_EMAIL_FROM#', Loc::getMessage('INTERVOLGA_EDU.EMAIL_FROM_INVALID'));
	}
}