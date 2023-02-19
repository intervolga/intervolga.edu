<?php
namespace Intervolga\Edu\Tests\CourseIntervolga\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class ModulesCheck extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$modules = static::getModulesList();
		static::checkModulesDiff($modules);
		static::checkNeededModules($modules);
	}

	protected static function checkNeededModules(array $modules)
	{
		$diffModules = array_diff(INTERVOLGA_EDU_GUESS_VARIANTS['MODULES'], $modules);
		if ($diffModules) {
			foreach ($diffModules as $module) {
				Assert::false($module, Loc::getMessage('INTERVOLGA_EDU.COURSE_INTERVOLGA_MODULE_NOT_ISTALLED'));
			}
		}
	}

	protected static function checkModulesDiff(array $modules)
	{
		$diffModules = array_diff($modules, INTERVOLGA_EDU_GUESS_VARIANTS['MODULES']);
		if ($diffModules) {
			foreach ($diffModules as $module) {
				Assert::false($module, Loc::getMessage('INTERVOLGA_EDU.COURSE_INTERVOLGA_MODULE_NEED_DELETED'));
			}
		}
	}

	protected static function getModulesList()
	{
		$res = \CModule::GetList();
		while ($row = $res->Fetch()) {
			if (!preg_match('/intervolga\./i', $row['ID'])) {
				$modules[] = $row['ID'];
			}
		}

		return $modules;
	}
}