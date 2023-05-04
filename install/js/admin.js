document.addEventListener('click', function(event) {
	if (event.target.className !== 'iv-copy-link') {
		return;
	}

	if (window.navigator.clipboard === undefined) {
		result = confirm('Ошибка копирования пути: страница использует незащищенное http соединение.\n' +
			'Использовать https соединение?');
		if (result) {
			window.location.href = window.location.href.replace(/http:/i, 'https:');
		}
	} else {
		window.navigator.clipboard.writeText(event.target.getAttribute('data-url'));
	}
});

document.addEventListener('DOMContentLoaded', function() {
	intervolgaEduAutoSelectTab();
	window.intervolgaEduScrollToTestCounter = 10;
	intervolgaEduScrollToTest();
});

function intervolgaEduAutoSelectTab() {
	var tab = getCookie('intervolga_edu_tab');
	if (tab && tab.length) {
		tabControl.SelectTab(tab);
	}
}

function intervolgaEduScrollToTest() {
	if (window.location.hash && (window.location.hash.length > 1)) {
		var hashElementTop = $(window.location.hash).offset().top;
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

function getCookie(name) {
	var value = `; ${document.cookie}`;
	var parts = value.split(`; ${name}=`);

	if (parts.length === 2) {
		return parts.pop().split(';').shift();
	}
}

function intervolgaEduOnTabChanged(tab) {
	document.cookie = 'intervolga_edu_tab=' + tab;
}

function showPopup(el) {
	const popup=new BX.PopupWindow('call_feedback', window.body, {
		autoHide: true,
		offsetTop: 1,
		offsetLeft: 0,
		lightShadow: true,
		closeIcon: true,
		closeByEsc: true,
		overlay: {
			opacity: '80'
		}
	});
	popup.setContent(BX(el.id + '_photo'))
	popup.show();
}