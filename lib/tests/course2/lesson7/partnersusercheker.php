<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use CUser;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\GroupUserList;

class PartnersUserCheker extends BaseTest
{
	protected static function run()
	{
		$groupPartnersId = key(GroupUserList::getGroupList([
			'STRING_ID' => 'partners',
		]));
		Assert::notEmpty($groupPartnersId, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_STRING_ID_PARTNERS'));

		$arUsers = CUser::GetList(
			false,
			false,
			[
				'ACTIVE' => 'Y',
				'GROUPS_ID' => [$groupPartnersId],
				'LAST_LOGIN_1' => date('d.m.Y', strtotime("-30 days")),
				'LAST_LOGIN_2' => date('d.m.Y'),

			],

		);

		while ($rows = $arUsers->fetch()) {
			$users = $rows;
		}

		Assert::notEmpty($users, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_USERS_PARTNERS'));

	}
}