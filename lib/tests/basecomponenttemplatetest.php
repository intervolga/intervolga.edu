<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertPhp;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

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
			foreach ($templateDir->getUnknownFileSystemEntries() as $unknownFileSystemEntry) {
				Assert::fseNotExists($unknownFileSystemEntry);
			}
			Assert::fseNotExists($templateDir->getImagesDir());
			Assert::fseNotExists($templateDir->getParametersFile());
			Assert::fseNotExists($templateDir->getDescriptionFile());
			foreach ($templateDir->getLangForeignDirs() as $langForeignDir) {
				Assert::directoryNotExists($langForeignDir);
			}
			foreach ($templateDir->getKnownPhpFiles() as $knownPhpFile) {
				if ($knownPhpFile->isExists()) {
					AssertPhp::goodCode($knownPhpFile);
					static::checkPhpVars($knownPhpFile);
				}
			}
		}
	}

	protected static function checkPhpVars(File $file)
	{
		$vars = static::parseVarsWithIndexes($file);
		foreach ($vars as $var) {
			static::checkFieldVar($var, $file);
			static::checkPropertyVar($var, $file);
		}
	}

	protected static function checkFieldVar(array $var, File $file)
	{
		$indexIsField = (in_array($var['INDEXES'][0], [
			'PREVIEW_TEXT',
			'PREVIEW_PICTURE',
			'NAME'
		]));
		Assert::true(
			!$indexIsField,
			Loc::getMessage(
				'INTERVOLGA_EDU.CONTENT_FOUND',
				[
					'#PATH#' => FileSystem::getLocalPath($file),
					'#ADMIN_LINK#' => Admin::getFileManUrl($file),
					'#REGEX_EXPLAIN#' => $var['ORIGINAL'],
					'#REASON#' => Loc::getMessage('INTERVOLGA_EDU.USE_FIELDS_FOR_FIELDS'),
				]
			)
		);
	}

	protected static function checkPropertyVar(array $var, File $file)
	{
		if ($var['INDEXES'][0] == 'PROPERTIES') {
			Assert::true(
				false,
				Loc::getMessage('INTERVOLGA_EDU.CONTENT_FOUND', [
					'#PATH#' => FileSystem::getLocalPath($file),
					'#ADMIN_LINK#' => Admin::getFileManUrl($file),
					'#REGEX_EXPLAIN#' => $var['ORIGINAL'],
					'#REASON#' => Loc::getMessage('INTERVOLGA_EDU.USE_DISPLAY_PROPERTIES_FOR_PROPERTIES'),
				])
			);
		}

		$index0isProperty = in_array($var['INDEXES'][0], [
			'PROPERTIES',
			'DISPLAY_PROPERTIES'
		]);
		$index2isValue = ($var['INDEXES'][2] == 'VALUE');
		if ($index0isProperty && $index2isValue) {
			Assert::true(
				false,
				Loc::getMessage('INTERVOLGA_EDU.CONTENT_FOUND', [
					'#PATH#' => FileSystem::getLocalPath($file),
					'#ADMIN_LINK#' => Admin::getFileManUrl($file),
					'#REGEX_EXPLAIN#' => $var['ORIGINAL'],
					'#REASON#' => Loc::getMessage('INTERVOLGA_EDU.USE_DISPLAY_PROPERTIES_FOR_PROPERTIES_ECHO'),
				])
			);
		}
	}

	protected static function parseVarsWithIndexes(File $file): array
	{
		$result = [];
		$contents = $file->getContents();
		$re = '/(?<var>\$[a-z_][a-z_0-9]*)(?<indexes>\[.*?\](\[.*?\])*)/i';
		preg_match_all($re, $contents, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			$varInfo = [
				'ORIGINAL' => $match[0],
			];
			$varInfo['VAR'] = $match['var'];
			$indexes = explode('][', trim($match['indexes'], '[]'));
			foreach ($indexes as $index) {
				$varInfo['INDEXES'][] = trim($index, '"\'');
			}
			$result[] = $varInfo;
		}

		return $result;
	}
}