<?php
namespace Intervolga\Edu\Tests\Course1\Lesson42;

use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Mail\Internal\EventMessageTable;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestEmail extends BaseTest
{
	public static function run()
	{
		if ($messageText = static::getMessageText()) {
			if ($url = static::getUrlFromText($messageText)) {
				$filePath = static::urlToFilePath($url);
				$file = FileSystem::getFile($filePath);
				static::registerErrorIfFileSystemEntryLost($file, Loc::getMessage('INTERVOLGA_EDU.USER_PASS_REQUEST_PAGE_PROBLEM'));
			}
			else {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.USER_PASS_REQUEST_URL_PROBLEM'));
			}
		}
		else {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.USER_PASS_REQUEST_TEXT_PROBLEM'));
		}
	}

	protected static function getMessageText(): string
	{
		$record = EventMessageTable::getList([
			'filter' => [
				'=EVENT_NAME' => 'USER_PASS_REQUEST',
				'=ACTIVE' => 'Y',
			],
		])->fetch();
		$replace = [
			'#SERVER_NAME#' => Context::getCurrent()->getServer()->getServerName(),
			'#CHECKWORD#' => 'CHECKWORD',
			'#URL_LOGIN#' => 'URL_LOGIN',
		];

		return str_replace(array_keys($replace), $replace, $record['MESSAGE']);;
	}

	protected static function getUrlFromText(string $messageText): string
	{
		$result = '';
		$re = '/https?:\/\/(?:www\.)?[-a-z0-9@:%._\+~#=]{1,256}\.[a-z0-9()]{1,6}\b(?:[-a-z0-9()@:%_\+.~#?&\/=]*)/i';
		preg_match_all($re, $messageText, $matches, PREG_SET_ORDER);
		if ($matches) {
			$result = $matches[0][0];
		}

		return $result;
	}

	protected static function urlToFilePath(string $url): string
	{
		$result = '';
		$parsed = parse_url($url);
		if ($parsed) {
			if (mb_substr_count($parsed['path'], '.php')) {
				$result = $parsed['path'];
			} else {
				$result = $parsed['path'];
				if (mb_substr($parsed['path'], -1, 1) != '/') {
					$result .= '/';
				}
				$result .= 'index.php';
			}

		}

		return $result;
	}
}