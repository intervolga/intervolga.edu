<?php

namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use CGroup;
use CMain;
use CUser;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestProfileGroupEditCheker extends BaseTest
{
	protected static function run()
	{
		$group = CGroup::GetList(false, false, ['STRING_ID' => 'partners_profile_edit'])->fetch();

		Assert::notEmpty($group, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_EDIT_PARTNERS_GROUP_NOT_FOUND'));

		Assert::eq(CMain::GetUserRight('main', [$group['ID']]), 'V',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_GROUP_SETTINGS_EDITOR', ['#GROUP_NAME#' => $group['NAME']]));
		Assert::true(in_array(CUser::GetByLogin('liteadmin')->fetch()['ID'], CGroup::GetGroupUser($group['ID'])),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_USER_NOT_FOUND_IN_GROUP', ['#GROUP_NAME#' => $group['NAME']]));
	}

}