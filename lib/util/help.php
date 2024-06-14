<?php
namespace Intervolga\Edu\Util;

class Help
{
	public static function get(string $course, string $lesson): string
	{
		$result = '';
		$file = FileSystem::getFile(IV_EDU_MODULE_DIR . '/help/lessons/' . $course . '/' . $lesson . '.php');
		if ($file->isExists()) {
			ob_start();
			include $file->getPath();
			$result = ob_get_clean();
		}

		return static::convertFrom1251Possible($result);
	}

	protected static function convertFrom1251Possible(string $text): string
	{
		$isMarketplaceInstallation = (IV_EDU_MODULE_DIR == '/bitrix/modules/intervolga.edu');

		if ($isMarketplaceInstallation && mb_detect_encoding($text) !== 'UTF-8')
		{
			$text = iconv('cp1251', 'UTF8', $text);
		}
		return $text;
	}
}
