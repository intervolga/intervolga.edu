<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\HowBecomePartner;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\StructureService;

class TestSeoPartners extends BaseTest
{
	const MIN_KEYWORDS_COUNT = 3;

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryLocator(PartnersSection::class);
		if ($directory = PartnersSection::find()) {
			static::checkPartnersSection($directory);

			Assert::fileLocator(HowBecomePartner::class);
			if ($directoryPage = HowBecomePartner::find()) {
				static::checkHowBecomePartner($directoryPage);
			}

			static::checkLeftMenu($directory);
		}
	}

	protected static function checkPartnersSection(Directory $directory)
	{
		$directoryProperties = StructureService::getDirProperties($directory);
		$keywordsCount = count(explode(',', $directoryProperties['KEYWORDS']));
		Assert::greaterEq(
			$keywordsCount,
			static::MIN_KEYWORDS_COUNT,
			Loc::getMessage(
				'INTERVOLGA_EDU.COURSE_1_LESSON_2_KEYWORDS',
				[
					'#FILEMAN_URL#' => Admin::getFileManUrl($directory),
				]
			)
		);
		Assert::notEmpty(
			$directoryProperties['DESCRIPTION'],
			Loc::getMessage(
				'INTERVOLGA_EDU.COURSE_1_LESSON_2_DESCRIPTION',
				[
					'#FILEMAN_URL#' => Admin::getFileManUrl($directory),
				]
			)
		);
	}

	protected static function checkHowBecomePartner(File $directoryPage)
	{
		$directoryPageProperties = StructureService::getPageProperties($directoryPage);
		$keywordsPageCount = count(explode(',', $directoryPageProperties['KEYWORDS']));
		Assert::greaterEq(
			$keywordsPageCount,
			static::MIN_KEYWORDS_COUNT,
			Loc::getMessage(
				'INTERVOLGA_EDU.COURSE_1_LESSON_2_KEYWORDS_PAGE_BECOME_PARTNERS',
				[
					'#FILEMAN_URL#' => Admin::getFileManUrl($directoryPage),
				]
			)
		);
		Assert::notEmpty(
			$directoryPageProperties['DESCRIPTION'],
			Loc::getMessage(
				'INTERVOLGA_EDU.COURSE_1_LESSON_2_DESCRIPTION_PAGE_BECOME_PARTNERS',
				[
					'#FILEMAN_URL#' => Admin::getFileManUrl($directoryPage),
				]
			)
		);
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

	protected static function checkLeftMenu(Directory $directory)
	{
		$leftMenuFile = FileSystem::getInnerFile($directory, '.left.menu.php');
		Assert::fseExists($leftMenuFile);
		if ($leftMenuFile->isExists()) {
			Assert::menuItemExists(FileSystem::getLocalPath($leftMenuFile), FileSystem::getLocalPath(HowBecomePartner::find()));
		}
	}
}