<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\AssertPhp;

abstract class BaseTestCode extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	public static function getTestLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_CODE_NAME', [
			'#FILES#' => static::getFilesLoc(),
		]);
	}

	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_CODE_DESCRIPTION');
	}

	/**
	 * @return File[];
	 */
	abstract static function getFilesToTestCode(): array;

	static function getFilesLoc(): string
	{
		$code = 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode()) . '_' . mb_strtoupper(static::getTestCode()) . '_FILES';
		if (Loc::getMessage($code)) {
			return Loc::getMessage($code);
		} else {
			return '&lt;' . $code . '&gt;';
		}
	}

	protected static function run()
	{
		$files = static::getFilesToTestCode();
		foreach ($files as $file) {
			AssertPhp::goodCode($file);
		}
	}
}