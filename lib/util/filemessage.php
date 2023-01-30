<?php
namespace Intervolga\Edu\Util;

class FileMessage
{
	public static function getFileMessage($replace = null):string{
		$message = '#FULL_PATH#<a href="#FILEMAN_URL#" target="_blank" id="#FULL_PATH##NAME#" ><b>#NAME#</b></a> <button title="копировать путь для PhpStorm" class="iv-copy-link"></button>';

		if (is_array($replace))
		{
			$message = strtr($message, $replace);
		}
		return $message;
	}
}