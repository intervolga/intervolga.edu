<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Exception;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Tool\ORM\EduTestTable;

Loc::loadMessages(__FILE__);

abstract class BaseTest
{
	public static function getCourseLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()));
	}

	public static function getCourseCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[0]);
	}

	public static function getLessonLoc(): string
	{
		$code = 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode());
		$loc = Loc::getMessage($code);
		if (mb_strlen($loc)) {
			return $loc;
		} else {
			return '&lt;' . $code . '&gt;';
		}
	}

	public static function getLessonCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[1]);
	}

	public static function getTestLoc(): string
	{
		$code = static::getTestLocCode();
		$loc = Loc::getMessage($code);
		if (mb_strlen($loc)) {
			return $loc;
		} else {
			return '&lt;' . $code . '&gt;';
		}
	}

	protected static function getTestLocCode(): string
	{
		return 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode()) . '_' . mb_strtoupper(static::getTestCode());
	}

	public static function getTestCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return preg_replace('/^Test/', '', $tmpArray[2]);
	}

	public static function getDescription(): string
	{
		$code = static::getTestLocCode() . '_DESCRIPTION';
		$loc = Loc::getMessage($code);
		if (mb_strlen($loc)) {
			return $loc;
		} else {
			return '';
		}
	}

	public static function hasInputText(): string
	{
		return '';
	}

	public static function countInputImage(): bool
	{
		return false;
	}

	/**
	 * @throws AssertException
	 * @throws Exception
	 */
	public static function runOuter()
	{
		if (static::interceptErrors()) {
			Assert::interceptErrorsOn();
		}
		static::run();
		if (static::interceptErrors()) {
			Assert::interceptErrorsOff();
			Assert::throwIntercepted();
		}
		if (static::checkLastResult()) {
			static::saveLastResult();
		}
	}

	/**
	 * @return bool
	 */
	public static function interceptErrors()
	{
		return false;
	}

	/**
	 * @throws AssertException
	 */
	protected static function run()
	{
		Assert::true(false, 'Not implemented yet');
	}

	public static function checkLastResult(): bool
	{
		return false;
	}

	/**
	 * @throws Exception
	 */
	protected static function saveLastResult()
	{
		if ($class = static::class) {
			EduTestTable::addPassedTest($class);
		}
	}
}