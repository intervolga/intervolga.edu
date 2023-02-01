<?php
namespace Intervolga\Edu\Util;

class FileMessage
{
	public static function getFileMessage($replace = [
		'#FULL_PATH#' => '',
		'#NAME#' => '',
		'#FILEMAN_URL#' => ''
	], $directory = false
	): string
	{
		$message = '<a href="#FILEMAN_URL#" target="_blank"> #FULL_PATH#<b>#NAME#</b>' . ($directory ? '/' : '') . '</a><button data-url="#FULL_PATH##NAME#" title="копировать путь для PhpStorm" class="iv-copy-link"></button>';
		if (is_array($replace)) {
			$replace['#FULL_PATH#'] = str_replace($replace['#NAME#'] . ($directory ? '/' : ''), '', $replace['#FULL_PATH#']);
			$message = strtr($message, $replace);
		}

		return $message;
	}
}