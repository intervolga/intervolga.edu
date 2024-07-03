<?php

namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\CustomRespondents;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestSubQuery extends BaseTest
{
	protected static function run()
	{
		$componentFile = CustomRespondents::getComponentFile();
		Assert::fseExists($componentFile);
		if ($componentFile->isExists()) {
			Assert::fileContentMatches($componentFile, new Regex('/CIBlockElement::SubQuery/', 'CIBlockElement::SubQuery'));
		}
	}
}