<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\PathsRegistry;

class TestReviewsCarousel extends BaseTest
{
	public static function run()
	{
		$paths = PathsRegistry::getReviewsCarouselPossibleDirectories();
		static::registerErrorIfAllFileSystemEntriesLost($paths, Loc::getMessage('INTERVOLGA_EDU.CAROUSEL_TEMPLATE_VARIANTS'));
	}
}
