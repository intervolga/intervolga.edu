<?php
namespace Intervolga\Edu\Tests\Course1\Lesson7;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\Template\RandomReview;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;
use Intervolga\Edu\Tests\BaseTestTemplateParameters;

class TestRandomReview extends BaseTestTemplateParameters
{
	protected static function run()
	{
		parent::run();
		$template = static::getLocator()::find();
		if ($template) {
			$replace = [
				'#COMPONENT#' => $template['COMPONENT_NAME'],
				'#TEMPLATE#' => $template['TEMPLATE_NAME'],
				'#PATH#' => $template['REAL_PATH'],
			];

			if ($template['PARAMETERS']['CACHE_TYPE'] == 'A') {
				Assert::lessEq(
					$template['PARAMETERS']['CACHE_TIME'],
					60,
					Loc::getMessage('INTERVOLGA_EDU.CACHE_TYPE_A_LIMITED', $replace)
				);
			} else {
				Assert::eq(
					$template['PARAMETERS']['CACHE_TYPE'],
					'N',
					Loc::getMessage('INTERVOLGA_EDU.CACHE_TYPE_A_LIMITED', $replace)
				);
			}
		}
	}

	/**
	 * @return TemplateLocator|string
	 */
	protected static function getLocator()
	{
		return RandomReview::class;
	}

	protected static function getParametersExpectedList(): array
	{
		return [
			[
				'NAME' => 'CACHE_GROUPS',
				'EXPECTED' => 'N',
				'MESSAGE' => 'INTERVOLGA_EDU.CACHE_GROUPS'
			]
		];
	}
}