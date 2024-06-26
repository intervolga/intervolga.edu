<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Sniffer;

/**
 * Here will be real PHP Code Sniffer
 */
class CodeSnifferChecker
{
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
		if(!empty($basicQuotes) && $basicQuotes['wrongLines']){
			Assert::empty($basicQuotes['wrongLines'], Loc::getMessage('INTERVOLGA_EDU.UTIL_TEMPLATE_FILE_CHECKER', [
				'#FILE#' => FileMessage::get($file),
				'#QUOTES#' => $basicQuotes['basic'],
				'#WRONG_QUOTES#' => implode(', ', $basicQuotes['wrongLines']),
			]));
		}

	}

	protected static function getCustomQuotes($singleQuotes = [], $doubleQuotes = [])
	{
		$result = false;
		if (!empty($singleQuotes) && empty($doubleQuotes) || $singleQuotes>$doubleQuotes) {
			$result['basic'] = 'одинарные кавычки (\') ';
			$result['wrongLines'] = $doubleQuotes;
		} else if(empty($singleQuotes) && !empty($doubleQuotes)) {
			$result['basic'] = 'двойные кавычки (")';
			$result['wrongLines'] = $singleQuotes;
		}

		return $result;
	}
}
