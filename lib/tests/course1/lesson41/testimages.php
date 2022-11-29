<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;

class TestImages extends BaseTest
{
	public static function run()
	{
		$dirs = PathMaskParser::getFileSystemEntriesByMask('/local/templates/*/components/*/menu/*/images/');
		foreach ($dirs as $dir) {
			static::registerErrorIfFileSystemEntryExists($dir, Loc::getMessage('INTERVOLGA_EDU.IMAGES_DELETE_REASON'));
		}
	}
}