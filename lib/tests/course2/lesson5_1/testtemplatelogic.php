<?php

namespace Intervolga\Edu\Tests\Course2\Lesson5_1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\CustomVacanciesList;
use Intervolga\Edu\Locator\IO\ComponentTemplate\VacanciesListTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestTemplateLogic extends BaseTest
{
	const REG_FOREACH = '/foreach[\w\s\d()$[\]\'";:,?><\/*-={!}]*[^d]foreach/iu';

	protected static function run()
	{
		AssertComponent::componentLocator(CustomVacanciesList::class);
		Assert::directoryLocator(VacanciesListTemplate::class);
		if ($directory = VacanciesListTemplate::find()) {
			$file = FileSystem::getInnerFile($directory, 'template.php');
			Assert::fseExists($file);
			if ($file->isExists()) {
				Assert::fileContentMatches($file, new Regex(static::REG_FOREACH,
					Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.FOREACH_COUNT')));
			}
		}
	}
}