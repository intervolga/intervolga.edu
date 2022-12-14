<?php

namespace Intervolga\Edu\Locator\Component;

class NewsList extends ComponentLocator
{

	public static function getFilter(): array
	{
		return ['=COMPONENT_NAME' => 'bitrix:news.list'];
	}
}