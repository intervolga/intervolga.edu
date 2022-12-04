<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;

/**
 * Here will be real PHP Code Sniffer
 */
class Sniffer
{
	public static function testTemplateFile(File $file)
	{
		static::testFile($file);
	}

	public static function testFile(File $file)
	{
		$vars = static::parseVarsWithIndexes($file);
		foreach ($vars as $var) {
			static::checkFieldVar($var, $file);
			static::checkPropertyVar($var, $file);
		}
	}

	protected static function parseVarsWithIndexes(File $file): array
	{
		$result = [];
		$contents = $file->getContents();
		$re = '/(?<VAR>\$[a-z_][a-z_0-9]*)(?<INDEXES>(\[.*?\])+)/i';
		preg_match_all($re, $contents, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			$varInfo = [
				'ORIGINAL' => $match[0],
			];
			$varInfo['VAR'] = $match['VAR'];
			$indexes = explode('][', trim($match['INDEXES'], '[]'));
			foreach ($indexes as $index) {
				$varInfo['INDEXES'][] = trim($index, '"\'');
			}
			$result[] = $varInfo;
		}

		return $result;
	}

	protected static function checkFieldVar(array $var, File $file)
	{
		$indexIsField = (in_array($var['INDEXES'][0], [
			'PREVIEW_TEXT',
			'DETAIL_TEXT',
			'PREVIEW_PICTURE',
			'DETAIL_PICTURE',
			'NAME'
		]));
		if ($indexIsField) {
			Assert::custom(Loc::getMessage(
				'INTERVOLGA_EDU.USE_FIELDS_FOR_FIELDS',
				[
					'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $file->getName(),
						'#PATH#' => FileSystem::getLocalPath($file),
						'#FILEMAN_URL#' => Admin::getFileManUrl($file),
					]),
					'#FIELD#' => $var['INDEXES'][0],
					'#CODE#' => $var['ORIGINAL'],
					'#VAR#' => $var['VAR'],
				]
			));
		}
	}

	protected static function checkPropertyVar(array $var, File $file)
	{
		if ($var['INDEXES'][0] == 'PROPERTIES') {
			Assert::custom(Loc::getMessage('INTERVOLGA_EDU.USE_DISPLAY_PROPERTIES_FOR_PROPERTIES', [
				'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
					'#NAME#' => $file->getName(),
					'#PATH#' => FileSystem::getLocalPath($file),
					'#FILEMAN_URL#' => Admin::getFileManUrl($file),
				]),
				'#PROPERTY#' => $var['INDEXES'][1],
				'#CODE#' => $var['ORIGINAL'],
				'#VAR#' => $var['VAR'],
			]));
		}

		$index0isProperty = in_array($var['INDEXES'][0], [
			'PROPERTIES',
			'DISPLAY_PROPERTIES'
		]);
		$index2isValue = ($var['INDEXES'][2] == 'VALUE');
		if ($index0isProperty && $index2isValue) {
			Assert::custom(Loc::getMessage('INTERVOLGA_EDU.USE_DISPLAY_PROPERTIES_FOR_PROPERTIES_ECHO', [
				'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
					'#NAME#' => $file->getName(),
					'#PATH#' => FileSystem::getLocalPath($file),
					'#FILEMAN_URL#' => Admin::getFileManUrl($file),
				]),
				'#PROPERTY#' => $var['INDEXES'][1],
				'#CODE#' => $var['ORIGINAL'],
				'#VAR#' => $var['VAR'],
			]));
		}
	}
}
