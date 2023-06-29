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
		var content=$(this).closest('#intervolga-checker').find('textarea[name=code]').val();

		if (flags.length !== 0) {
			$.ajax({
				url: '/bitrix/admin/intervolga.edu_checker.php',
				data: {
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
			for (var standard in data['items']) {
				var items=data['items'][standard];
				for (var error in items) {
					var div=document.createElement('div');
					div.innerHTML= data['items'][standard][error];
					div.id=standard;
					$('#result').append(div);
				}

			}
		}
	}
};

$(document).ready(function() {
	$('#intervolga-checker [type=button]').off('click').on('click', window.checker.onSend);
});