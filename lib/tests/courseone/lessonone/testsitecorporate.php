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
	/**
	 * @return string[]
	 * @throws TestException
	 */
	public static function getErrors()
	{
		$errors = [];
		$errors = array_merge($errors, static::testModule());
		$errors = array_merge($errors, static::testPublic());
		$errors = array_merge($errors, static::testIblock());

		return $errors;
	}

	/**
	 * @return string[]
	 * @throws \Bitrix\Main\LoaderException
	 */
	protected static function testModule()
	{
		$errors = [];
		if (!Loader::includeModule('bitrix.sitecorporate')) {
			$errors [] = Loc::getMessage('INTERVOLGA_EDU.MODULE_SITECORPORATE_NOT_INSTALLED');
		}

		return $errors;
	}

	/**
	 * @return string[]
	 */
	protected static function testPublic()
	{
		$errors = [];
		$paths = [
			'/company/mission.php',
			'/company/management.php',
		];
		foreach ($paths as $path) {
			if (!File::isFileExists(Application::getDocumentRoot() . $path)) {
				$errors[] = Loc::getMessage('INTERVOLGA_EDU.PAGE_NOT_FOUND', ['#PAGE#' => $path]);
			}
		}

		return $errors;
	}

	/**
	 * @return string[]
	 * @throws \Bitrix\Main\ArgumentException
	 * @throws \Bitrix\Main\LoaderException
	 * @throws \Bitrix\Main\ObjectPropertyException
	 * @throws \Bitrix\Main\SystemException
	 */
	protected static function testIblock()
	{
		$errors = [];
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
				$errors[] = Loc::getMessage('INTERVOLGA_EDU.IBLOCKS_NOT_FOUND', ['#CODES#' => implode(', ', array_diff($codes, $foundCodes))]);
			}
		}

		return $errors;
	}
}