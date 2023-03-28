<?php
namespace Intervolga\Edu\Locator\Component;

class Desktop extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:desktop'];
	}

	public static function getFilter(): array
	{
		return array_merge(parent::getFilter(), ['=REAL_PATH' => '/desktop.php']);
	}
}