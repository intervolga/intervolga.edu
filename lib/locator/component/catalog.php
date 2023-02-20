<?php
namespace Intervolga\Edu\Locator\Component;

class Catalog extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:catalog'];
	}
}