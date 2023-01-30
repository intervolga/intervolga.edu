<?php
namespace Intervolga\Edu\Util;

use Intervolga\Edu\Util\FileMessage;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Sniffer;

class TemplateFileChecker
{
	public static function testTemplateFile(File $file)
	{
		$result = Sniffer::run([$file->getPath()], ['templateChecker']);
		if (!empty($result)) {
			foreach ($result as $error) {
				Assert::empty($error, $error->getMessage());
			}
		}

		$quotes = Sniffer::run([$file->getPath()], ['customquotes']);
		foreach ($quotes as $message) {
			if ($message->getMessage()[0] == '\'') {
				$singleQuotes[] = $message->getMessage();
			} else {
				$doubleQuotes[] = $message->getMessage();
			}
		}

		$basicQuotes = static::getCustomQuotes($singleQuotes, $doubleQuotes);
		Assert::true($basicQuotes, Loc::getMessage('INTERVOLGA_EDU.UTIL_TEMPLATE_FILE_CHECKER', [
			'#FILE#' => FileMessage::getFileMessage([
				'#FULL_PATH#' => str_replace($file->getName(), '', FileSystem::getLocalPath($file)),
				'#NAME#' => $file->getName(),
				'#FILEMAN_URL#' => Admin::getFileManUrl($file),
			]),
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
