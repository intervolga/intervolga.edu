<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

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
		Assert::directoryExists($templatesDirectory);
		Assert::directoryNotEmpty($templatesDirectory);
		if ($templatesDirectory->getChildren()) {
			foreach ($templatesDirectory->getChildren() as $child) {
				if ($child->isDirectory()) {
					if (!in_array($child->getName(), $templatesAllowed)) {
						Assert::directoryNotExists($child);
					}
				} elseif ($child->isFile()) {
					Assert::fileNotExists($child);
				}
			}
			foreach ($templatesAllowed as $template){
				Assert::directoryExists(FileSystem::getDirectory('/local/templates/'.$template.'/'));
			}
		}
	}
}