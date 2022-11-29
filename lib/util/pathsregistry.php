<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

class PathsRegistry
{
	const NON_PUBLIC_DIRS = [
		'/upload/',
		'/bitrix/',
		'/local/',
	];

	/**
	 * @return Directory[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public static function getPublicDirsLevelOne(): array
	{
		$result = [];
		$directory = new Directory(Application::getDocumentRoot());
		foreach ($directory->getChildren() as $child) {
			if ($child->isDirectory()) {
				if (!in_array('/' . $child->getName() . '/', static::NON_PUBLIC_DIRS)) {
					$result[] = $child;
				}
			}
		}

		return $result;
	}

	/**
	 * @return Directory[]
	 */
	public static function getPartnersPossibleDirectories()
	{
		return [
			FileSystem::getDirectory('/for-partners/'),
			FileSystem::getDirectory('/partners/'),
			FileSystem::getDirectory('/partner/'),
		];
	}

	/**
	 * @return Directory[]
	 */
	public static function getReviewsPossibleDirectories()
	{
		return [
			FileSystem::getDirectory('/company/reviews/'),
			FileSystem::getDirectory('/company/review/'),
		];
	}

	/**
	 * @return Directory[]
	 */
	public static function getPromoPossibleDirectories()
	{
		return [
			FileSystem::getDirectory('/promo/'),
			FileSystem::getDirectory('/discounts/'),
			FileSystem::getDirectory('/discount/'),
			FileSystem::getDirectory('/stocks/'),
			FileSystem::getDirectory('/stock/'),
		];
	}

	/**
	 * @return Directory[]
	 */
	public static function getCustomModuleDirectories()
	{
		$result = [];
		$modulesDirs = PathMaskParser::getFileSystemEntriesByMask('/local/modules/intervolga.*/');
		foreach ($modulesDirs as $moduleDir) {
			if ($moduleDir->getName() != 'intervolga.edu')
			{
				$result[] = $moduleDir;
			}
		}

		return $result;
	}
}