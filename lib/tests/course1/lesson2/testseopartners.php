<?php

namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\HowBecomePartner;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestSeoPartners extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(PartnersSection::class);

		$directory = PartnersSection::find();
		if ($directory) {
			$sectionFile = FileSystem::getInnerFile($directory, '.section.php');
			Assert::fseExists($sectionFile);
			Assert::fileContentMatches(
				$sectionFile,
				new Regex('/keywords(\'|")\s*=>\s*(\'|")\s*\w*,\s*\w*,/iu', Loc::getMessage('INTERVOLGA_EDU.KEYWORDS'))
			);
			Assert::fileContentMatches(
				$sectionFile,
				new Regex('/description(\'|")\s*=>\s*(\'|")[\s*\w*]+/iu', Loc::getMessage('INTERVOLGA_EDU.DESCRIPTION'))
			);
		}

		$directoryPage = HowBecomePartner::find();
		Assert::fseExists($directoryPage);
		if ($directoryPage) {
			Assert::fileContentMatches(
				$directoryPage,
				new Regex('/SetPageProperty\s*\((\'|")\s*description\s*(\'|")\s*,\s*(\'|")[\s\w]+/iu', Loc::getMessage('INTERVOLGA_EDU.DESCRIPTION_PAGE_BECOME_PARTNERS'))
			);
			Assert::fileContentMatches(
				$directoryPage,
				new Regex('/SetPageProperty\s*\((\'|")\s*keywords\s*(\'|")\s*,\s*(\'|")\s*\w*,\s*\w*/iu', Loc::getMessage('INTERVOLGA_EDU.KEYWORDS_PAGE_BECOME_PARTNERS'))
			);
		}
	}
}