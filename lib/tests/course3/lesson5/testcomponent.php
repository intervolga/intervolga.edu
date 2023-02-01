<?php
namespace Intervolga\Edu\Tests\Course3\Lesson5;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentParameters;

class TestComponent extends BaseTest
{
	protected static function run()
	{
		$parameters = ComponentParameters::getComponentParameters('bitrix:news.list', [
			'TEMPLATE_NAME' => 'gallery',
			'REAL_PATH' => '/gallery.php'
		]);
		if ($parameters === false) {
			Assert::custom(Loc::getMessage('INTERVOLGA_EDU.COMPONENT_NOT_EXISTS'));
		} else {
			Assert::eq($parameters['DISPLAY_BOTTOM_PAGER'], 'Y', Loc::getMessage('INTERVOLGA_EDU.NOT_VALID_VALUE', [
				'#FIELD#' => Loc::getMessage('INTERVOLGA_EDU.DISPLAY_BOTTOM_PAGER'),
				'#VALUE#' => 'Y',
				'#NOW#' => $parameters['DISPLAY_BOTTOM_PAGER']
			]));

			Assert::eq($parameters['NEWS_COUNT'], 3, Loc::getMessage('INTERVOLGA_EDU.NOT_VALID_VALUE', [
				'#FIELD#' => Loc::getMessage('INTERVOLGA_EDU.NEWS_COUNT'),
				'#VALUE#' => '2',
				'#NOW#' => $parameters['NEWS_COUNT']
			]));
		}
	}

	public static function interceptErrors()
	{
		return false;
	}
}
