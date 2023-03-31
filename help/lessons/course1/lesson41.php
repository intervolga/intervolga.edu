<?php
B_PROLOG_INCLUDED === true || die();
?>
Начиная с этого урока курсанты допускают одну ошибку, а именно оставлять неиспользуемые файлы шаблонов. <br><b>Вот некоторый список из них:</b>
<ul>
	<li><b>lang-файлы.</b> После окончания работы с шаблоном проверьте, какие lang-строки вы используете, а какие нет. Все лишние удалите. Если lang-файл останется после этого пустым - удалите и его.</li>
	<li><b>css-файлы.</b> На практике верстку очень редко разбивают на файлы и обычно весь важный css сосредоточен в одном файле в шаблоне сайта</li>
	<li><b>js-файлы.</b></li>
	<li><b>изображения-файлы.</b></li>
	<li><b>файлы описания <i>.description</i>.</b> Сегодня они в Битриксе уже не используются</li>
	<li><b>файлы <i>.parameters</i>.</b> Часто вы настолько изменяете стандартный шаблон, что его первоначальные настройки теряют актуальность и их нужно удалять. Не забудьте по lang-файлы.</li>
</ul>
<br> <img src="/local/modules/intervolga.edu/help/images/course1lesson41before.png">
<br> <img src="/local/modules/intervolga.edu/help/images/course1lesson41withlang.png">
<br> <img src="/local/modules/intervolga.edu/help/images/course1lesson41after.png">