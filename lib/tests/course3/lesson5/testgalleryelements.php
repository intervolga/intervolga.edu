<?php
namespace Intervolga\Edu\Tests\Course3\Lesson5;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\Iblock\GalleryIblock;
use Intervolga\Edu\Tests\BaseTestIblockElement;
use Intervolga\Edu\Util\Admin;

class TestGalleryElements extends BaseTestIblockElement
{
	protected static function getIblockLocator()
	{
		return GalleryIblock::class;
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
				'#NAME#' => $element['NAME'],
				'#KEY#' => $key,
				'#IBLOCK_LINK#' => Admin::getIblockElementEditUrl($element),
			]));
		}
	}
}