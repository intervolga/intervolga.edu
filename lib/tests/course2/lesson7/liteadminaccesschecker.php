<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use CGroup;
use CIBlock;
use CTask;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\AccessFile;
use Intervolga\Edu\Tests\BaseTest;

class LiteadminAccessChecker extends BaseTest
{
	const arrayPermissionsForFileman = [
		'fileman_add_element_to_menu',
		'fileman_edit_menu_elements',
		'fileman_edit_existent_files',
		'fileman_edit_existent_folders',
		'fileman_admin_files',
		'fileman_admin_folders',
		'fileman_view_permissions',
		'fileman_upload_files',
		'fileman_view_file_structure'
	];

	protected static function run()
	{
		/* проверка уровней доступа для группы Контент-редакторы */
		$group = CGroup::GetList(false, false, ['STRING_ID' => 'content_editor'])->fetch();
		$accessForGroupEditor = static::checkAccessForContentEditorGroup($group);
		static::checkAccessLevel($group, 'main', $accessForGroupEditor);
		static::checkAccessLevel($group, 'fileman', static::arrayPermissionsForFileman);

		/* проверка доступа для групп пользователей имеющихся инфоблоков */
		static::checkAccessIblocks($group);

		/* проверка на доступ к редактированию всех разделов сайта */
		include_once AccessFile::find()->getPath();
		Assert::eq($PERM["/"]['G' . $group['ID']], "W", 'Группа "Контент-редакторы" должны иметь право на редактирование всех разделов сайта');

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

		return $operations;
	}

	private static function checkAccessLevel($group, $module_id, $expectPermissions)
	{
		$idTask = CGroup::GetModulePermission($group['ID'], $module_id);
		$operations = CTask::GetOperations($idTask, true);

		Assert::notEmpty($operations, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_CHECK_GROUP_ACCESS_NOT_EXPECT_VALUE', [
			'#GROUP_NAME#' => $group['NAME'],
			'#MODULE_NAME#' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_MODULE_LOC_' . mb_strtoupper($module_id)),
			'#EXPECT_VALUE#' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_EXPECT_ACCESS_LOC_' . mb_strtoupper($module_id))
		]));

		$test = array_intersect($expectPermissions, $operations);
		Assert::true(($test == $operations), Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_CHECK_GROUP_ACCESS_NOT_EXPECT_VALUE', [
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