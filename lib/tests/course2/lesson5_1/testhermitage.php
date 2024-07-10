<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_1;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\ComponentTemplate\VacanciesListTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Sniffer;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;

class TestHermitage extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(VacanciesListTemplate::class);
		Assert::fseExists(static::getTemplateFile());

		$hermitage = static::getHermitage();
		static::findHermitage($hermitage, 'IBLOCK_ID');
		static::findHermitage($hermitage, 'IBLOCK_SECTION_ID');
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return VacanciesListTemplate::class;
	}

	/**
	 * @return File|null
	 */
	protected static function getTemplateFile(): File
	{
		return FileSystem::getInnerFile(VacanciesListTemplate::find(), 'template.php');
	}

	protected static function getHermitage()
	{
		$hermitage = [];
		$result = Sniffer::run([static::getTemplateFile()->getPath()], ['hermitage']);

		Assert::notEmpty($result,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_5_1_NOT_FOUND_HERMITAGE',
				[
					'#FILE#' => FileMessage::get(static::getTemplateFile()),
					'#EXPECT#' => ''
				])

		);
		foreach ($result as $message) {
			$hermitage[$message->getMessage()] = $message;
		}

		return $hermitage;
	}

	protected static function findHermitage($hermitage, string $expected)
	{
		Assert::notEmpty($hermitage[$expected],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_5_1_NOT_FOUND_HERMITAGE', [
					'#FILE#' => FileMessage::get(static::getTemplateFile()),
					'#EXPECT#' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_5_1_HERMITAGE_' . $expected)
				]
			)
		);
	}
}