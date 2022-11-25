<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestSiteCorporate extends BaseTest
{
	public static function run()
	{
		static::testSiteCorporateModule();
		static::testSiteCorporatePublic();
		static::testSiteCorporateIblock();
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

	protected static function testSiteCorporateIblock()
	{
		$codes = [
			'furniture_products_s1',
			'furniture_services_s1',
			'furniture_news_s1',
		];
		$foundCodes = [];
		if (Loader::includeModule('iblock')) {
			$getList = IblockTable::getList([
				'filter' => [
					'=CODE' => $codes,
				],
				'select' => [
					'ID',
					'CODE',
				],
			]);
			while ($fetch = $getList->fetch()) {
				$foundCodes[] = $fetch['CODE'];
			}
			if (count($foundCodes)<count($codes)) {
				static::registerError(
					Loc::getMessage(
						'INTERVOLGA_EDU.IBLOCKS_NOT_FOUND',
						[
							'#CODES#' => implode(', ', array_diff($codes, $foundCodes)),
						]
					)
				);
			}
		}
	}
}