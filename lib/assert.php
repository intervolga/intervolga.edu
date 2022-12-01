<?php
namespace Intervolga\Edu;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\AssertException;

Loc::loadMessages(__FILE__);

class Assert
{
	/**
	 * @param mixed $value
	 * @param mixed $expect
	 * @param string $message
	 * @throws AssertException
	 */
	public static function eq($value, $expect, string $message = '')
	{
		if ($value != $expect) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_EQUAL',
				[
					'#VALUE#' => static::valueToString($value),
					'#EXPECT#' => static::valueToString($expect),
				],
				$message
			));
		}
	}

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function notEmpty($value, string $message = '')
	{
		if (empty($value)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_NOT_EMPTY',
				[
					'#VALUE#' => static::valueToString($value),
				],
				$message
			));
		}
	}

	/**
	 * @param $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function empty($value, string $message = '')
	{
		if (!empty($value)) {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_EMPTY',
				[
					'#VALUE#' => static::valueToString($value),
				],
				$message
			));
		}
	}

	protected static function valueToString($value): string
	{
		return var_export($value, true);
	}

	protected static function getCustomOrLocMessage(string $locCode, array $replace, $customMessage = ''): string
	{
		if ($customMessage) {
			$result = strtr($customMessage, $replace);
		} else {
			$result = Loc::getMessage($locCode, $replace);
		}

		return $result;
	}

	/**
	 * @param string $error
	 * @throws AssertException
	 */
	protected static function registerError(string $error)
	{
		throw new AssertException($error);
	}
}
