<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Template\Slider;
use Intervolga\Edu\Locator\IO\ComponentTemplate\SliderTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestSliderCodeAnalysis extends BaseTest
{
	const REG_GET_LIST = '/(foreach|while)+\s*([\w\s\d$=\-:()[\]\.;,><\'\"]*\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*(\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*\})+|[\w\s\d{$=\-:()[\]\.;,><\'\"])*getList\(/i';
	const REG_GET_LIST_COUNT = '/([\w\s\d{}$=\-:()[\]\.;,><\'\"]*GetList){2,}/i';
	const REG_RESIZE_IMAGE = '/(foreach|while)+\s*([\w\s\d$=\-:()[\]\.;,><\'\"]*\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*(\{[\w\s\d{$=\-:()[\]\.;,><\'\"]*\})+|[\w\s\d{$=\-:()[\]\.;,><\'\"])*ResizeImageGet\(/i';

	protected static function run()
	{
		AssertComponent::componentLocator(Slider::class);
		Assert::directoryLocator(SliderTemplate::class);
		if ($directory = SliderTemplate::find()) {
			$file = FileSystem::getInnerFile($directory, 'result_modifier.php');
			Assert::fileContentMatches($file, new Regex('/LINK_IBLOCK_ID/i', 'LINK_IBLOCK_ID'));
			Assert::fileContentNotMatches($file, new Regex('/nPageSize/i', 'nPageSize'));
			Assert::fileContentNotMatches($file, new Regex('/GetNextELement/i', 'GetNextELement'));

			Assert::fileContentNotMatches($file, new Regex(static::REG_GET_LIST,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.REG_GET_LIST')));
			Assert::fileContentMatches($file, new Regex(static::REG_RESIZE_IMAGE,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.REG_RESIZE_IMAGE')));
			Assert::fileContentNotMatches($file, new Regex(static::REG_GET_LIST_COUNT,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.REG_GET_LIST_COUNT')));
		}
	}
}