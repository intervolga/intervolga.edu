<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\Sniffer;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;

class TestLang extends BaseTest
{
	const RU = 'ru';
	const EN = 'en';
	const LANG_DEFINITION = 'langDefinition';
	const LANG_USAGE = 'langUsage';
	const FOOTER = 'footer.php';
	const HEADER = 'header.php';
	const LANG_DIR = '/local/templates/.default/include/lang/';
	const INCLUDE_DIR = '/local/templates/.default/include/';
	const NEEDED_STRING_FOOTER = [
		'CONTACT_INFO',
		'WORKING_TIME',
		'COPYRIGHT_INFO',
	];
	const NEEDED_STRING_HEADER = [
		'WORKING_TIME',
	];

	protected static function checkLangFileDiscrepancy($fileName)
	{

		$ruStrings = static::getMessageLang($fileName, static::LANG_DIR, static::LANG_DEFINITION, static::RU);
		$enStrings = static::getMessageLang($fileName, static::LANG_DIR, static::LANG_DEFINITION, static::EN);

		foreach ($ruStrings as $ru) {
			Assert::true(in_array($ru, $enStrings),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_NOT_FOUND_USAGE_STRING',
					[
						'#FILE#' => FileMessage::get(
							new File(Application::getDocumentRoot() . static::LANG_DIR . 'en/' . $fileName)
						),
						'#VALUE#' => $ru
					]
				)
			);
		}
	}

	protected static function getMessageLang(string $fileName, string $directory, string $standart, string $lang = '')
	{
		$result = [];
		$path = Application::getDocumentRoot() . $directory . $lang . '/' . $fileName;
		$messages = Sniffer::run([$path], [$standart]);
		foreach ($messages as $message) {
			$result[] = mb_strcut($message->getMessage(), 1, -1);
		}

		return $result;
	}

	protected static function run()
	{
		static::check(static::HEADER, static::NEEDED_STRING_HEADER);
		static::check(static::FOOTER, static::NEEDED_STRING_FOOTER);
	}

	protected static function check($filename, $neededString)
	{
		static::stringChecker($filename, $neededString);
		static::usageCheck($filename);
		static::checkLangFileDiscrepancy($filename);
	}

	protected static function stringChecker($fileName, $neededString)
	{
		$strings = static::getMessageLang($fileName, static::LANG_DIR, static::LANG_DEFINITION, static::RU);
		foreach ($strings as $string) {
			Assert::true(in_array($string, $neededString),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_UNKNOWN_STRING',
					[
						'#FILE#' => FileMessage::get(
							new File(Application::getDocumentRoot() . static::LANG_DIR . 'ru/' . $fileName)
						),
						'#VALUE#' => $string
					]
				)
			);
		}
		Assert::empty($diff = array_diff($neededString, $strings),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_NOT_FOUND_STRING',
				[
					'#FILE#' => FileMessage::get(
						new File(Application::getDocumentRoot() . static::LANG_DIR . 'ru/' . $fileName)
					),
					'#VALUE#' => implode(' || ', $diff)
				]
			)
		);
	}

	protected static function usageCheck($fileName)
	{
		$usage = static::getMessageLang($fileName, static::INCLUDE_DIR, static::LANG_USAGE);
		$strings = static::getMessageLang($fileName, static::LANG_DIR, static::LANG_DEFINITION, static::RU);
		foreach ($strings as $message) {
			Assert::true(in_array($message, $usage),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_NOT_FOUND_USAGE_STRING',
					[
						'#FILE#' => FileMessage::get(
							new File(Application::getDocumentRoot() . static::INCLUDE_DIR . $fileName)
						),
						'#VALUE#' => $message
					]
				)
			);
		}
	}
}