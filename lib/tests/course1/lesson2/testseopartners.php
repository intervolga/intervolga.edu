<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\HowBecomePartner;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\StructureService;

class TestSeoPartners extends BaseTest
{
	const MIN_KEYWORDS_COUNT = 2;

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryLocator(PartnersSection::class);
		if ($directory = PartnersSection::find()) {
			static::checkPartnersSection($directory);

			$leftMenuFile = FileSystem::getInnerFile($directory, '.left.menu.php');

			Assert::fseExists($leftMenuFile);
			if ($leftMenuFile->isExists())
			{
				$links = static::getDirectoryLeftMenu($directory);
				Assert::menuItemExists(FileSystem::getLocalPath($leftMenuFile), FileSystem::getLocalPath(HowBecomePartner::find()));
				if ($menuItemName = $links[FileSystem::getLocalPath(HowBecomePartner::find())]) {
					Assert::eq(
						$menuItemName,
						Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_HOW_BECOME_PAGE')
					);
				}
			}

			Assert::fileLocator(HowBecomePartner::class);
			if ($directoryPage = HowBecomePartner::find()) {
				static::checkHowBecomePartner($directoryPage);
			}
		}
	}

	protected static function checkPartnersSection(Directory $directory)
	{
		$directoryProperties = StructureService::getDirProperties($directory);
		$keywords = substr_count($directoryProperties['KEYWORDS'], ',');
		Assert::greaterEq($keywords, static::MIN_KEYWORDS_COUNT, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_KEYWORDS'));
		Assert::notEmpty($directoryProperties['DESCRIPTION'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_DESCRIPTION'));
	}

	protected static function checkHowBecomePartner(File $directoryPage)
	{
		$directoryPageProperties = StructureService::getPageProperties($directoryPage);
		$keywordsPage = substr_count($directoryPageProperties['KEYWORDS'], ',');
		Assert::greaterEq($keywordsPage, static::MIN_KEYWORDS_COUNT, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_KEYWORDS_PAGE_BECOME_PARTNERS'));
		Assert::eq($directoryPageProperties['TITLE'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_HOW_BECOME_PAGE'));
		Assert::notEmpty($directoryPageProperties['DESCRIPTION'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_DESCRIPTION_PAGE_BECOME_PARTNERS'));
	}

	protected static function getDirectoryLeftMenu(Directory $directory)
	{
		$links = Menu::getMenuLinks('/' . $directory->getName() . '/.left.menu.php');
		foreach ($links as $key => $link) {
			$key = preg_replace('/\//', '', $key);
			$links[$key] = $link;
		}

		return $links;
	}
}