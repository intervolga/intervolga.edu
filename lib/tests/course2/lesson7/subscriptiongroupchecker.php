<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use CGroup;
use CMain;
use CUser;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class SubscriptionGroupChecker extends BaseTest
{
	protected static function run()
	{
		$group = CGroup::GetList(false, false, ['STRING_ID' => 'subscription'])->fetch();
		Assert::notEmpty($group, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_SUBSCRIBE_GROUP_NOT_FOUND'));
		Assert::eq(CMain::GetUserRight('subscribe', [$group['ID']]), 'W', '');
		Assert::true(in_array(CUser::GetByLogin('liteadmin')->fetch()['ID'], CGroup::GetGroupUser($group['ID'])),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_USER_NOT_FOUND_IN_GROUP', ['#GROUP_NAME#' => $group['NAME']]));
	}

}