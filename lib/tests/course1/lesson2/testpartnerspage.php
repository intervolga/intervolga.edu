<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;
use Intervolga\Edu\Util\Registry\Directory\PartnersDirectory;

class TestPartnersPage extends BaseTest
{
	public static function run()
	{
		$directory = PartnersDirectory::find();
		if ($directory) {
			$indexPath = $directory->getPath() . '/index.php';
			$indexFile = new File($indexPath);
			if ($indexFile->isExists()) {
				$files[] = $indexFile;
			}
		}

		$regexes = [
			new Regex('/<img/i', '<img>', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_IMG_TAG')),
			new Regex('/<table/i', '<table>', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_TABLE_TAG')),
			new Regex('/\/upload\//i', '/upload/', Loc::getMessage('INTERVOLGA_EDU.UPLOAD_SRC')),
		];
		static::registerErrorIfFileContentNotFoundByRegex($files, $regexes, Loc::getMessage('INTERVOLGA_EDU.CUSTOM_CORE_CHECK'));
	}
}