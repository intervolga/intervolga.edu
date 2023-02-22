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
	const INCLUDE_DIR = '/local/templates/.default/include/lang/';

	public static function interceptErrors()
	{
		return true;
	}

	protected static function checkLangFileDiscrepancy($fileName)
	{

		$ruStrings = static::getMessageLang($fileName, static::RU);
		$enStrings = static::getMessageLang($fileName, static::EN);

		foreach ($ruStrings as $ru) {
			Assert::true(in_array($ru, $enStrings),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_NOT_FOUND_STRING_EN',
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

	protected static function getMessageLang(string $fileName, string $lang, string $standart)
	{
		$result = [];
		$path = Application::getDocumentRoot() . static::LANG_DIR . $lang . '/' . $fileName;
		$messages = Sniffer::run([$path], [$standart]);
		foreach ($messages as $message) {
			$result[] = mb_strcut($message->getMessage(), 1, -1);
		}

		return $result;
	}

	protected static function run()
	{

		static::checkLangFileDiscrepancy(static::HEADER);
		static::checkLangFileDiscrepancy(static::FOOTER);
	}

	protected static function usageCheck($fileName)
	{
		$usage = static::getMessageLang($fileName, static::RU, static::LANG_USAGE);
		$strings = static::getMessageLang($fileName, static::RU, static::LANG_DEFINITION);
		foreach ($strings as $message) {
			Assert::true(in_array($message, $usage),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3_NOT_FOUND_USAGE_STRING',//в файле ** не используется **
					[
						'#FILE#' => FileMessage::get(
							new File(Application::getDocumentRoot() . static::LANG_DIR . 'en/' . $fileName)
						),
						'#VALUE#' => $message
					]
				)
			);
		}
	}

	protected static function getLangArrayTemplateDir(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getKnownFiles() as $template) {
			$result = Sniffer::run([$template->getPath()], ['langUsage']);
			foreach ($result as $message) {
				$newTest[] = mb_strcut($message->getMessage(), 1, -1);
			}
		}

		return $newTest;
	}
}