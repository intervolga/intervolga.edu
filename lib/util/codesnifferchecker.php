<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Sniffer;
use Intervolga\Edu\Util\FileMessage;

/**
 * Here will be real PHP Code Sniffer
 */
class CodeSnifferChecker
{
	public static function testTemplateFile($filePaths)
	{
		if (!is_array($filePaths)) {
			$filePaths = [$filePaths];
		}
		$result = Sniffer::run($filePaths, ['templateChecker']);
		if (!empty($result)) {
			foreach ($result as $error) {
				Assert::empty($error, $error->getMessage());
			}
		}
	}

	public static function goodCode($filePaths)
	{
		if (!is_array($filePaths)) {
			$filePaths = [$filePaths];
		}
		foreach ($filePaths as $file) {
			$result = Sniffer::run($filePaths);
			if (!empty($result)) {
				foreach ($result as $error) {
					Assert::empty($error, $error->getMessage());
				}
			}
			static::checkCustomQuotes($file);
		}

	}

	public static function checkCustomQuotes($filePath)
	{
		$quotes = Sniffer::run([$filePath], ['customquotes']);
		foreach ($quotes as $message) {
			if ($message->getMessage()[0] == '\'') {
				$singleQuotes[] = $message->getMessage();
			} else {
				$doubleQuotes[] = $message->getMessage();
			}
		}

		$basicQuotes = static::getCustomQuotes($singleQuotes, $doubleQuotes);
		$file = new File($filePath);
		Assert::true($basicQuotes, Loc::getMessage('INTERVOLGA_EDU.UTIL_TEMPLATE_FILE_CHECKER', [
			'#FILE#' => FileMessage::get($file),
			'#QUOTES#' => $basicQuotes['basic'],
			'#WRONG_QUOTES#' => implode(', ', $basicQuotes['wrongLines']),
		]));
	}

	protected static function getCustomQuotes($singleQuotes = [], $doubleQuotes = [])
	{
		$result = false;
		if (!empty($singleQuotes) && empty($doubleQuotes) || empty($singleQuotes) && !empty($doubleQuotes)) {
			return true;
		} elseif ($singleQuotes>$doubleQuotes) {
			$result['basic'] = 'одинарные кавычки (\') ';
			$result['wrongLines'] = $doubleQuotes;
		} else {
			$result['basic'] = 'двойные кавычки (")';
			$result['wrongLines'] = $singleQuotes;
		}

		return $result;
	}
}
