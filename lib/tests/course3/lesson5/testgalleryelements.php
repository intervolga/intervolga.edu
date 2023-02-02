<?php
namespace Intervolga\Edu\Tests\Course3\Lesson5;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\Iblock\GalleryIblock;
use Intervolga\Edu\Tests\BaseTestIblockElement;

class TestGalleryElements extends BaseTestIblockElement
{
	protected static function getIblockLocator(): array
	{
		return GalleryIblock::find();
	}

	/**
	 * @throws AssertException
	 */
	protected static function checkElement(array $element): void
	{
		$keys = [
			'DETAIL_PICTURE',
			'DETAIL_TEXT',
			'PREVIEW_PICTURE'
		];
		foreach ($keys as $key) {
			Assert::notEmpty($element[$key], Loc::getMessage('INTERVOLGA_EDU.NOT_EXISTS_VALUE_OF_KEY', [
				'#IBLOCK_ID#' => $element['IBLOCK_ID'],
				'#ID#' => $element['ID'],
				'#NAME#' => $element['NAME'],
				'#KEY#' => $key
			]));
		}
	}
}