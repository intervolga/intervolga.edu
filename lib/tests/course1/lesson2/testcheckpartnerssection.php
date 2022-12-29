<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\Regex;

class TestCheckPartnersSection extends BaseTest
{
	public static function run()
	{
		Assert::directoryLocator(PartnersSection::class);
		$directory = PartnersSection::find();
		if ($directory) {
			$indexFile = FileSystem::getInnerFile($directory, 'index.php');
			Assert::fseExists($indexFile, Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_PARTNERS_DIRECTORY_PAGE'));
			Assert::fileContentMatches(
				$indexFile,
				new Regex('/SetTitle\((\'|")\s*Условия\s*сотрудничества\s*(\'|")/iu', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_TITLE_PARTNERS'))
			);

			$sectionName = static::getPossibleSectionName($directory);
			$section = FileSystem::getInnerDirectory($directory, $sectionName);
			Assert::directoryExists($section);
			$sectionFile = FileSystem::getInnerFile($section, 'index.php');
			Assert::fseExists($sectionFile, Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_PARTNERS_EVENTS_DIRECTORY_PAGE'));
			Assert::fileContentMatches(
				$sectionFile,
				new Regex('/SetTitle\((\'|")\s*Расписание\s*мероприятий\s*(\'|")/iu', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_TITLE_EVENTS'))
			);

			$links = Menu::getMenuLinks('/' . $directory->getName() . '/.left.menu.php');

			foreach ($links as $key => $link) {
				$key = preg_replace('/\//', '', $key);
				$links[$key] = $link;
			}

			Assert::eq(
				$links['partners' . $sectionName],
				Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_PARTNERS_EVENT_PAGE')
			);

		}

	}

	protected static function getPossibleSectionName($directory)
	{
		$names = [
			'event',
			'include',
			'events',
			'schedule-of-event',
			'schedule-of-events'
		];

		foreach ($directory->getChildren() as $child) {
			if ($child->isDirectory()) {
				if (in_array($child->getName(), $names)) {
					return $child->getName();
				}
			}
		}

		return false;
	}

}