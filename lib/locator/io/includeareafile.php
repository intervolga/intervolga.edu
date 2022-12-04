<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;

class IncludeAreaFile extends FileLocator
{
	const FILE_NAME_PARTS = [
		'sect',
		'inc',
	];

	protected static function getPaths(): array
	{
		return [];
	}

	public static function getPossibleTips()
	{
		return Loc::getMessage('INTERVOLGA_EDU.INCLUDEAREA_PARTNERS_TIPS', [
			'#PARTS#' => implode('||', static::FILE_NAME_PARTS),
		]);
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.INCLUDEAREA_PARTNERS');
	}

	/**
	 * @param string|File $class
	 * @return File|null
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public static function find($class = File::class)
	{
		$result = null;
		$directory = PartnersSection::find();
		if ($directory->getChildren()) {
			foreach ($directory->getChildren() as $child) {
				if ($child->isFile()) {
					if (mb_substr($child->getName(), 0, 1) != '.') {
						foreach (static::FILE_NAME_PARTS as $namePart) {
							if (mb_substr_count($child->getName(), $namePart)) {
								$result = $child;
							}
						}
					}
				}
			}
		}

		return $result;
	}
}
