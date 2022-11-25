<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FilesetBuilder;

class TestImages extends BaseTest
{
	public static function run()
	{
		$fileset = FilesetBuilder::getLocalTemplatesComponentsInner(true, false);
		$regex = '/\/menu\/.*\/images/ui';	// /menu/*/images/

		static::testIfFilesetMatches($fileset, $regex, Loc::getMessage('INTERVOLGA_EDU.IMAGES_DELETE_REASON'));
	}
}