<?php
B_PROLOG_INCLUDED === true || die();
?>
<ol>
    <li>Если вывод статистики не работает через определение константы  define("BX_COMPOSITE_DEBUG", true), то для сбора статистики в новых версиях можно воспользоваться страницей <a href="/bitrix/admin/composite_log.php">/bitrix/admin/composite_log.php</a>.</li>
    <li>Если не работает setAnimation из старого ядра, то надо использовать класс нового ядра D7 \Bitrix\Main\Composite\StaticArea.</li>
</ol>
