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
					'#VALUE#' => $value,
					'#EXPECT#' => $expect,
				],
				$message
			));
		}
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
