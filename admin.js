$(document).on('click', '.iv-copy-link', function() {
	window.navigator.clipboard.writeText($(this).parent().find('a').attr('id'))
});