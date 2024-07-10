window.checker={
	lastLoaded: {},
	debounceId: 0,
	onSend: function() {
		if (window.checker.debounceId) {
			clearTimeout(window.checker.debounceId);
		}
		window.checker.debounceId=setTimeout($.proxy(window.checker.loadElements, this), 400);
	},
	loadElements: function() {
		$(this).attr('disabled', 'disabled');
		var flags=[];
		$('[name="standards"]:checked').each(function() {
			flags.push($(this).val());
		});
		var contentType=$('[name="content_type"]:checked').val();
		var content=$(this).closest('#intervolga-checker').find('textarea[name=code]').val();

		if (flags.length !== 0) {
			$.ajax({
				url: '/bitrix/admin/intervolga.edu_checker.php',
				data: {
					contentType: contentType,
					content: content,
					flags: flags,
				},
				type: 'POST',
				dataType: 'json'
			}).done(window.checker.onElementsLoaded);
		} else {
			$('#result').empty();
			var div=document.createElement('div');
			div.innerHTML='Должен быть выбран хотя бы один стандарт';
			div.id='error';
			$('#result').append(div);
			$('#intervolga-checker [type=button]').removeAttr('disabled');
		}
	},
	onElementsLoaded: function(data) {
		$('#result').empty();
		if (data['items']) {
			var inputText=$('#intervolga-checker [type=button]');
			inputText.removeAttr('disabled');
			var result=document.getElementById('result');
			for (var file in data['items']) {
				var divFile=document.createElement('div');
				divFile.innerHTML=file;
				divFile.id='fileName';
				$('#result').append(divFile);
				for (var standard in data['items'][file]) {
					var items=data['items'][file][standard];
					for (var error in items) {
						var div=document.createElement('div');
						div.innerHTML=data['items'][file][standard][error];
						div.id=standard;
						divFile.append(div);
					}
				}
			}
		}
	}
};

$(document).ready(function() {
	$('#intervolga-checker [type=button]').off('click').on('click', window.checker.onSend);
});