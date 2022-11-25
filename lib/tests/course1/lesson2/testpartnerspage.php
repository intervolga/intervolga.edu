<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Fileset;
use Intervolga\Edu\Util\Regex;

class TestPartnersPage extends BaseTest
{
	public static function run()
	{
		$possibleDirectories = TestPartners::getPossibleDirectories();
		$fileset = new Fileset();
		foreach ($possibleDirectories as $possibleDirectory) {
			if ($possibleDirectory->isExists()) {
				$indexPath = $possibleDirectory->getPath() . '/index.php';
				$indexFile = new File($indexPath);
				if ($indexFile->isExists()) {
					$fileset->add($indexFile);
				}
			}
		}

		$regexes = [
			new Regex('/<img/i', '<img>', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_IMG_TAG')),
			new Regex('/<table/i', '<table>', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_TABLE_TAG')),
			new Regex('/\/upload\//i', '/upload/', Loc::getMessage('INTERVOLGA_EDU.UPLOAD_SRC')),
		];
		static::testFilesetContentNotFoundByRegex($fileset, $regexes, Loc::getMessage('INTERVOLGA_EDU.CUSTOM_CORE_CHECK'));
	}
}