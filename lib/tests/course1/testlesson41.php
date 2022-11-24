<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Tests\Filesets\FilesetBuilder;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

Loc::loadMessages(__FILE__);

class TestLesson41 extends BaseTest
{
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COURSE_1_LESSON_4_1');
	}

	public static function run()
	{
		// USE_EXT в bitrix:menu
		// local/templates/.default/components/bitrix/menu/vertical_multilevel/lang/*/
		static::testImagesInComponents();
		static::testUglyCheckResult();
	}

	protected static function testImagesInComponents()
	{
		$fileset = FilesetBuilder::getLocalTemplatesComponentsInner(true, false);
		$regex = '/\/menu\/.*\/images/ui';	// /menu/*/images/

		static::testFilesetToBeDeleted($fileset, $regex, Loc::getMessage('INTERVOLGA_EDU.IMAGES_DELETE_REASON'));
	}

	protected static function testUglyCheckResult()
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