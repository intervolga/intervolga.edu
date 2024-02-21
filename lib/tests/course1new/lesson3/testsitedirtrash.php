<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\PathMaskParser;

class TestSiteDirTrash extends BaseTest
{
	const TRASH_FILES = [
		'bitrixsetup.php',
		'restore.php',
		'bitrixservertest.php'
	];

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		foreach (static::TRASH_FILES as $fileName) {
			Assert::fseNotExists(FileSystem::getFile("/$fileName"));
		}

		$archives = static::findArchive();
		Assert::empty($archives, Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_3.ROOT_DIR_TRASH', ['#NAMES#' => $archives]));
	}

	protected static function findArchive()
	{
		$innerFiles = PathMaskParser::getFileSystemEntriesByMask('/*.tar.gz');
		$names = [];
		if ($innerFiles) {
			foreach ($innerFiles as $trash) {
				$names[] = $trash->getName();
			}
			$names = implode(' | ', $names);
		}

		return $names;
	}
}