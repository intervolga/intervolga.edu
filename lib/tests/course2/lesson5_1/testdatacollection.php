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

class TestDataCollection extends BaseTest
{
	const REG_GET_LIST_CIBlockSection = '/(foreach|while)+\s*([\w\s\d$=\-:()[\]\.;,><\'\"]*\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*(\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*\})*|[\w\s\d{$=\-:()[\]\.;,><\'\"])*CIBlockSection::getList\(/i';
	const REG_GET_LIST_CIBlockElement = '/(foreach|while)+\s*([\w\s\d$=\-:()[\]\.;,><\'\"]*\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*(\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*\})*|[\w\s\d{$=\-:()[\]\.;,><\'\"])*CIBlockElement::getList\(/i';

	protected static function run()
	{
		AssertComponent::componentLocator(CustomVacanciesList::class);
		Assert::directoryLocator(VacanciesListComponent::class);
		if ($directory = VacanciesListComponent::find()) {
			$file = FileSystem::getInnerFile($directory, 'component.php');

			Assert::fileContentNotMatches($file, new Regex(static::REG_GET_LIST_CIBlockSection,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.REG_GET_LIST_CIBlockSection')));
			Assert::fileContentNotMatches($file, new Regex(static::REG_GET_LIST_CIBlockElement,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.REG_GET_LIST_CIBlockElement')));
		}
	}
}