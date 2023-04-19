<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\PartnersEventsSection;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\StructureService;

Loc::loadMessages(__FILE__);

class TestCheckPartnersSection extends BaseTest
{
	public static function run()
	{
		Assert::directoryLocator(PartnersSection::class);
		if ($directory = PartnersSection::find()) {
			static::checkIndexFile($directory);
			static::checkSection($directory);
		}
	}

	protected static function checkIndexFile(Directory $directory)
	{
		$indexFile = FileSystem::getInnerFile($directory, 'index.php');
		Assert::fseExists($indexFile, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_DIRECTORY_PAGE'));
		$directoryPageProperties = StructureService::getPageTitle($indexFile);
		$title = StructureService::getPageProperties($indexFile)['TITLE'];

		Assert::eq(
			$directoryPageProperties,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_PARTNERS_REQUIRED_TITLE'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_TITLE_PARTNERS',
				[
					'#VALUE#' => $directoryPageProperties ?: Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_EMPTY_STRING')
				])
		);
		Assert::eq(
			$title,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_PARTNERS_REQUIRED_TITLE'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_TITLE_PARTNERS_PAGE',
				[
					'#VALUE#' => $title ?: Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_EMPTY_STRING')
				])
		);
	}

	protected static function checkSection(Directory $directory)
	{
		Assert::directoryLocator(PartnersEventsSection::class);

		$section = PartnersEventsSection::find();
		$sectionFile = FileSystem::getInnerFile($section, 'index.php');
		Assert::fseExists($sectionFile, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PARTNERS_EVENTS_DIRECTORY_PAGE'));
		$directoryPartnersEvent = StructureService::getPageTitle($sectionFile);
		$title = StructureService::getPageProperties($sectionFile)['TITLE'];

		Assert::eq(
			$directoryPartnersEvent,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_PARTNERS_EVENTS_DIRECTORY'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_TITLE_EVENTS',
				[
					'#VALUE#' => $directoryPartnersEvent ?: Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_EMPTY_STRING')
				]
			)
		);
		Assert::eq(
			$title,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_PARTNERS_EVENTS_DIRECTORY'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_TITLE_EVENTS_PAGE',
				[
					'#VALUE#' => $title ?: Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_EMPTY_STRING')
				]
			)
		);

		static::checkSectionMenu($directory, $section);
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
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_PARTNERS_EVENTS_DIRECTORY'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_PARTNERS_EVENTS_DIRECTORY_WRONG_NAME')
		);
	}
}