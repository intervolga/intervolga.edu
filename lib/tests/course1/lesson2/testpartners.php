<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\PathsRegistry;

class TestPartners extends BaseTest
{
	public static function run()
	{
		$paths = PathsRegistry::getPartnersPossibleDirectories();
		static::registerErrorIfAllFileSystemEntriesLost($paths, Loc::getMessage('INTERVOLGA_EDU.PARTNERS_DIR_NOT_FOUND'));
	}
}