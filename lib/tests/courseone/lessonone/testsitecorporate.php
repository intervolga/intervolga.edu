<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\TestException;

Loc::loadMessages(__FILE__);

class TestSiteCorporate extends \Intervolga\Edu\Tests\BaseTest
{
	public static function run()
	{
		static::testModule();
		static::testPublic();
		static::testIblock();
	}

	protected static function testModule()
	{
		if (!Loader::includeModule('bitrix.sitecorporate')) {
			throw new TestException(Loc::getMessage('INTERVOLGA_EDU.MODULE_SITECORPORATE_NOT_INSTALLED'));
		}
	}

	protected static function testPublic()
	{
		$paths = [
			'/company/mission.php',
			'/company/management.php',
		];
		foreach ($paths as $path) {
			if (!File::isFileExists(Application::getDocumentRoot() . $path)) {
				throw new TestException(Loc::getMessage('INTERVOLGA_EDU.PAGE_NOT_FOUND', ['#PAGE#' => $path]));
			}
		}
	}

	protected static function testIblock()
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
				throw new TestException(Loc::getMessage('INTERVOLGA_EDU.IBLOCKS_NOT_FOUND', ['#CODES#' => implode(', ', array_diff($codes, $foundCodes))]));
			}
		}
	}
}