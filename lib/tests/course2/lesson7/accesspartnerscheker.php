<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\AccessFile;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\GroupUserList;

class AccessPartnersCheker extends BaseTest
{
	protected static function run()
	{
		$groupPartnersId = key(GroupUserList::getGroupList([
			'STRING_ID' => 'partners',
		]));
		Assert::notEmpty($groupPartnersId, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_STRING_ID_PARTNERS'));
		include_once AccessFile::find()->getPath();
		Assert::eq($PERM['partners']['*'], 'D', Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ACCESS_FOR_ALL'));
		Assert::eq($PERM['partners']['G' . $groupPartnersId], 'R', Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ACCESS_FOR_PARTNERS'));

	}
}