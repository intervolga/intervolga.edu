<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertPhp;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\NewsTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Util\Regex;
use Intervolga\Edu\Sniffer as NewSniff;
use Intervolga\Edu\Util\Sniffer;

abstract class BaseComponentTemplateTest extends BaseTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	abstract protected static function getLocator();

	/**
	 * @return string|ComponentTemplate
	 */
	abstract protected static function getComponentTemplateTree();

	public static function interceptErrors()
	{
		return true;
	}

	public static function getTestLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COMPONENT_TEMPLATE_NAME', [
			'#TEMPLATE#' => static::getLocator()::getNameLoc(),
		]);
	}

	public static function getDescription(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COMPONENT_TEMPLATE_DESCRIPTION');
	}

	protected static function run()
	{
		$locatorClass = static::getLocator();
		Assert::directoryLocator($locatorClass);
		if ($templateDir = $locatorClass::find(static::getComponentTemplateTree())) {
			/**
			 * @var ComponentTemplate $templateDir
			 */
			static::testTemplateTrash($templateDir);
			static::testTemplateCode($templateDir);
		}
	}

	protected static function testTemplateCode(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getKnownPhpFiles() as $knownPhpFile) {
			if ($knownPhpFile->isExists()) {
				AssertPhp::goodCode($knownPhpFile);
				Sniffer::testTemplateFile($knownPhpFile);
			}
		}
	}

	protected static function testTemplateTrash(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getUnknownFileSystemEntries() as $unknownFileSystemEntry) {
			Assert::fseNotExists($unknownFileSystemEntry);
		}
		Assert::fseNotExists($templateDir->getImagesDir());
		Assert::fseNotExists($templateDir->getParametersFile());
		Assert::fseNotExists($templateDir->getDescriptionFile());
		foreach ($templateDir->getLangForeignDirs() as $langForeignDir) {
			Assert::directoryNotExists($langForeignDir);
		}
		static::testTemplateLangRuTrash($templateDir);
	}

	protected static function testTemplateLangRuTrash(ComponentTemplate $templateDir)
	{
		if ($templateDir->getLangRuDir()->isExists()) {
			foreach ($templateDir->getLangRuDir()->getChildren() as $child) {
				if ($child->getName() == $templateDir->getDescriptionFile()->getName()) {
					Assert::fseNotExists($child);
				} elseif ($child->getName() == $templateDir->getParametersFile()->getName()) {
					Assert::fseNotExists($child);
				} elseif ($templateDir instanceof SimpleComponentTemplate) {
					if ($child->getName() != $templateDir->getTemplateFile()) {
						Assert::fseNotExists($child);
					}
				} elseif ($templateDir instanceof NewsTemplate) {
					if (!in_array($child->getName(), [
						$templateDir->getNewsFile()->getName(),
						$templateDir->getDetailFile()->getName()
					])) {
						Assert::fseNotExists($child);
					} else {
						static::testTemplateLangRu($templateDir, $child);
					}
				}
			}
		}
	}

	/*protected static function testTemplateLangRuCode(ComponentTemplate $templateDir){
		if ($templateDir->getLangRuDir()->isExists()) {
			foreach ($templateDir->getLangRuDir()->getChildren() as $child) {
				if ($child->getName() == $templateDir->getDescriptionFile()->getName()) {
					Assert::fseNotExists($child);
				} elseif ($child->getName() == $templateDir->getParametersFile()->getName()) {
					Assert::fseNotExists($child);
				} elseif ($templateDir instanceof SimpleComponentTemplate) {
					if ($child->getName() != $templateDir->getTemplateFile()) {
						Assert::fseNotExists($child);
					}
				} elseif ($templateDir instanceof NewsTemplate) {
					if (!in_array($child->getName(), [
						$templateDir->getNewsFile()->getName(),
						$templateDir->getDetailFile()->getName()
					])) {
						Assert::fseNotExists($child);
					} else {
						static::testTemplateLangRu($templateDir, $child);
					}
				}
			}
		}
	}*/

	protected static function getLangArrayTemplateDir(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getKnownFiles() as $template) {

			$result = NewSniff::run([$template->getPath()], ['langArrayFromTemplateDir']);

			foreach ($result as $message) {
				$newTest[$template->getName()] = mb_strcut($message->getMessage(), 1, -1);

			}
		}

		\Bitrix\Main\Diag\Debug::dump($newTest);
		return $newTest;
	}

	protected static function testTemplateLangRu(ComponentTemplate $templateDir, $child)
	{

		$result = NewSniff::run([$child->getPath()], ['langFiles']);

		$test = static::getLangArrayTemplateDir($templateDir);

		foreach ($result as $message) {

			$langNames[$child->getName()][] = $message->getMessage();
			$tester = mb_strcut($message->getMessage(), 1, -1);

			if (!in_array($tester, $test)) {
				\Bitrix\Main\Diag\Debug::dump($tester);
				//\Bitrix\Main\Diag\Debug::dump($test);
			}
		}

	}
}