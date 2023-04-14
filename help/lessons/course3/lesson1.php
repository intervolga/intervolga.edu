<?php
B_PROLOG_INCLUDED === true || die();
?>
<ol>
    <li>Создавая модуль, запомните: его название должно иметь общий вид <span><</span>код партнера>.<span><</span>смысловое
        название модуля>. Поэтому <b>mymodule</b> - плохое название, а <b>intervolga.mymodule</b> - хорошее. Все
        системные модули
        отображаются на странице <a
                href="/bitrix/admin/module_admin.php?lang=ru">/bitrix/admin/module_admin.php?lang=ru</a>, а партнерские
        - <a href="/bitrix/admin/partner_modules.php?lang=ru">/bitrix/admin/partner_modules.php?lang=ru</a>.
    </li>
    <li>В партнёрских модулях (а вы теперь партнёры компании «1С-Битрикс») названия таблиц должны в идеале быть такими:
        <b><span><</span>код партнера>_<span><</span>смысловое название модуля>_<span><</span>название сущности></b>,
        например <b>intervolga_mymodule_test</b>. Слово table в названии таблицы, как правило, лишнее (если только это
        не таблица для хранения таблиц или столов, тогда конечно).
    </li>
</ol>
