<?php
namespace Intervolga\Edu\Locator\Component;

class Menu extends ComponentLocator
{
	public static function getFilter(): array
	{
		return [
			'=COMPONENT_NAME' => static::getCode(),
			'%REAL_PATH' => '/local/templates/',
		];
	}

	public static function getCode(): array
	{
		return ['bitrix:menu'];
	}
}