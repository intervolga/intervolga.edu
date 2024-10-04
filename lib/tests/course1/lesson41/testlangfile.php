<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\ComponentTemplate\BottomMenuTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestLangFile extends BaseTest
{
	//Здесь нет смысла строгой проверки файлов, она выполнена в TestBottomMenu
	protected static function run()
	{
		Assert::directoryLocator(BottomMenuTemplate::class);
		if (BottomMenuTemplate::find()) {
			foreach (BottomMenuTemplate::find()->getChildren() as $child) {
				if ($child->isFile()) {
					Assert::fileContentNotMatches(
						$child,
						new Regex('/[а-яё]+/iu',
							Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_41.FOUND_RU_WORDS'))
					);
				}
			}
		}
		Assert::fseExists($langFile = new File(BottomMenuTemplate::find()->getPath() . '/lang/ru/template.php'));
		if ($langFile->isExists()) {
			Assert::fileContentMatches($langFile, new Regex('/О магазине/iu', 'О магазине'),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_41.NOT_FOUND_PHRASE'));
		}
	}
	public static function interceptErrors()
	{
		return true;
	}
}
