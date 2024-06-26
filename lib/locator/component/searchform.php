<?php
namespace Intervolga\Edu\Locator\Component;

class SearchForm extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:search.form'];
	}

	public static function getFilter(): array
	{
		return array_merge(parent::getFilter(), ['REAL_PATH' => '/local/templates/.default/%header.php']);
	}
}