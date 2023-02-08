$(document).on('click', '.iv-copy-link', function() {
	window.navigator.clipboard.writeText($(this).attr('data-url'))
});

BX.ready(function () {
	intervolgaEduAutoSelectTab();
});

function intervolgaEduAutoSelectTab() {
	var tab = BX.getCookie('intervolga_edu_tab');
	if (tab && tab.length) {
		tabControl.SelectTab(tab);
	}
}
function intervolgaEduOnTabChanged(tab) {
	BX.setCookie('intervolga_edu_tab', tab);
}