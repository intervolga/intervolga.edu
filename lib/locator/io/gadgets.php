<?php
namespace Intervolga\Edu\Locator\IO;

class Gadgets extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return 'gadgets';
	}

	protected static function getPaths(): array
	{
		return [
			'/local/gadgets/intervolga/resume/',
			'/local/gadgets/intervolga/resumes/',
			'/local/gadgets/intervolga/list_resumes/',
		];
	}
}