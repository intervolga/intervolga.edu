<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;
use Intervolga\Edu\Util\Registry\Directory\PartnersDirectory;

class TestPartnersPage extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::registryDirectiry(PartnersDirectory::class);
		$directory = PartnersDirectory::find();
		$indexPath = $directory->getPath() . '/index.php';
		$indexFile = new File($indexPath);
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