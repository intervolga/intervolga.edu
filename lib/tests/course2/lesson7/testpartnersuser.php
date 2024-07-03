<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\Date;
use CGroup;
use CUser;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\GroupUserList;

class TestPartnersUser extends BaseTest
{
	protected static function run()
	{
		$groupPartnersId = CGroup::GetList(false, false, ['STRING_ID' => 'partners'])->fetch()['ID'];
		Assert::notEmpty($groupPartnersId, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_STRING_ID_PARTNERS'));

		$arUsers = CUser::GetList(
			false,
			false,
			[
				'ACTIVE' => 'Y',
				'GROUPS_ID' => [$groupPartnersId],
				'LAST_LOGIN_1' => (new Date(null, 'd.m.Y'))->add('-30 days'),
				'LAST_LOGIN_2' => new Date(null, 'd.m.Y'),
			],
		);

		Assert::notEmpty($arUsers->SelectedRowsCount(), Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_USERS_PARTNERS'));
	}
}