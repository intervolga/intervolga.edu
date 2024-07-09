<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\AssertComponent;

class CustomRespondents extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_RESPONDENTS');
	}

	public static function getComponentFile()
	{
		AssertComponent::componentLocator(static::class);
		if (static::find()) {
			foreach (static::find()->getChildren() as $child) {
				if ($child->getName() == 'component.php' || $child->getName() == 'class.php') {
					return $child;
				}
			}
		}

		return [];
	}

	protected static function getPaths(): array
	{
		return [
			'/local/components/intervolga/respondents/',
			'/local/components/intervolga/poll_results/',
		];
	}
}
