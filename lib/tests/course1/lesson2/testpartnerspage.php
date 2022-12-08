<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

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
}