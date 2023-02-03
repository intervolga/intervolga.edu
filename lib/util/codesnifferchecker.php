<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Sniffer;

/**
 * Here will be real PHP Code Sniffer
 */
class CodeSnifferChecker
{
	public static function testTemplateFile($filePaths)
	{
		if(!is_array($filePaths)){
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
		if(!is_array($filePaths)){
			$filePaths = [$filePaths];
		}
		$result = Sniffer::run($filePaths);
		if (!empty($result)) {
			foreach ($result as $error) {
				Assert::empty($error, $error->getMessage());
			}
		}
	}
}
