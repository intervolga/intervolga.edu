<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\ComponentTemplate\NewsTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

abstract class BaseComponentTemplateTest extends BaseTest
{
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

	/**
	 * @return string|DirectoryLocator
	 */
	abstract protected static function getLocator();

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

	/**
	 * @return string|ComponentTemplate
	 */
	abstract protected static function getComponentTemplateTree();

	protected static function testTemplateTrash(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getUnknownFileSystemEntries() as $unknownFileSystemEntry) {
			Assert::fseNotExists($unknownFileSystemEntry);
		}
		static::checkRequiredFilesTemplate($templateDir);
		static::checkNotExistingFilesTemplate($templateDir);
		foreach ($templateDir->getLangForeignDirs() as $langForeignDir) {
			Assert::directoryNotExists($langForeignDir);
		}
		static::testTemplateLangRuTrash($templateDir);
	}

	protected static function checkRequiredFilesTemplate(ComponentTemplate $templateDir)
	{
		if ($templateDir instanceof NewsTemplate) {
			Assert::fseExists($templateDir->getNewsFile());
			Assert::fseExists($templateDir->getDetailFile());
		} else {
			Assert::fseExists($templateDir->getTemplateFile());
		}
	}

	protected static function checkNotExistingFilesTemplate(ComponentTemplate $templateDir)
	{
		Assert::fseNotExists($templateDir->getImagesDir());
		Assert::fseNotExists($templateDir->getParametersFile());
		Assert::fseNotExists($templateDir->getDescriptionFile());
	}

	protected static function testTemplateLangRuTrash(ComponentTemplate $templateDir)
	{
		if ($templateDir->getLangRuDir()->isExists()) {
			foreach ($templateDir->getLangRuDir()->getChildren() as $child) {

				if ($child->isDirectory()) {
					if (!in_array($child->getName(), static::getKnownDirNames($templateDir))) {
						Assert::directoryNotExists($child);
					}
				} elseif ($child->isFile()) {
					if (!in_array($child->getName(), static::getKnownFilesNames($templateDir))) {
						Assert::fseNotExists($child);
					}else {
						static::testTemplateLangRu($templateDir, $child);
					}
				}
			}
		}
	}

	protected static function getKnownDirNames(ComponentTemplate $templateDir)
	{
		$names = [];
		foreach ($templateDir->getKnownDirs() as $file) {
			$names[] = $file->getName();
		}

		return $names;
	}

	protected static function getKnownFilesNames(ComponentTemplate $templateDir)
	{
		$names = [];
		foreach ($templateDir->getKnownFiles() as $file) {
			$names[] = $file->getName();
		}

		return $names;
	}

	protected static function testTemplateCode(ComponentTemplate $templateDir)
	{
		$files = [];
		foreach ($templateDir->getKnownPhpFiles() as $knownPhpFile) {
			if ($knownPhpFile->isExists()) {
				$files[] = $knownPhpFile->getPath();
			}
		}
		Assert::phpSniffer($files, [
			'general',
			'templateChecker'
		]);
	}

	protected static function getLangArrayTemplateDir(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getKnownFiles() as $template) {
			$result = Sniffer::run([$template->getPath()], ['langUsage']);
			foreach ($result as $message) {
				$newTest[] = mb_strcut($message->getMessage(), 1, -1);
			}
		}

		return $newTest;
	}

	protected static function testTemplateLangRu(ComponentTemplate $templateDir, $child)
	{
		$result = Sniffer::run([$child->getPath()], ['langDefinition']);
		$test = static::getLangArrayTemplateDir($templateDir);
		foreach ($result as $message) {
			$langNames[$child->getName()][] = $message->getMessage();
			$tester = mb_strcut($message->getMessage(), 1, -1);
			if (!in_array($tester, $test)) {
				Assert::true($tester, Loc::getMessage('INTERVOLGA_EDU.SNIFFER_CHECK_LANG_CODE', [
					'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $child->getName(),
						'#PATH#' => FileSystem::getLocalPath($child),
						'#FILEMAN_URL#' => Admin::getFileManUrl($child),
					]),
					'#VALUE#' => $tester
				]));
			}
		}

	}
}