<?php
B_PROLOG_INCLUDED === true || die();
?>
Далее будет несколько правил, которым нужно следовать при создании <b>всегда</b>:
<h4>Правила создания инфоблоков:</h4>
<ol>
	<li>Нужно настраивать “Подписи” в инфоблоках. Как минимум для элементов инфоблока.</li>
	<li>Проверяйте настройки доступа инфоблока. Чаще всего настройка такая: <i>Для всех пользователей: Чтение</i>.</li>
	<li>Проверяйте настройки индексации модулем поиска.</li>
	<li>В настройках формы редактирования элемента инфоблока всегда выводите поля Активность, Сортировка.</li>
	<li>Все обязательные для заполнения поля желательно переносить на первую вкладку как можно выше.</li>
	<li>Все “большие” поля (например, текст описания или подробный текст) лучше размещать снизу или на отдельной вкладке.</li>
	<li>JS-код выносить в отдельный файл (компонент сам подхватит файл, если его назвать <i>script.js</i>).</li>
	<li>Не плодите Типы инфоблоков, создайте Тип “Контент” и все инфоблоки, которые будете создавать в нём.</li>
</ol>

<h4>Общие правила для шаблонов news.list, catalog.section и прочих "списочных" компонентов:</h4>
<ol>
	<li>Делайте проверку перед выводом компонента, чтобы ничего не выводило, если не сказано иного. Используйте или if, или foreach.</li>
	<li>Компонент должен проверять любые данные перед выводом, чтобы не было пустых атрибутов href у ссылок, src у изображений, пустых кавычек или странных пустот в верстке.
		<br> <img src="/bitrix/images/intervolga.edu/course1lesson6checkemptydata.png"></li>
	<li>Свойства нужно выводить из <i>DISPLAY_PROPERTIES</i>. Поля из <i>FIELDS</i>.<br><img src="/bitrix/images/intervolga.edu/course1lesson6correctshowdata.png"></li>
	<li>Все изображения перед выводом должны быть уменьшены до требуемых по верстке размеров.</li>
	<li>Все ссылки из шаблона должны выводиться с использованием узлов <i>DETAIL_PAGE_URL</i>, <i>SECTION_PAGE_URL</i> или <i>LIST_PAGE_URL</i>.</li>
</ol>