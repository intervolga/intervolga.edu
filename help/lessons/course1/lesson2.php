<?php
B_PROLOG_INCLUDED === true || die();
?>
<ol>
	<li>При выполнении задания внимательно читайте, что нужно делать: не путайте Разделы (=Папки) и Страницы (=Файлы php). <b>Важно!</b> В реальной разработке, если иного не сказано, всегда нужно создавать именно Раздел, а не Страницу</li>
	<li>На сайте не должно быть ссылок, заканчивающихся на &quot;index.php&quot; (например, &quot;/products/index.php&quot; &mdash; вместо него используйте &quot;/products/&quot;)</li>
	<li>Не используйте транслит для названия разделов и страниц! Если с английским на &quot;вы&quot; &mdash; используйте сервисы перевода</li>
	<li>
		Уже на этом этапе надо создать в проекте папку /local/ и работать с ней вместо папки /bitrix/. Это общепринятый способ отделения своего кода от Битрикса. <b>Обязательно</b> сначала посмотрите урок 4-го курса <a href="http://academy.1c-bitrix.ru/education/index.php?COURSE_ID=85&LESSON_ID=7264&LESSON_PATH=7252.7264" target="_blank">4. Папка local</a>
		<br>
		<img src="/bitrix/images/intervolga.edu/course1lesson2local.png" alt="">
	</li>
</ol>