<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Sniffer;

abstract class BaseTestGoodCode extends BaseTest
{
	protected static function run()
	{
		$files = static::getFilesPaths();
		$result = Sniffer::run($files);

		if (!empty($result)) {
			foreach ($result as $error) {
				Assert::empty($error, $error->getMessage());
			}
		}

	}

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

	static function getFilesLoc(): string
	{
		$code = 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode()) . '_' . mb_strtoupper(static::getTestCode()) . '_FILES';
		if (Loc::getMessage($code)) {
			return Loc::getMessage($code);
		} else {
			return '&lt;' . $code . '&gt;';
		}
	}

	abstract static function getFilesPaths(): array;

}