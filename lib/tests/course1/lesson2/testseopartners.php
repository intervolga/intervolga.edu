<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\HowBecomePartner;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\PageProperties;

class TestSeoPartners extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(PartnersSection::class);

		$directory = PartnersSection::find();
		$directoryProperties = PageProperties::GetDirProperties($directory);
		$keywords = substr_count($directoryProperties['KEYWORDS'], ',');
		Assert::greaterEq($keywords, 2, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_KEYWORDS'));

		Assert::notEmpty($directoryProperties['DESCRIPTION'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_DESCRIPTION'));

		Assert::fileLocator(HowBecomePartner::class);
		$directoryPage = HowBecomePartner::find();
		$directoryPageProperties = PageProperties::GetPageProperties($directoryPage);
		$keywordsPage = substr_count($directoryPageProperties['keywords'], ',');
		Assert::greaterEq($keywordsPage, 2, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_KEYWORDS_PAGE_BECOME_PARTNERS'));

		Assert::eq($directoryPageProperties['title'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_HOW_BECOME_PAGE'));

		Assert::notEmpty($directoryPageProperties['description'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_DESCRIPTION_PAGE_BECOME_PARTNERS'));

		$links = Menu::getMenuLinks('/' . $directory->getName() . '/.left.menu.php');

		foreach ($links as $key => $link) {
			$key = preg_replace('/\//', '', $key);
			$links[$key] = $link;
		}

		Assert::eq(
			$links[$directory->getName() . $directoryPage->getName()],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_HOW_BECOME_PAGE')
		);

	}
}