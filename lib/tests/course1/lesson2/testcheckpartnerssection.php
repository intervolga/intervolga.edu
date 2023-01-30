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
use Intervolga\Edu\Util\Regex;

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
		Assert::fseExists($indexFile, Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_PARTNERS_DIRECTORY_PAGE'));
		Assert::fileContentMatches(
			$indexFile,
			new Regex('/SetTitle\((\'|")\s*Условия\s*сотрудничества\s*(\'|")/iu', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_TITLE_PARTNERS'))
		);
	}

	protected static function checkSection(Directory $directory)
	{
		Assert::directoryLocator(PartnersEventsSection::class);

		$section = PartnersEventsSection::find();
		$sectionFile = FileSystem::getInnerFile($section, 'index.php');
		Assert::fseExists($sectionFile, Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_PARTNERS_EVENTS_DIRECTORY_PAGE'));
		Assert::fileContentMatches(
			$sectionFile,
			new Regex('/SetTitle\((\'|")\s*Расписание\s*мероприятий\s*(\'|")/iu', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_TITLE_EVENTS'))
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

		Assert::eq(
			$links[FileSystem::getLocalPath($sectionEvents)],
			Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_PARTNERS_EVENT_PAGE')
		);
	}
}