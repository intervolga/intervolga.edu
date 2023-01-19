<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use CGroup;
use CIBlock;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\PromoIblock;
use Intervolga\Edu\Tests\BaseTest;

class PermissionChecker extends BaseTest
{
	protected static function run()
	{
		Loader::includeModule('iblock');

		$permission = CIBlock::GetGroupPermissions(PromoIblock::find()['ID']);
		$groupPartnersId = CGroup::GetList(false, false, ['STRING_ID' => 'partners'])->fetch()['ID'];

		Assert::notEmpty($groupPartnersId, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_STRING_ID_PARTNERS'));
		Assert::eq($permission[$groupPartnersId], 'W', Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_GROUP_PARTNERS_PERMISSONS'));

	}
}