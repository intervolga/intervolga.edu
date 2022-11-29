<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\BaseTest;

class TestTemplates extends BaseTest
{
	public static function run()
	{
		$templatesAllowed = [
			'main',
			'inner',
			'.default',
		];

		$templatesDirectory = new Directory(Application::getDocumentRoot() . '/local/templates/');
		foreach ($templatesDirectory->getChildren() as $child) {
			if ($child->isDirectory()) {
				if (!in_array($child->getName(), $templatesAllowed)) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.UNKNOWN_TEMPLATE_FOUND', [
						'#NAME#' => $child->getName(),
						'#ADMIN_LINK#' => Admin::getFileManUrl($child),
					]));
				}
			}
		}
	}
}