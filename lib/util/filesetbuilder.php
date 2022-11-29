<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

class FilesetBuilder
{
	const NON_PUBLIC_DIRS = [
		'/upload/',
		'/bitrix/',
		'/local/',
	];

	/**
	 * @return Directory
	 */
	public static function getRoot()
	{
		return new Directory(Application::getDocumentRoot());
	}

	/**
	 * @deprecated
	 * @return Fileset
	 */
	public static function getLocalTemplates()
	{
		$root = new Directory(Application::getDocumentRoot() . '/local/templates/');

		return static::getChildrenNonRecursive($root, true, false);
	}

	/**
	 * @deprecated
	 * @return Fileset
	 */
	public static function getLocalTemplatesComponents()
	{
		$result = new Fileset();
		$templateDirs = static::getLocalTemplates();
		foreach ($templateDirs->getFileSystemEntries() as $templateDir) {
			$namespacesDir = new Directory($templateDir->getPath() . '/components/');
			if ($namespacesDir->isExists()) {
				foreach ($namespacesDir->getChildren() as $componentsDir) {
					$result->addFileset(static::getChildrenNonRecursive($componentsDir, true, false));
				}
			}
		}

		return $result;
	}

	/**
	 * @deprecated
	 * @param bool $getDirs
	 * @param bool $getFiles
	 * @return Fileset
	 */
	public static function getLocalTemplatesComponentsInner($getDirs = true, $getFiles = true)
	{
		$result = new Fileset();
		$components = static::getLocalTemplatesComponents();
		foreach ($components->getFileSystemEntries() as $entry) {
			$result->addFileset(static::getChildrenRecursive($entry, true, false));
		}

		return $result;
	}

	/**
	 * @deprecated
	 * @param bool $getDirs
	 * @param bool $getFiles
	 * @return Fileset
	 */
	public static function getPublic($getDirs = true, $getFiles = true)
	{
		$result = new Fileset();
		foreach (static::getRoot()->getChildren() as $child) {
			if ($child->isDirectory()) {
				if (!in_array('/' . $child->getName() . '/', static::NON_PUBLIC_DIRS)) {
					$result->addFileset(static::getChildrenRecursive($child, $getDirs, $getFiles));
					if ($getDirs) {
						$result->add($child);
					}
				}
			} elseif ($getFiles) {
				$result->add($child);
			}
		}

		return $result;
	}

	/**
	 * @deprecated
	 * @param Directory $root
	 * @param bool $getDirs
	 * @param bool $getFiles
	 * @return Fileset
	 */
	protected static function getChildrenNonRecursive($root, $getDirs = true, $getFiles = true)
	{
		$result = new Fileset();
		foreach ($root->getChildren() as $child) {
			if ($child->isDirectory()) {
				if ($getDirs) {
					$result->add($child);
				}
			} elseif ($getFiles) {
				$result->add($child);
			}
		}

		return $result;
	}

	/**
	 * @deprecated
	 * @param Directory $root
	 * @param bool $getDirs
	 * @param bool $getFiles
	 * @return Fileset
	 */
	protected static function getChildrenRecursive($root, $getDirs = true, $getFiles = true)
	{
		$result = new Fileset();
		foreach ($root->getChildren() as $child) {
			if ($child->isDirectory()) {
				$result->addFileset(static::getChildrenRecursive($child, $getDirs, $getFiles));
				if ($getDirs) {
					$result->add($child);
				}
			} elseif ($getFiles) {
				$result->add($child);
			}
		}

		return $result;
	}
}
