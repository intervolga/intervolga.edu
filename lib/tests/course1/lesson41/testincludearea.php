<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Registry\Directory\PartnersDirectory;

class TestIncludeArea extends BaseTest
{
	const FILE_NAME_PARTS = [
		'sect',
		'inc',
	];

	public static function run()
	{
		$sectIncName = static::getSectIncNameFromPartners();
		Assert::notEmpty($sectIncName, Loc::getMessage('INTERVOLGA_EDU.PARTNERS_SECT_INC_NOT_FOUND', [
			'#POSSIBLE#' => implode(', ', static::FILE_NAME_PARTS),
		]));
		$fileInRoot = FileSystem::getFile('/' . $sectIncName);
		Assert::fseExists($fileInRoot);
	}

	protected static function getSectIncNameFromPartners(): string
	{
		$result = '';
		$directory = PartnersDirectory::find();
		if ($directory->getChildren()) {
			foreach ($directory->getChildren() as $child) {
				if ($child->isFile()) {
					if (mb_substr($child->getName(), 0, 1) != '.') {
						foreach (static::FILE_NAME_PARTS as $namePart) {
							if (mb_substr_count($child->getName(), $namePart)) {
								$result = $child->getName();
							}
						}
					}
				}
			}
		}

		return $result;
	}
}
