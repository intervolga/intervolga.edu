<?php
namespace Intervolga\Edu\Locator\Component;

class Desktop extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:desktop'];
	}
}