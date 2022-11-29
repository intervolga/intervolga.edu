<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\PathMask;
use Intervolga\Edu\Util\Regex;

class TestUglyCheckResult extends BaseTest
{
	public static function run()
	{
		$files = PathMask::getFileSystemEntriesByMasks(
			[
				'/local/templates/*/components/bitrix/*/*.php',
				'/local/templates/*/components/bitrix/*/*/*.php',
				'/local/templates/*/components/bitrix/*/*/*/*.php',
			]
		);
		$regexes = [
			new Regex(
				'/if \(!empty\(\$arResult\)\)/mi',
				'if (!empty($arResult))',
				Loc::getMessage('INTERVOLGA_EDU.UGLY_RESULT_CHECK_FOUND', ['#NEW#' => 'if ($arResult)'])
			),
			new Regex(
				'/if \(empty\(\$arResult\)\)/mi',
				'if (empty($arResult))',
				Loc::getMessage('INTERVOLGA_EDU.UGLY_RESULT_CHECK_FOUND', ['#NEW#' => 'if (!$arResult)'])
			),
		];
		static::registerErrorIfFileContentFoundByRegex($files, $regexes);
	}
}