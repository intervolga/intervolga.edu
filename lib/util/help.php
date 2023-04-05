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

		return $result;
	}
}
