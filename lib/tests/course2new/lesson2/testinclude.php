<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestInclude extends BaseTest
{
	protected static function run()
	{
		$file = FileSystem::getFile('/local/modules/mycompany.custom/include.php');
		Assert::fseExists($file);
		Assert::fileContentMatches($file, new Regex('/onNewsAdd/',
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.NOT_FOUND_EH',
				['#EH_NAME#' => 'onNewsAdd'])));
		Assert::fileContentMatches($file, new Regex('/redirectFromTestPage/',
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.NOT_FOUND_EH',
				['#EH_NAME#' => 'redirectFromTestPage'])));
		Assert::fileContentMatches($file, new Regex('/setIsDevServerConstant/',
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.NOT_FOUND_EH',
				['#EH_NAME#' => 'setIsDevServerConstant'])));
	}
}