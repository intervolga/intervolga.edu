<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestPartnersPage extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryLocator(PartnersSection::class);
		$directory = PartnersSection::find();
		if ($directory) {
			$indexFile = FileSystem::getInnerFile($directory, 'index.php');
			Assert::fileContentMatches(
				$indexFile,
				new Regex('/<img/i', Loc::getMessage('INTERVOLGA_EDU.IMG_TAG'))
			);
			static::imgExistChecker($indexFile);

			Assert::fileContentMatches(
				$indexFile,
				new Regex('/<table/i', Loc::getMessage('INTERVOLGA_EDU.TABLE_TAG'))
			);
			Assert::fileContentMatches(
				$indexFile,
				new Regex('/\/upload\//i', Loc::getMessage('INTERVOLGA_EDU.UPLOAD_PATH'))
			);
		}
	}

	protected static function imgExistChecker(File $indexFile)
	{
		$content = $indexFile->getContents();
		if ($content) {
			preg_match_all('/<img\s*src=\"[\w\s\/\.]*\"/i', $content, $matches, PREG_SET_ORDER);
			$fileImg['path'] = mb_strcut($matches[0][0], mb_stripos($matches[0][0], '"') + 1, -1);
			$img = new File(Application::getDocumentRoot() . $fileImg['path']);

			Assert::true($img->isExists(), Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_FILE_NOT_EXIST',
				['#FILE_PATH#' => $fileImg['path']]));

			if ($img->isExists()) {
				Assert::matches($fileImg['type'], new Regex('/image/i', ''),
					Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_FILE_NOT_IMG', [
						'#FILE_PATH#' => $fileImg['path'],
						'#FILE_TYPE#' => $fileImg['type']
					]));
			}
		}
	}
}