<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;
use Intervolga\Edu\Locator\Iblock\RespondentIblock;
use Intervolga\Edu\Locator\Iblock\Property\ConnectRespondentProperty;
use Intervolga\Edu\Tests\BaseTest;

class TestLinkWithRespondent extends BaseTest
{
	protected static function run()
	{
		$iblock = RespondentIblock::find();
		$property = ConnectRespondentProperty::find();
		Assert::eq($property['LINK_IBLOCK_ID'], $iblock['ID']);
	}
}
