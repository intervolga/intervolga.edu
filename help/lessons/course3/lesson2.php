<?php
B_PROLOG_INCLUDED === true || die();
?>
Сложный урок, который имеет массу подводных камней. Одна из основных проблем этого урока - научиться правильно “раскладывать” классы по папкам модуля.
<br>Какая структура файлов считается правильной в этом уроке:
<table>
    <tr>
        <th>Путь от корня модуля</th>
        <th>Название класса</th>
        <th>Примечания</th>
    </tr>
    <tr>
        <td> /classes/general/test.php</td>
        <td> CAllIntervolgaMymoduleTest</td>
        <td>
            Абстрактный класс, объявляет пустые методы: <br>
            Add <br>
            Update <br>
            Delete <br>
            GetList
        </td>
    </tr>
    <tr>
        <td>/classes/mysql/test.php</td>
        <td>CIntervolgaMymoduleTest</td>
        <td>Наследник CAllIntervolgaMymoduleTest <br>
            Реализует методы<br>
            Add<br>
            Update<br>
            Delete<br>
            GetList
        </td>
    </tr>
    <tr>
        <td>/classes/general/eventhandlers/main.php</td>
        <td>CIntervolgaMymoduleEventHandlersMain</td>
        <td>Содержит методы-обработчики событий модуля main:<br>OnProlog</td>
    </tr>
</table>
<br>
<h4>Итак, правила создания классов в модулях “старого” образца + общие принципы создания классов</h4>
<ol>
    <li>Каждый класс должен иметь только 1 “ответственность” (<a href="https://ru.wikipedia.org/wiki/Принцип_единственной_ответственности">The Single Responsibility Principle, SRP)</a> - работать только с 1 таблицей БД или делать только 1 дело. При этом делать он это должен хорошо.</li>
    <li>Все классы создаются в поддиректории модуля classes.</li>
    <li>В classes предполагается несколько поддиректорий:
        <ul>
            <li><b>general</b> - для классов, не использующих прямые запросы к БД</li>
            <li><b>mysql</b> - для классов, реализующих запросы к БД в СУБД Mysql</li>
            <li><b>mssql</b> - для классов, реализующих запросы к БД в СУБД Mssql</li>
            <li><b>oracle</b> - для классов, реализующих запросы к БД в СУБД Oracle</li>
            <li>и пр.</li>
        </ul>
    </li>
    <li>Мы будем использовать только  <b>classes/general</b> и <b>classes/mysql</b>.</li>
    <li>Название класса != Названию файла с классом! Класс <b>CIntervolgaMymoduleTestTable</b> должен лежать в файле test.php (выкидываем имя модуля, префикс С и слово Table)</li>
    <li>С-классы из <b>classes/mysql</b> - наследники соответствующих CAll-классов из <b>classes/general</b>.</li>
    <li>В одном файле должен быть объявлен только один класс.</li>
    <li>Названия классов формируются по схеме:
        <ul>
            <li>
        <b>CAll<span><</span>НазваниеМодуля><span><</span>НазваниеТаблицы></b> для <b>classes/general</b>, например CAllIntervolgaMymoduleTest, CAllForumMessage, CAllCatalogGroup
            </li>
        <li><b>C<span><</span>НазваниеМодуля><span><</span>НазваниеТаблицы></b> для <b>classes/mysql</b>, например CIntervolgaMymoduleTest, CForumMessage, CCatalogGroup</li
        </ul>
    </li>
    <li>Если класс не работает с БД, можно сразу писать код в general, не производя разделение по папкам.</li>
    <li>Класс-обработчик событий должен быть отдельным классом и лежать в <b>classes/general</b>.</li>
</ol>
<br>
<h4>Рекомендации по данному уроку:</h4>
<ol>
    <li>Это важно для страницы списка - ваш GetList должен возвращать объект класса CDBResult, не массив!</li>
    <li>Для подключения обработчиков событий при установке модуля используйте <a href="https://dev.1c-bitrix.ru/api_help/main/functions/module/registermoduledependences.php"> эту функцию</a>.</li>
    <li>На странице списка есть несколько неочевидных для программиста нюансов:
        <ul>
            <li>Ни в коем случае не создавайте переменные с названием $by и $order - их использует Битрикс в своих недрах и, перезаписывая их, вы рискуете сломать сортировку.</li>
            <li>Не забывайте подключить свой модуль на странице.</li>
            <li>В конструктор класса CAdminResult нужно передать результат вашего GetList’а - результат должен быть объектом CDBResult, чтобы работала постраничная навигация.</li>
        </ul>
    </li>
    <li>Метод Add в вашем классе должен быть динамическим и вызывать $DB->Add</li>
    <li>Метод Update в вашем классе должен быть динамическим и вызывать $DB->PrepareUpdate, $DB->Query</li>
    <li>Метод Delete в вашем классе должен быть динамическим и вызывать $DB->Query</li>
    <li>Метод GetList в вашем классе должен быть статическим. В нём вы конструируете SQL-запрос в виде строки на основе полученных параметров и выполняете его через $DB->Query.</li>
    <li>Во втором задании вас попросят написать “обработчики” для кнопок "Сохранить" и "Применить". Речь не про обработчики событий (AddEventHandler)! Имеется в виду просто написать PHP-код, который будет срабатывать после нажатия этих кнопок.</li>
</ol>
<br>
<div style="border: 1px dashed black; border-radius: 10px; stroke-dasharray: 5 2; padding: 10px 20px">
    <i>Цитаты великих людей</i><br>
    В какой-то момент можно долго пытаться понять, почему эти методы выкидывают MySQL Error - все ключи, которые туда передаются, должны быть в нижнем регистре (в задании просят названия полей писать капсом). В таком случае ошибок не будет.
    <br><br>
    Еще один неочевидный момент, с которым можно столкнуться, если писать это все на D7. <br>
    При загрузке кода страницы, сервер не сразу подгружает Битрикс. Какое-то время работает чистый php, соответственно, если в самом начале страницы пытаться подключить какой-либо файл с помощью getDocumentRoot - неизбежна 500 ошибка.<br>
    Поэтому, первое подключение придется делать силами чистого PHP.<br>
    <img src="/bitrix/images/intervolga.edu/course3lesson2.png" height="340px">
    <br><br>
    <i>Цитаты великих людей</i>

    В этом уроке очень трудно разобраться. В примерах, указанных <a href="https://dev.1c-bitrix.ru/api_help/main/general/admin.section/index.php">в документации</a> очень трудно разобраться. Проблемы, которые я испытал:
    Нету исходного кода класса рубрики (маловажно)
    Скрыта реализация получения get и post параметров (скорее всего, реализация где-то в инклуде или прологе была заложена - непонятно) Например, было трудно разобраться откуда взялся $FIELDS или $ID.
    Очень помог <a href="https://academy.1c-bitrix.ru/training/course/7507/">курс</a>. Намного интереснее скучной админки, но без заданий
    Небольшую сложность составило применение методов для инсталяции/деинсталяции своих обработчиков событий
    Очень сгодился бы пример реализации класса для запроса в БД, так постоянно задаешься вопросом, а не грязно ли ты поступаешь.
    Для корректного отображения меню не нужно добавлять include и require в код страничек. Иначе не работает подсветка страничек меню модуля

</div>