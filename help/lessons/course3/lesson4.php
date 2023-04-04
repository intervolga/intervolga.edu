<?php
B_PROLOG_INCLUDED === true || die();
?>
<ol>
    <li>Ваш пользовательский тип лучше “наследовать” от числового поля (ведь хранить вам нужно именно число -- ID коллекции). А при отображении формы редактирования поля делайте запрос к БД и выводите <span><</span>select>.</li>
    <li>Не забудьте проверить, что поле выводится и редактируется не только на странице раздела/пользователя, но и в списке в панели управления.</li>
    <li>Не забудьте проверить, что поле выводится и редактируется в личном кабинете в профиле пользователя.</li>
    <li>Если поле создано как множественное -- оно должно выглядеть как список множественного выбора.</li>
    <li>Тестируйте своё новое поле на 4-ёх примерах: обычное поле, множественное поле, обязательное поле, множественное обязательное поле.</li>
    <li>Если поле множественное и обязательное -- перед <span><</span>select> нужно вывести hidden с таким же названием (чтобы в случае, если пользователь ничего не стал выбирать на сервер ушло пустое значение).</li>
</ol>
<br>
Поле должно выглядеть так:<br>
<img src="/local/modules/intervolga.edu/help/images/course3lesson4field.png" height="350px"><br>
Вид в панели управления в форме редактирования пользователя.<br>
<img src="/local/modules/intervolga.edu/help/images/course3lesson4manage.png" height="350px"><br>
Вид в панели управления в списке пользователей.<br>
<img src="/local/modules/intervolga.edu/help/images/course3lesson4users.png" height="350px"><br>
Вид в панели управления при редактировании пользователя в списке.<br>
<img src="/local/modules/intervolga.edu/help/images/course3lesson4list.png" height="350px"><br>
Вид в публичной части в компоненте <b>bitrix:main.profile</b>.
