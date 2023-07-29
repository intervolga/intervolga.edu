<?php
namespace Intervolga\Edu\Asserts;

use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\FilesTree;

class AssertCustomComponent extends Assert
{
	/**
	 * @param string|ComponentLocator $value
	 * @param string $message
	 * @throws AssertException
	 */
	public static function customComponentLocator($value, string $message = '')
	{
		if ($find = $value::find()) {
			static::registerLocatorFound(ComponentLocator::class, $value, $find);
		} else {
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_CUSTOM_COMPONENT_LOCATOR',
				[
					'#COMPONENT#' => $value::getCode(),
				],
				$message
			));
		}
	}

	public static function hasRequiredPhpFiles($value, $componentClass, $count, string $message = '')
	{
		$q = new FilesTree\RespondentsComponentTemplate($value->getPath());
		$nowCount = count($q->getInnerPhpFiles());
		if ($nowCount !== $count)
		{
			static::registerError(static::getCustomOrLocMessage(
				'INTERVOLGA_EDU.ASSERT_CUSTOM_COMPONENT_HASNT_REQUIRED_COUNT_FILES',
				[
					'#COMPONENT#' => $componentClass::getCode(),
					'#COUNT#' => $count,
					'#NOW_COUNT#' => $nowCount
				],
				$message
			));
		}
	}
}
