<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestUglyCheckResult extends BaseTest
{
	public static function run()
	{
		$componentsToCheck = [
			'/local/templates/',
			[
				'main/',
				'.default/',
				'inner/'
			],
			'components/bitrix/',
		];

		$combo = FileSystem::getComboEntries($componentsToCheck);
		$files = FileSystem::getFilesRecursiveByPathRegex($combo, '/\.php/m');
		foreach ($files as $file) {
			$contents = $file->getContents();
			if (mb_substr_count($contents, 'if (!empty($arResult))'))
			{
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.UGLY_RESULT_CHECK_FOUND', [
					'#PATH#' => $file->getName(),
					'#ADMIN_LINK#' => Admin::getFileManUrl($file),
				]));
			}
		}
	}
}