<?php
namespace Intervolga\Edu\FilesTree\Component;

use Intervolga\Edu\FilesTree\SimpleComponentTemplate;

class SimpleComponent extends Component
{
	public static function getTemplateTree(): string
	{
		return SimpleComponentTemplate::class;
	}
}