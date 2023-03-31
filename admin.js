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
	window.intervolgaEduScrollToTestCounter=10;
	intervolgaEduScrollToTest();
});

function intervolgaEduAutoSelectTab() {
	var tab=BX.getCookie('intervolga_edu_tab');
	if (tab && tab.length) {
		tabControl.SelectTab(tab);
	}
}

function intervolgaEduScrollToTest() {
	if (window.location.hash && (window.location.hash.length > 1)) {
		var hashElementTop=$(window.location.hash).offset().top;
		if (hashElementTop > 0) {
			$([document.documentElement, document.body]).animate({
				scrollTop: hashElementTop
			}, 100);
		} else {
			if (window.intervolgaEduScrollToTestCounter) {
				window.intervolgaEduScrollToTestCounter--;
				setTimeout(intervolgaEduScrollToTest, 100);
			}
		}
	}
}


function intervolgaEduToggleOpen(el){
	const div = el.nextElementSibling;
	div.style.display = div.style.display ? '' : 'none';
}

function intervolgaEduOnTabChanged(tab) {
	BX.setCookie('intervolga_edu_tab', tab);
}