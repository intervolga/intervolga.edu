<?php
namespace Intervolga\Edu\Tests\Course3\Lesson5;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\ComponentTemplate\GalleryTemplate;
use Intervolga\Edu\Locator\IO\GalleryPage;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentParameters;
use Intervolga\Edu\Util\FileSystem;

class TestComponentGallery extends BaseTest
{
	public const MIN_ELEMENTS_COUNT = 3;

	protected static function run()
	{
		Assert::fileLocator(GalleryPage::class);
		Assert::directoryLocator(GalleryTemplate::class);
		$page = GalleryPage::find();
		$templateDirectory = GalleryTemplate::find();
		if ($page && $templateDirectory) {
			echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($templateDirectory->getName(), true) . '</pre>';
			echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r(FileSystem::getLocalPath($page), true) . '</pre>';
			$parameters = ComponentParameters::getComponentParameters('bitrix:news.list', [
				'TEMPLATE_NAME' => $templateDirectory->getName(),
				'REAL_PATH' => FileSystem::getLocalPath($page),
			]);
			Assert::eq(
				$parameters['DISPLAY_BOTTOM_PAGER'],
				'Y',
				Loc::getMessage('INTERVOLGA_EDU.NOT_VALID_VALUE', [
					'#FIELD#' => Loc::getMessage('INTERVOLGA_EDU.DISPLAY_BOTTOM_PAGER'),
					'#VALUE#' => 'Y',
					'#NOW#' => $parameters['DISPLAY_BOTTOM_PAGER']
				])
			);

			Assert::eq(
				$parameters['NEWS_COUNT'],
				static::MIN_ELEMENTS_COUNT,
				Loc::getMessage('INTERVOLGA_EDU.NOT_VALID_VALUE', [
					'#FIELD#' => Loc::getMessage('INTERVOLGA_EDU.NEWS_COUNT'),
					'#VALUE#' => static::MIN_ELEMENTS_COUNT,
					'#NOW#' => $parameters['NEWS_COUNT']
				])
			);
		}
	}

	public static function interceptErrors()
	{
		return true;
	}
}
