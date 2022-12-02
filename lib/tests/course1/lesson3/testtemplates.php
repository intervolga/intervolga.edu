<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestTemplates extends BaseTest
{
	protected static function run()
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
					Assert::directoryNotExists($child);
				}
			}
		}
	}
}