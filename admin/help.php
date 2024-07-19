<?php

use Intervolga\Edu\Tester;
use Intervolga\Edu\Util\Help;

/**
 * @var string $mid module id
 */
global $APPLICATION, $USER;
$APPLICATION->setAdditionalCSS('/bitrix/css/' . $mid . '/print.css');
$APPLICATION->ShowHead();
?>
	<div class="non-print"> Для печати нажмите <b><a href="javascript:(print());"> CTRL+P</a></b></div>
	<div class="non-print">
		Полный список курсов Академии 1С-Битрикс приведен на <a href="https://academy.1c-bitrix.ru/training/course/">этой
			странице</a>. Каждый курс состоит из уроков. Каждый урок включает обучающее видео и задание для выполнения.
	</div>

	<h2>Общие рекомендации</h2>
	<ol>
		<li>
			Используйте полные открывающие php-теги: <span class="code"><span><</span>?php</span> вместо <span
					class="code"><span><</span>?</span>.
			В вызовах компонентов лучше не заменять.
			<div> a. Но на <span class="code"><span><</span>?= ?></span> - данное правило не распространяется.</div>
		</li>
		<li>
			Не оставляйте в конце файла закрывающий php-тег, удаляйте его.
		</li>
		<li>Принудительно рекомендуем использовать короткий способ проверки ядра <span class="code">B_PROLOG_INCLUDED === true || die()</span>
			вместо способа от Академии <span class="code">if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();</span>.
		</li>
		<li>Со времен записи курса Академии в Битриксе появилась папка аналог папки /bitrix/ -> /local/. Каждый раз
			когда
			вас в Академии просят что-то сделать в /bitrix/ - делайте это в /local/. Обязательно вне очереди посмотрите
			<a href="http://academy.1c-bitrix.ru/education/index.php?COURSE_ID=85&LESSON_ID=7264&LESSON_PATH=7252.7264">
				урок 4-го курса</a>.
		</li>
		<li>Выберите свой любимый стиль кавычек (“ vs ‘) и всегда его используйте. Не делайте так: <span class="code">$item["DISPLAY_PROPERTIES"]['TITLE']["DISPLAY_VALUE"]</span>
		</li>
		<li>В примерах кода Битрикса используется венгерская нотация: префиксы ar, ob и т.п. для указания на тип
			переменной.
			Пример: <span class="code">$arItem</span>. Избавляйтесь от нее в своём коде.
		</li>
		<li>
			Убирайте за собой мусор: файлы, которые скопировали откуда-то и не знаете, зачем они нужны.
		</li>
		<li>
			Страницу создавайте только если это явное требование. В остальных случаях мы всегда по умолчанию создаем
			именно
			раздел.
			<br> <img src="/bitrix/images/intervolga.edu/generalsectionorfile.png">
		</li>
		<li>Используйте D7 в своём коде. В академии говорят про <span class="code">AddHeadScript</span>, <span
					class="code">SetAdditionalCss</span>, <span class="code">GetMessage</span>,
			но уже появились современные аналоги: <span class="code">Bitrix\Main\Page\Asset::addJs</span>, <span
					class="code">Bitrix\Main\Page\Asset::addCss</span>, <span class="code">Bitrix\Main\Localization\Loc::getMessage</span>.
			Изучить можете
			<a href="https://www.intervolga.ru/blog/projects/d7-analogi-lyubimykh-funktsiy-v-1s-bitriks/">здесь</a>.
		</li>
	</ol>
<?php
$testTree = Tester::getTestsTree();
foreach ($testTree as $courseCode => $course) {
	?> <h2> <?=$course['TITLE']?> </h2>
	<div class="course">
		<?php
		foreach ($course['LESSONS'] as $lessonCode => $lesson) {
			$help = Help::get($courseCode, $lessonCode);
			if ($help) {
				?>    <h3><?=$lesson['TITLE']?></h3>
				<div class="lesson">
					<?=$help?>
				</div>
				<?php
			}
		}
		?> </div> <?php
}
