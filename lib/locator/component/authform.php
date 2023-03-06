<?php
namespace Intervolga\Edu\Locator\Component;

class AuthForm extends ComponentLocator
{
	public static function getCode(): string
	{
		return 'bitrix:system.auth.form';
	}
}