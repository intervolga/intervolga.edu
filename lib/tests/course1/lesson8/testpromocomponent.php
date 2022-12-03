<?php
namespace Intervolga\Edu\Tests\Course1\Lesson8;

use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\PromoSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentTemplates\NewsTemplate;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\PathMaskParser;

class TestPromoComponent extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$template = PromoSection::find();
		$getList = ParametersTable::getList([
			'filter' => [
				'=COMPONENT_NAME' => 'bitrix:news',
				'=REAL_PATH' => FileSystem::getLocalPath($template) . 'index.php',
			],
			'select' => [
				'ID',
				'TEMPLATE_NAME',
			],
		]);
		$fetch = $getList->fetch();
		Assert::notEmpty($fetch['TEMPLATE_NAME']);
		if ($fetch['TEMPLATE_NAME']) {
			$fse = PathMaskParser::getFileSystemEntriesByMask('/local/templates/*/components/*/news/' . $fetch['TEMPLATE_NAME'] . '/');
			if ($fse) {
				Assert::directoryExists($fse[0]);
				$templateObject = new NewsTemplate($fse[0]->getPath());
				foreach ($templateObject->getUnknownFileSystemEntries() as $unknownFileSystemEntry) {
					Assert::fseNotExists($unknownFileSystemEntry);
				}
				Assert::fseNotExists($templateObject->getRssFile());
				Assert::fseNotExists($templateObject->getRssSectionFile());
				Assert::fseNotExists($templateObject->getSearchFile());
				Assert::fseNotExists($templateObject->getSectionFile());
				foreach ($templateObject->getLangForeignDirs() as $item) {
					Assert::directoryNotExists($item);
				}
				if ($templateObject->getLangRuDir())
				{
					foreach ($templateObject->getLangRuDir()->getChildren() as $child) {
						if (!in_array($child->getName(), ['detail.php', 'news.php']))
						{
							Assert::fseNotExists($child);
						}
					}
				}
			}
		}
	}
}
