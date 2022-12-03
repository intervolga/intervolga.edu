<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\PromoIblock;
use Intervolga\Edu\Locator\IO\LastPromoTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestLastPromo extends BaseComponentTemplateTest
{
	protected static function run()
	{
		$iblock = PromoIblock::find();
		Assert::directoryLocator(LastPromoTemplate::class);
		if ($templateDir = LastPromoTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
