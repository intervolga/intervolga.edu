<?php
namespace Intervolga\Edu\Locator\Component;

class NewsList extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:news.list'];
	}
}