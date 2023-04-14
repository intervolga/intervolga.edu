<?php
namespace Intervolga\Edu\Locator\Event\Template;

use Intervolga\Edu\Locator\Event\Type\PasswordRequestType;
use Intervolga\Edu\Locator\Event\Type\TypeLocator;

class PasswordRequestTemplate extends TemplateLocator
{
	/**
	 * @return string|TypeLocator
	 */
	public static function getTypeLocator(): string
	{
		return PasswordRequestType::class;
	}

	public static function getNameLoc(): string
	{
		$class = static::getTypeLocator();
		return $class::getNameLoc();
	}
}