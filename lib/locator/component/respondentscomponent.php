<?php
namespace Intervolga\Edu\Locator\Component;

class RespondentsComponent extends ComponentLocator
{
	public static function getCode(): array
	{
		return [
			'intervolga:poll_results',
			'intervolga:respondents',
		];
	}
}