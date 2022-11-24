<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\IO\File;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestLesson1 extends BaseTest
{
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COURSE_1_LESSON_1');
	}

	public static function run()
	{
		static::testLicense();
		static::testUpdates();
		static::testSiteCorporate();
		static::testSiteChecker();
	}

	protected static function testLicense()
	{
		if ($updatesList = static::getUpdatesInfo()) {
			if ($license = $updatesList['CLIENT'][0]['@']['LICENSE']) {
				$translitLicense = \CUtil::translit($license, 'ru');
				if ($translitLicense != 'standart') {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.INCORRECT_LICENSE', ['#LICENSE#' => $license]));
				}
			}
		}
	}

	/**
	 * @return array
	 */
	protected static function getUpdatesInfo()
	{
		require_once(Application::getDocumentRoot() . '/bitrix/modules/main/classes/general/update_client.php');

		$result = [];

		if (\CUpdateClient::lock()) {
			$errorMessage = '';
			$stableVersionsOnly = Option::get('main', 'stable_versions_only', 'Y');
			$updatesList = \CUpdateClient::getUpdatesList($errorMessage, LANG, $stableVersionsOnly);
			\CUpdateClient::unLock();
			if ($updatesList) {
				$result = $updatesList;
			} else {
				static::registerError($errorMessage);
			}
		}

		return $result;
	}

	protected static function testUpdates()
	{
		$lastUpdate = Option::get('main', 'update_system_update', '-');
		if ($updatesList = static::getUpdatesInfo()) {
			if ($updatesList['MODULES'][0]['#']['MODULE']) {
				static::registerError(
					Loc::getMessage('INTERVOLGA_EDU.UPDATES_AVAILABLE',
						[
							'#COUNT#' => count($updatesList['MODULES'][0]['#']['MODULE']),
							'#LAST_UPDATE#' => $lastUpdate,
						])
				);
			}
		}
	}

	protected static function testSiteCorporate()
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
			if (!File::isFileExists(Application::getDocumentRoot() . $path)) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.PAGE_NOT_FOUND', ['#PAGE#' => $path]));
			}
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

	protected static function testSiteChecker()
	{
		$checkerTest = new \CSiteCheckerTest();
		$log = File::getFileContents(Application::getDocumentRoot() . $checkerTest->LogFile);
		if (strlen($log)) {
			$re = '/(?<date>\d{4}-.{3}-\d{2} \d{2}:\d{2}:\d{2}) (?<title>.*) \((?<code>.*)\): Fail/m';
			preg_match_all($re, $log, $matches, PREG_SET_ORDER, 0);
			foreach ($matches as $match) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.SITE_CHECK_ERROR', [
					'#DATE#' => $match['date'],
					'#TITLE#' => $match['title'],
					'#CODE#' => $match['code']
				]));
			}
		} else {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.EMPTY_SITE_CHECK_LOG'));
		}
	}
}