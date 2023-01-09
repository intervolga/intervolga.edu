<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\DumpFunction;
use Intervolga\Edu\Tests\BaseTest;

class TestDumpFunction extends BaseTest
{
	protected static function run()
	{
		//файл с функцией существует
		Assert::fileLocator(DumpFunction::class);
		//функция существует
		Assert::functionExists(DumpFunction::findFunctionDump(), Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_DUMP',
			[
				'#POSSIBLE#' => implode(' || ',  DumpFunction::getPossibleName())
			]
		));
	}


}