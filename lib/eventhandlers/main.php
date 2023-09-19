<?php

namespace Intervolga\Edu\Eventhandlers;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class Main
{
    function OnPanelCreateHandler()
    {
        global $APPLICATION;
        $url = '/bitrix/admin/settings.php?lang=ru&mid=intervolga.edu';


        $APPLICATION->AddPanelButton([
            'ID' => '230',
            'TEXT' => Loc::getMessage('INTERVOLGA_EDU.MODULE_NAME'),
            'HREF' => $url,
            'SRC' => '/bitrix/images/intervolga.edu/logo-academy.png',
            'TYPE' => 'BIG',
            'MAIN_SORT' => 1400,
        ]);

    }
}
