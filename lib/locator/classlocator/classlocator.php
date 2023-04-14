<?php
namespace Intervolga\Edu\Locator\ClassLocator;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\BaseLocator;
use ReflectionClass;

abstract class ClassLocator extends BaseLocator
{
	public static function find()
	{
		$result = [];
		if (static::getModule()::find() && Loader::includeModule(static::getModule()::find()->getName())) {
			$classesName = static::getClassesNames();
			foreach ($classesName as $class) {
				if (class_exists($class)) {
					$result = new ReflectionClass($class);;
				}
			}
		}

		return $result;
	}

	abstract static function getModule();

	abstract static function getClassesNames();

	public static function getDisplayText($find): string
	{
		return $find->getName();
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CLASS_CALL', [
			'#CLASS_NAME#' => static::getClassNameLoc(),
			'#MODULE_NAME#' => static::getModule()::find()->getName(),
		]);
	}

	abstract static function getClassNameLoc();

	public static function getPossibleTips(): string
	{
		return implode(' || ', static::getClassNameLoc());
	}
}