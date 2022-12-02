<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\AssertException;

Loc::loadMessages(__FILE__);

abstract class BaseTest
{
	protected static $errors = [];

	public static function getCourseCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[0]);
	}

	public static function getCourseLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()));
	}

	public static function getLessonCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return strtolower($tmpArray[1]);
	}

	public static function getLessonLoc(): string
	{
		$code = 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode());
		$loc = Loc::getMessage($code);
		if (mb_strlen($loc)) {
			return $loc;
		} else {
			return $code;
		}
	}

	public static function getTestCode(): string
	{
		$class = get_called_class();
		$tmp = str_replace('Intervolga\\Edu\\Tests\\', '', $class);
		$tmpArray = explode('\\', $tmp);

		return preg_replace('/^Test/', '', $tmpArray[2]);
	}

	public static function getTestLoc(): string
	{
		$code = 'INTERVOLGA_EDU.' . mb_strtoupper(static::getCourseCode()) . '_' . mb_strtoupper(static::getLessonCode()) . '_' . mb_strtoupper(static::getTestCode());
		$loc = Loc::getMessage($code);
		if (mb_strlen($loc)) {
			return $loc;
		} else {
			return $code;
		}
	}

	/**
	 * @deprecated remove when asserts will be everywhere
	 * @throws AssertException
	 */
	public static function runSafe()
	{
		try {
			static::run();
		} catch (AssertException $exception) {
			throw $exception;
		} catch (\Throwable $throwable) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.THROWABLE',
				[
					'#TYPE#' => get_class($throwable),
					'#ERROR#' => $throwable->getMessage(),
					'#TRACE#' => $throwable->getTraceAsString()
				]
			));
		}
	}

	public static function run()
	{
		static::registerError('Not implemented yet');
	}

	/**
	 * @deprecated remove when asserts will be everywhere
	 * @param string $error
	 */
	protected static function registerError($error)
	{
		static::$errors[get_called_class()][] = $error;
	}

	/**
	 * @deprecated remove when asserts will be everywhere
	 * @return string[]
	 */
	public static function getErrors()
	{
		return (array)static::$errors[get_called_class()];
	}
}