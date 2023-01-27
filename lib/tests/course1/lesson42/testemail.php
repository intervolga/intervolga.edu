<?php
namespace Intervolga\Edu\Tests\Course1\Lesson42;

use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Mail\Internal\EventMessageTable;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Event\EventMessage\UserPassRequest;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestEmail extends BaseTest
{
	protected static function run()
	{
		$messageText = static::getMessageText();
		Assert::notEmpty($messageText, Loc::getMessage('INTERVOLGA_EDU.USER_PASS_REQUEST_TEXT_PROBLEM'));

		$url = static::getUrlFromText($messageText);
		Assert::notEmpty($url, Loc::getMessage('INTERVOLGA_EDU.USER_PASS_REQUEST_URL_PROBLEM'));

		$filePath = static::urlToFilePath($url);
		$file = FileSystem::getFile($filePath);
		Assert::fseExists($file, Loc::getMessage('INTERVOLGA_EDU.USER_PASS_REQUEST_PAGE_PROBLEM'));
	}

	protected static function getMessageText(): string
	{
		$record = UserPassRequest::find();
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