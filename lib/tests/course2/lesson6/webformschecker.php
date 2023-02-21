<?php
namespace Intervolga\Edu\Tests\Course2\Lesson6;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use CForm;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class WebFormsChecker extends BaseTest
{
	const COUNT_QUESTIONS = 5;

	protected static function run()
	{
		Loader::includeModule('form');
		$formsList = CForm::GetList()->fetch();
		Assert::notEmpty($formsList, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6.NOT_FOUND_FORM'));

		Assert::greaterEq($formsList['QUESTIONS'], static::COUNT_QUESTIONS,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6.COUNT_QUESTIONS',
				[
					'#ID_FORM#' => $formsList['ID'],
					'#EXPECT#' => static::COUNT_QUESTIONS,
					'#COUNT#' => $formsList['QUESTIONS']
				]
			)
		);
	}
}