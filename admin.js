$(document).on('click', '.iv-copy-link', function() {
	if (typeof window.navigator.clipboard == 'undefined') {
		result=confirm('Ошибка копирования пути: страница использует незащищенное http соединение.\n' +
			'Использовать https соединение?');
		if (result) {
			window.location.href=window.location.href.replace(/http:/i, 'https:');
		}
	} else {
		window.navigator.clipboard.writeText($(this).attr('data-url'))
	}
});

BX.ready(function() {
	intervolgaEduAutoSelectTab();
});

function intervolgaEduAutoSelectTab() {
	var tab=BX.getCookie('intervolga_edu_tab');
	if (tab && tab.length) {
		tabControl.SelectTab(tab);
	}
}

function intervolgaEduOnTabChanged(tab) {
	BX.setCookie('intervolga_edu_tab', tab);
}