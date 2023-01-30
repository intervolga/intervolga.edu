<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

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
		$regexStr = '/src\s*=\s*"(?<SRC>[^"]+)"/m';
		$regex = new Regex(
			$regexStr,
			'<img src="...">'
		);
		Assert::fileContentMatches($indexFile, $regex);
		if ($content) {
			preg_match_all($regexStr, $content, $matches, PREG_SET_ORDER);
			if ($matches && $matches[0] && $matches[0]['SRC']) {
				$src = $matches[0]['SRC'];
				$img = FileSystem::getFile($src);
				Assert::fseExists($img);
				Assert::isImage($img);
			}
		}
	}
}