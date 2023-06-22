<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\CustomVacanciesList;
use Intervolga\Edu\Locator\IO\VacanciesListComponent;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestHermitageInComponent extends BaseTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(CustomVacanciesList::class);
		Assert::directoryLocator(VacanciesListComponent::class);
		if ($directory = VacanciesListComponent::find()) {
			$file = FileSystem::getInnerFile($directory, 'component.php');

			Assert::fileContentNotMatches($file, new Regex('/CIBlock::GetPanelButtons{2,}/i',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.HERMITAGE_BUTTONS')));
		}
	}
}