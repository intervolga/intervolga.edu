<?php
namespace Intervolga\Edu\Tests\Course1\Lesson7;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\Template\RandomReview;
use Intervolga\Edu\Tests\BaseTestTemplateParameters;

class TestRandomReview extends BaseTestTemplateParameters
{
	protected static function run()
	{
		parent::run();
		$parameters = static::getLocator()::find()['PARAMETERS'];

		if ($parameters['CACHE_TYPE'] == 'A') {
			Assert::lessEq(
				$parameters['CACHE_TIME'],
				60,
				Loc::getMessage('INTERVOLGA_EDU.CACHE_TYPE_A_LIMITED')
			);
		} else {
			Assert::eq(
				$parameters['CACHE_TYPE'],
				'N',
				Loc::getMessage('INTERVOLGA_EDU.CACHE_TYPE_A_LIMITED')
			);
		}

	}

	protected static function getLocator()
	{
		return RandomReview::class;
	}

	protected static function getParametersExpectedList(): array
	{
		return [
			[
				'NAME' =>'CACHE_GROUPS',
				'EXPECTED'=>'N',
				'MESSAGE'=>'INTERVOLGA_EDU.CACHE_GROUPS'
			]
		];
	}
}