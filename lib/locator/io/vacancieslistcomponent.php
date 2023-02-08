<?php
namespace Intervolga\Edu\Locator\IO;


use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileSystem;

class VacanciesListComponent extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.VACANCIES_LIST_COMPONENT');
	}

	protected static function getPaths(): array
	{
		return [
			'/local/components/intervolga/vacancies.list/',
			'/local/components/intervolga/vacancy.list/',
			'/local/components/intervolga/vacancies.list/',
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
