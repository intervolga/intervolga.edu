<?php
namespace Intervolga\Edu\Locator\Component;

class IncludeArea extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:main.include'];
	}
}