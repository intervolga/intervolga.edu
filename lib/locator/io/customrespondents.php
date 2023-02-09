<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class CustomRespondents extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_RESPONDENTS');
	}

	protected static function getPaths(): array
	{
		$paths = [];
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['CUSTOM_COMPONENTS'] as $customComponent) {
			$paths[] = '/local/components/' . $customComponent . '/respondents';
		}

		return $paths;
	}
	public  static function getComponentFile(){
		foreach (static::find()->getChildren() as $child){
			if($child->getName() == 'component.php' || $child->getName() == 'class.php'){
				return $child;
			}
		}
		return [];
	}
}
