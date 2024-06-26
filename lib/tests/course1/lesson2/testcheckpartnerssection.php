<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\PartnersEventsSection;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\StructureService;

Loc::loadMessages(__FILE__);

class TestCheckPartnersSection extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	public static function run()
	{
		Assert::directoryLocator(PartnersSection::class);
		if ($directory = PartnersSection::find()) {
			static::checkTitles($directory, 'partners');
			Assert::directoryLocator(PartnersEventsSection::class);
			if ($section = PartnersEventsSection::find()) {
				static::checkTitles($section, 'events');
				static::checkSectionMenu($directory, $section);
			}
		}
	}

	protected static function checkTitles(Directory $directory, string $directoryName)
	{
		$indexFile = FileSystem::getInnerFile($directory, 'index.php');

		Assert::fseExists($indexFile, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_' . mb_strtoupper($directoryName) . '_DIRECTORY_PAGE'));
		$title = StructureService::getPageTitle($indexFile);
		$browserTitle = StructureService::getPageProperties($indexFile)['TITLE'];

		Assert::eq(
			$title,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_' . mb_strtoupper($directoryName) . '_REQUIRED_TITLE'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_TITLE_' . mb_strtoupper($directoryName),
				[
					'#VALUE#' => $title ?: Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_EMPTY_STRING'),
				])
		);
		Assert::eq(
			$browserTitle,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_' . mb_strtoupper($directoryName) . '_REQUIRED_TITLE'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_TITLE_' . mb_strtoupper($directoryName) . '_PAGE',
				[
					'#VALUE#' => $browserTitle ?: Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_EMPTY_STRING'),
				])
		);
	}

	protected static function checkSectionMenu(Directory $directory, Directory $sectionEvents)
	{
		$links = Menu::getMenuLinks(FileSystem::getLocalPath(FileSystem::getInnerFile($directory, '.left.menu.php')));

		foreach ($links as $key => $link) {
			$key = preg_replace('/\//', '', $key);
			$links[$key] = $link;
		}

		Assert::menuItemExists(
			FileSystem::getLocalPath(FileSystem::getInnerFile($directory, '.left.menu.php')),
			FileSystem::getLocalPath($sectionEvents)
		);
		Assert::eq(
			$links[FileSystem::getLocalPath($sectionEvents)],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_EVENTS_REQUIRED_TITLE'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_PARTNERS_EVENTS_DIRECTORY_WRONG_NAME')
		);
	}
}