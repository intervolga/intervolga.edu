<?php
namespace Intervolga\Edu\Locator\Wizard;

class Calculator extends WizardLocator
{
	public static function getWizardCode(): array
	{
		return [
			'intervolga:calculator',
			'custom:calculator',
			'mywizards:calculator'
		];
	}

	public static function getWizardName(): string
	{
		return 'calculator';
	}
}