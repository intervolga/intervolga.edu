<?php
namespace Intervolga\Edu\Locator\Component;

class Feedback extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:main.feedback'];
	}
}