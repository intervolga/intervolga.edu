<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\IncludeAreaFile;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Locator\IO\NewsSection;
use Intervolga\Edu\Locator\IO\CompanySection;
use Intervolga\Edu\Locator\IO\CatalogSection;
use Intervolga\Edu\Util\FileMessage;

class TestLackIncludeArea extends BaseTest
{
	protected static function run()
	{
		$sections = [
			NewsSection::class,
			CompanySection::class,
			CatalogSection::class
		];
		foreach ($sections as $section) {
			$path = IncludeAreaFile::find(File::class, $section);
			if ($path != null) {
				$file = new File($path->getPath());
				$fileMessage = FileMessage::get($file);
				Assert::Custom(Loc::getMessage('INTERVOLGA_EDU.SECT_FILE_EXISTS', [
					'#FILE#' => $fileMessage
				]));
			}
		}
	}

	public static function interceptErrors()
	{
		return true;
	}
}
