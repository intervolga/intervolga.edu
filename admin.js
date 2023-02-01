$(document).on('click', '.iv-copy-link', function() {
	window.navigator.clipboard.writeText($(this).attr('data-url'))
});