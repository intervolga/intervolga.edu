<?php
B_PROLOG_INCLUDED === true || die();
?>
<ol>
	<li>Не стоит делать свою страницу вывода результатов!</li>
	<li>
		<b>Что такое “шаблон ссылки и как с ним работать”</b><br>
		Невозможно создать гаджет с одним шаблоном ссылки на результаты. Нужно сделать 2 шаблона: для ссылки на все
		результаты и для результатов только за текущий день. В шаблоне требуется реализовать поддержку 2-ух макросов:
		#ID# и #DATE#.
		Примеры для ID веб-формы 1, дата = 15 октября 2021
		<table>
			<tr>
				<th>Пример шаблона ссылки на все результаты</th>
				<th>Результат</th>
			</tr>
			<tr>
				<td> /test/ </td>
				<td> /test/ </td>
			</tr>
			<tr>
				<td> /test/#ID#/ </td>
				<td> /test/1/ </td>
			</tr>
			<tr>
				<td> /index.php?id=#ID# </td>
				<td> /index.php?id=1 </td>
			</tr>
			<tr>
				<td>/test/#ID#/?date=#DATE#</td>
				<td>/test/1/?date=#DATE#</td>
			</tr>
			<tr>
				<td>/id-from-#ID#-to-#ID#/</td>
				<td>/id-from-1-to-1/</td>
			</tr>
			<tr>
				<td><span><</span>пустой шаблон></td>
				<td>/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=1&del_filter=Y</td>
			</tr>
		</table>
	</li>
</ol>
