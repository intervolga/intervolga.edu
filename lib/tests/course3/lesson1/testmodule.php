<?php
namespace Intervolga\Edu\Tests\Course3\Lesson1;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\PathsRegistry;

class TestModule extends BaseTest
{
	public static function run()
	{
		$modulesDirs = PathsRegistry::getCustomModuleDirectories();
		if ($modulesDirs) {
			foreach ($modulesDirs as $moduleDir) {
				if (!Loader::includeModule($moduleDir->getName())) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.INTERVOLGA_MODULE_NOT_INSTALLED', [
						'#MODULE#' => $moduleDir->getName(),
					]));
				}
			}
		} else {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.NO_INTERVOLGA_MODULES'));
		}
	}
}
