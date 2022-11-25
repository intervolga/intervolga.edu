<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FilesetBuilder;

class TestLowerCase extends BaseTest
{
	public static function run()
	{
		$fileset = FilesetBuilder::getPublic(true, true);
		$regex = '/[A-Z]/u';

		static::registerErrorForFileSystemEntriesNameMatch($fileset->getFileSystemEntries(), $regex, Loc::getMessage('INTERVOLGA_EDU.NOT_LOWER_CASE'));
	}
}