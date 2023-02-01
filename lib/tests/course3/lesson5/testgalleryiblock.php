<?php
namespace Intervolga\Edu\Tests\Course3\Lesson5;
use Intervolga\Edu\Locator\Iblock\GalleryIblock;
use Intervolga\Edu\Tests\BaseTestIblock;

class TestGalleryIblock extends BaseTestIblock
{
	protected static function getLocator()
	{
		return GalleryIblock::class;
	}

	protected static function getMinCount(): int
	{
		return 5;
	}

	protected static function testElementsLog(array $iblock)
	{}
}