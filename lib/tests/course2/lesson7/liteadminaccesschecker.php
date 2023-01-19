<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use CGroup;
use CIBlock;
use CMain;
use CTask;
use CUser;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\AccessFile;
use Intervolga\Edu\Tests\BaseTest;

class LiteadminAccessChecker extends BaseTest
{

	protected static function run()
	{
		/* проверка уровней доступа для группы Контент-редакторы */
		$group = CGroup::GetList(false, false, ['STRING_ID' => 'content_editor'])->fetch();
		Assert::notEmpty($group, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_EDITOR_GROUP_NOT_FOUND'));


		static::checkAccessLevel($group, 'main', 'Q');
		static::checkAccessLevel($group, 'fileman', 'F');
		static::checkAccessForContentEditorGroup($group);

		/* проверка доступа для групп пользователей имеющихся инфоблоков */
		static::checkAccessIblocks($group);

		/* проверка на доступ к редактированию всех разделов сайта */
		include_once AccessFile::find()->getPath();
		Assert::eq($PERM["/"]['G' . $group['ID']], "W", 'Группа "Контент-редакторы" должны иметь право на редактирование всех разделов сайта');

		/* пользователь в группе */
		Assert::true(in_array(CUser::GetByLogin('liteadmin')->fetch()['ID'], CGroup::GetGroupUser($group['ID'])),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_USER_NOT_FOUND_IN_GROUP', ['#GROUP_NAME#' => $group['NAME']]));

	}

	private static function checkAccessForContentEditorGroup($group)
	{
		$idTask = CGroup::GetModulePermission($group['ID'], 'main');
		$operations = CTask::GetOperations($idTask, true);
		Assert::true(in_array('lpa_template_edit', $operations), Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_CHECK_GROUP_NOT_EXPECT_ACCESS', [
			'#ACCESS_NAME#' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ACCESS_FOR_EDITOR_LPA_TEMPLATE_EDIT'),
			'#GROUP_NAME#' => $group['NAME']
		]));
		Assert::true(in_array('edit_php', $operations), Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_CHECK_GROUP_NOT_EXPECT_ACCESS', [
			'#ACCESS_NAME#' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ACCESS_FOR_EDITOR_EDIT_PHP'),
			'#GROUP_NAME#' => $group['NAME']
		]));

	}

	private static function checkAccessLevel($group, $module_id, $expectPermissions)
	{

		Assert::eq(CMain::GetUserRight($module_id, [$group['ID']]), $expectPermissions,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_CHECK_GROUP_ACCESS_NOT_EXPECT_VALUE', [
			'#GROUP_NAME#' => $group['NAME'],
			'#MODULE_NAME#' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_MODULE_LOC_' . mb_strtoupper($module_id)),
			'#EXPECT_VALUE#' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_EXPECT_ACCESS_LOC_' . mb_strtoupper($module_id))
		]));

	}

	private static function checkAccessIblocks($group)
	{
		Loader::includeModule('iblock');
		foreach (INTERVOLGA_EDU_USES_BLOCKS as $iblock) {
			Assert::iblockLocator($iblock);
			Assert::eq(CIBlock::GetGroupPermissions($iblock::find()['ID'])[$group['ID']], 'W', Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_CHECK_IBLOCK_ACCESS', [
				'#IBLOCK#' => $iblock::getNameLoc(),
				'#GROUP_NAME#' => $group['NAME']
			]));
		}
	}

}