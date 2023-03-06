<?php
namespace Intervolga\Edu\Locator\ClassLocator;

use Intervolga\Edu\Locator\IO\CustomModule;

class CustomModuleParentTable extends ClassLocator
{
	static function getClassesNames()
	{
		return [
			'CAllIntervolga' . ucfirst(static::getPrepareModuleName()) . 'Table',
		];
	}

	static function getPrepareModuleName()
	{
		return str_replace('intervolga.', '',static::getModule()::find()->getName());
	}

	static function getClassNameLoc()
	{
		return static::getModule()::find() ? static::getClassesNames() : ['intervolga.?'];
	}

	static function getModule()
	{
		return CustomModule::class;
	}
}