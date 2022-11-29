<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathsRegistry;

class TestPromo extends BaseTest
{
	public static function run()
	{
		$paths = PathsRegistry::getPromoPossibleDirectories();
		static::registerErrorIfAllFileSystemEntriesLost($paths, Loc::getMessage('INTERVOLGA_EDU.PARTNERS_DIR_NOT_FOUND'));
	}
}