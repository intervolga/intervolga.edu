<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;

class TestDeleteTrash extends BaseTest
{
	protected static function run()
	{
		$innerFiles = PathMaskParser::getFileSystemEntriesByMask('/bitrix/modules/*.zip');
		$names=[];
		if ($innerFiles) {
			foreach ($innerFiles as $trash) {
				$names[] = $trash->getName();
			}
			$names = implode(' | ', $names);
		}

		Assert::empty($names, Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_2.TRASH', ['#NAMES#' => $names]));
	}
}