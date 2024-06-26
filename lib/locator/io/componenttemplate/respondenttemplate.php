<?php

namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\CustomRespondents;

class RespondentTemplate extends DirectoryLocator
{
    public static function getNameLoc(): string
    {
        return Loc::getMessage('INTERVOLGA_EDU.LOCATOR_IO_RESPONDENT_TEMPLATE');
    }

    protected static function getRootLocator()
    {
        return CustomRespondents::class;
    }

    protected static function getPaths(): array
    {
        $paths = ['/templates/.default/'];

        return $paths;
    }
}