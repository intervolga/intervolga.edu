<?php
namespace Intervolga\Edu\FilesTree\Component;

use Intervolga\Edu\FilesTree\ComponentTemplate\RespondentsTemplate;

class RespondentsComponent extends Component
{
	public static function getTemplateTree(): string
	{
		return RespondentsTemplate::class;
	}
}