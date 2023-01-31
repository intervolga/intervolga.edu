<?php
namespace Intervolga\Edu\Locator\IO;


use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileSystem;

class CustomComponent extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_COMPONENT');
	}

	protected static function getPaths(): array
	{
		return [
			'/local/components/custom/vacancies.list',
			'/local/components/custom/vacancy.list',
			'/local/components/mycomponents/vacancies.list',
		];
	}
	public static function getComponentFilePath()
	{
		if (FileSystem::getInnerFile(static::find(), 'component.php')->isExists()) {
			$path = FileSystem::getLocalPath(FileSystem::getInnerFile(static::find(), 'component.php'));
			return new File($path);
		} elseif (FileSystem::getInnerFile(static::find(), 'class.php')->isExists()) {
			$path = FileSystem::getLocalPath(FileSystem::getInnerFile(static::find(), 'class.php'));
			return new File($path);
		}
		return false;
	}

	public static function getParametersFilePath()
	{
		if (FileSystem::getInnerFile(static::find(), '.parameters.php')->isExists()) {
			$path = FileSystem::getLocalPath(FileSystem::getInnerFile(static::find(), '.parameters.php'));
			return new File($path);
		}
		return false;
	}
}
