<?php
namespace Intervolga\Edu\Tests\Course1\Lesson8;

use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\Registry\Directory\PromoDirectory;

class TestPromoComponent extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$template = PromoDirectory::find();
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

		$fse = PathMaskParser::getFileSystemEntriesByMask('/local/templates/*/components/*/news/' . $fetch['TEMPLATE_NAME'] . '/');
		Assert::directoryExists($fse[0]);

		$trash = PathMaskParser::getFileSystemEntriesByMasks(
			[
				'/.parameters.php',
				'/.description.php',
				'/search.php',
				'/section.php',
				'/lang/en/',
				'/lang/en/*',
				'/lang/ru/.parameters.php',
				'/lang/ru/.description.php',
				'/lang/ru/search.php',
				'/lang/ru/section.php',
			],
			$fse
		);
		foreach ($trash as $trashFse) {
			Assert::fseNotExists($trashFse);
		}
	}
}
