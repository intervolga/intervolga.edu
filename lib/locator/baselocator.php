<?php
namespace Intervolga\Edu\Locator;

abstract class BaseLocator
{
	abstract public static function getNameLoc(): string;

	abstract public static function getDisplayText($find): string;

	public static function getDisplayHref($find): string
	{
		return '';
	}

	public static function getDisplayName(): string
	{
		return str_replace('Intervolga\Edu\Locator\\', '', get_called_class());
	}
}