<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;

class TestImages extends BaseTest
{
	protected static function run()
	{
		/**
		 * @var Directory[] $dirs
		 */
		$dirs = PathMaskParser::getFileSystemEntriesByMask('/local/templates/*/components/*/menu/*/images/');
		foreach ($dirs as $dir) {
			Assert::directoryNotExists($dir);
		}
	}
}