<?php
B_PROLOG_INCLUDED === true || die();
?>
<ol>
	<li>Часто не замечают или забывают про требование “сделать поле Символьный код обязательным для заполнения <b>у
			разделов</b> и элементов”. Обязательность полей раздела настраивается на отдельной вкладке при
		редактировании параметров инфоблока.
	</li>
	<li>Указывайте слэш в конце ссылок для ЧПУ как в настройках компонентов, так и в настройках инфоблока. <b>#SECTION_CODE#/</b>,
		<b>#SECTION_CODE#/#ELEMENT_CODE#/</b> .
	</li>
	<li>Не обращайте внимание на задание 4 в комментарии.</li>
	<li>Сгенерировать символьные коды можно по <a
				href="https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=34&LESSON_ID=12876">статье</a>.
	</li>
	<li>Не пугайтесь, ибо изменение количества элементов сегодня выглядит не так, как на видео в курсе. Это уже не поле типа int, теперь
		это целый конструктор.<br><img src="<?= IV_EDU_MODULE_DIR ?>/help/images/course1lesson9countonpage.png">
	</li>
</ol>