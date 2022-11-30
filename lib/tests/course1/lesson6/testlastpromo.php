<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Tests\BaseComponentTemplateTest;
use Intervolga\Edu\Util\Registry\Directory\Templates\LastPromoTemplate;
use Intervolga\Edu\Util\Registry\Iblock\PromoIblock;

class TestLastPromo extends BaseComponentTemplateTest
{
	public static function run()
	{
		$iblock = PromoIblock::find();
		static::registerErrorIfRegistryDirectoryLost(LastPromoTemplate::class);
		if ($templateDir = LastPromoTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}