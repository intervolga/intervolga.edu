<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Sniffer;

/**
 * Here will be real PHP Code Sniffer
 */
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
	}

}
