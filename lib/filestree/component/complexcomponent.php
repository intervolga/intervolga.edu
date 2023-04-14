<?php
namespace Intervolga\Edu\FilesTree\Component;

use Intervolga\Edu\FilesTree\ComplexComponentTemplate;

class ComplexComponent extends Component
{
	public static function getTemplateTree(): string
	{
		return ComplexComponentTemplate::class;
	}
}