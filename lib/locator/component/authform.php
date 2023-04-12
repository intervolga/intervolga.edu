<?php
namespace Intervolga\Edu\Locator\Component;

class AuthForm extends ComponentLocator
{
	public static function getCode(): array
	{
		return ['bitrix:system.auth.form'];
	}
}