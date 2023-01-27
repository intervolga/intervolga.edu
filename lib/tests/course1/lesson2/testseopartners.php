<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\HowBecomePartner;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\StructureService;

class TestSeoPartners extends BaseTest
{
	const MIN_KEYWORDS_COUNT = 2;

	protected static function run()
	{
		Assert::directoryLocator(PartnersSection::class);
		$directory = PartnersSection::find();
		static::checkPartnersSection($directory);

		Assert::fileLocator(HowBecomePartner::class);
		$directoryPage = HowBecomePartner::find();
		static::checkHowBecomePartner($directoryPage);

		$links = static::getDirectoryLeftMenu($directory);
		Assert::notEmpty($links, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_LEFT_MENU', ['#DIRECTORY_NAME#' => $directory->getName()]));
		Assert::eq(
			$links[$directory->getName() . $directoryPage->getName()],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_HOW_BECOME_PAGE')
		);

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
		$keywordsPage = substr_count($directoryPageProperties['keywords'], ',');
		Assert::greaterEq($keywordsPage, static::MIN_KEYWORDS_COUNT, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_KEYWORDS_PAGE_BECOME_PARTNERS'));
		Assert::eq($directoryPageProperties['title'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_HOW_BECOME_PAGE'));
		Assert::notEmpty($directoryPageProperties['description'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_DESCRIPTION_PAGE_BECOME_PARTNERS'));

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