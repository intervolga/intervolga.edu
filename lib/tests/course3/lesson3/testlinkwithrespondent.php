<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\Property\ConnectRespondentProperty;
use Intervolga\Edu\Locator\Iblock\RespondentIblock;
use Intervolga\Edu\Tests\BaseTest;

class TestLinkWithRespondent extends BaseTest
{
	protected static function run()
	{
		Assert::iblockLocator(RespondentIblock::class);
		Assert::propertyLocator(ConnectRespondentProperty::class);
		Assert::keyEqValue(ConnectRespondentProperty::find(), 'LINK_IBLOCK_ID', RespondentIblock::find()['ID']);
	}
}
