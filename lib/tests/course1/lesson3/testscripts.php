<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestScripts extends BaseTest
{
	public static function run()
	{
		$innerHeaderPath = '/local/templates/inner/header.php';
		$mainHeaderPath = '/local/templates/main/header.php';

		$jsLibsToCheckInMain = [
			'slides.min.jquery.js',
			'jquery.carouFredSel-6.1.0-packed.js',
		];

		$mainHeaderFile = new File(Application::getDocumentRoot() . $mainHeaderPath);
		$innerHeaderFile = new File(Application::getDocumentRoot() . $innerHeaderPath);
		foreach ($jsLibsToCheckInMain as $jsLibToCheck) {
			if ($mainHeaderFile->isExists() && $mainHeaderFile->isFile()) {
				if (!substr_count($mainHeaderFile->getContents(), $jsLibToCheck)) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.ADD_THIS_JS', [
						'#JS#' => $jsLibToCheck,
						'#PATH#' => FileSystem::getLocalPath($mainHeaderFile),
						'#ADMIN_LINK#' => Admin::getFileManUrl($mainHeaderFile),
					]));
				}
			}
			if ($innerHeaderFile->isExists() && $innerHeaderFile->isFile()) {
				if (substr_count($innerHeaderFile->getContents(), $jsLibToCheck)) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.DELETE_THIS_JS', [
						'#JS#' => $jsLibToCheck,
						'#PATH#' => FileSystem::getLocalPath($innerHeaderFile),
						'#ADMIN_LINK#' => Admin::getFileManUrl($innerHeaderFile),
					]));
				}
			}
		}
	}
}