<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Registry\Iblock\NewsIblock;
use Intervolga\Edu\Util\Registry\Iblock\ProductsIblock;
use Intervolga\Edu\Util\Registry\Iblock\ServicesIblock;

class TestSiteCorporate extends BaseTest
{
	public static function run()
	{
		static::testSiteCorporateModule();
		static::testSiteCorporatePublic();
		static::testSiteCorporateIblocks();
	}

	protected static function testSiteCorporateModule()
	{
		if (!Loader::includeModule('bitrix.sitecorporate')) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.MODULE_SITECORPORATE_NOT_INSTALLED'));
		}
	}

	protected static function testSiteCorporatePublic()
	{
		$paths = [
			'/company/mission.php',
			'/company/management.php',
		];
		foreach ($paths as $path) {
			$file = FileSystem::getFile($path);
			static::registerErrorIfFileSystemEntryLost($file, Loc::getMessage('INTERVOLGA_EDU.MODULE_PAGE'));
		}
	}

	protected static function testSiteCorporateIblocks()
	{
		static::registerErrorIfIblockLost(ProductsIblock::class);
		static::registerErrorIfIblockLost(ServicesIblock::class);
		static::registerErrorIfIblockLost(NewsIblock::class);
	}
}