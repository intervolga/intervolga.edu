<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\PathMask;

class TestImages extends BaseTest
{
	public static function run()
	{
		$dirs = PathMask::getFileSystemEntriesByMask('/local/templates/*/components/*/menu/*/images/');
		foreach ($dirs as $dir) {
			static::registerErrorIfFileSystemEntryExists($dir, Loc::getMessage('INTERVOLGA_EDU.IMAGES_DELETE_REASON'));
		}
	}
}