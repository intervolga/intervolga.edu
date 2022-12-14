<?php
namespace Intervolga\Edu\Locator\UserField;

class Media extends UserFieldLocator
{

	protected static function rules(): array
	{
		return [
			[
				"MANDATORY" => "N",
				"MULTIPLE" => "N"
			],
			[
				"MANDATORY" => "N",
				"MULTIPLE" => "Y"
			],
			[
				"MANDATORY" => "Y",
				"MULTIPLE" => "N"
			],
			[
				"MANDATORY" => "Y",
				"MULTIPLE" => "Y"
			],
		];
	}

	public static function getRules(): array
	{
		return static::rules() ?? [];
	}
}