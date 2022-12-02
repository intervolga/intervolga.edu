<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;
use Intervolga\Edu\Util\Registry\RegexRegistry;

abstract class BaseComponentTemplateTest extends BaseTest
{
	protected static function checkTemplateDir(Directory $templateDir, array $iblock)
	{
		foreach ($templateDir->getChildren() as $child) {
			if ($child->isFile()) {
				if ($child->getName() == 'template.php') {
					static::checkTemplateFile($child, $iblock);
				} else {
					Assert::fileNotExists($child);
				}
			} else {
				Assert::fileNotExists($child);
			}
		}
	}

	protected static function checkTemplateFile(File $file, array $iblock)
	{
		$regexesNotToFind = [];
		$regexesNotToFind = array_merge($regexesNotToFind, RegexRegistry::getShortPhpTag());
		$regexesNotToFind = array_merge($regexesNotToFind, RegexRegistry::getOldCore());
		$regexesNotToFind = array_merge($regexesNotToFind, RegexRegistry::getUglyCodeFragments());
		$regexesNotToFind = array_merge($regexesNotToFind, RegexRegistry::getPrefixNotaionFragments());
		$regexesNotToFind = array_merge($regexesNotToFind, [
			new Regex(
				'/href=""/i',
				'href=""',
				Loc::getMessage('INTERVOLGA_EDU.EMPTY_HREF')
			),
		]);

		foreach ($regexesNotToFind as $regex) {
			Assert::fileContentNotMatches($file, $regex);
		}

		$regexesToFind = [];
		$regexesToFind = array_merge($regexesToFind, RegexRegistry::getCustomCore());
		foreach ($regexesToFind as $regex) {
			Assert::fileContentMatches($file, $regex);
		}

		static::checkPhpVars($file, $iblock);
	}

	protected static function checkPhpVars(File $file, array $iblock)
	{
		$vars = static::parseVarsWithIndexes($file);
		$propertiesCodes = [];
		if ($iblock) {
			$getList = PropertyTable::getList([
				'filter' => [
					'IBLOCK_ID' => $iblock['ID'],
				],
				'select' => [
					'ID',
					'CODE',
				],
			]);

			while ($fetch = $getList->fetch()) {
				if (mb_strlen($fetch['CODE'])) {
					$propertiesCodes[] = $fetch['CODE'];
				}
			}
			foreach ($vars as $var) {
				static::checkFieldVar($var, $file);
				static::checkPropertyVar($var, $file, $propertiesCodes);
			}
		}
	}

	protected static function checkFieldVar(array $var, File $file)
	{
		if (in_array($var['INDEXES'][0], [
			'PREVIEW_TEXT',
			'PREVIEW_PICTURE',
			'NAME'
		])) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.CONTENT_FOUND', [
				'#PATH#' => FileSystem::getLocalPath($file),
				'#ADMIN_LINK#' => Admin::getFileManUrl($file),
				'#REGEX_EXPLAIN#' => $var['ORIGINAL'],
				'#REASON#' => Loc::getMessage('INTERVOLGA_EDU.USE_FIELDS_FOR_FIELDS'),
			]));
		}
	}

	protected static function checkPropertyVar(array $var, File $file, array $propertiesCodes)
	{
		if (in_array($var['INDEXES'][1], $propertiesCodes)) {
			if ($var['INDEXES'][0] == 'PROPERTIES') {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.CONTENT_FOUND', [
					'#PATH#' => FileSystem::getLocalPath($file),
					'#ADMIN_LINK#' => Admin::getFileManUrl($file),
					'#REGEX_EXPLAIN#' => $var['ORIGINAL'],
					'#REASON#' => Loc::getMessage('INTERVOLGA_EDU.USE_DISPLAY_PROPERTIES_FOR_PROPERTIES'),
				]));
			}
			if (in_array($var['INDEXES'][0], [
				'PROPERTIES',
				'DISPLAY_PROPERTIES'
			])) {
				if ($var['INDEXES'][2] == 'VALUE') {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.CONTENT_FOUND', [
						'#PATH#' => FileSystem::getLocalPath($file),
						'#ADMIN_LINK#' => Admin::getFileManUrl($file),
						'#REGEX_EXPLAIN#' => $var['ORIGINAL'],
						'#REASON#' => Loc::getMessage('INTERVOLGA_EDU.USE_DISPLAY_PROPERTIES_FOR_PROPERTIES_ECHO'),
					]));
				}
			}
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