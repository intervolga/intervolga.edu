<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FilesetBuilder;

class TestLowerCase extends BaseTest
{
	public static function run()
	{
		$publicFiles = FilesetBuilder::getPublic(true, true);
		$regex = '/[A-Z]/u';

		static::registerErrorForFileSystemEntriesNameMatch($publicFiles, $regex, Loc::getMessage('INTERVOLGA_EDU.NOT_LOWER_CASE'));
	}
}