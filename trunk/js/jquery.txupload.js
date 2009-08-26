(function($){
	var options = {
		queue: "Na fila",
		sending: "Enviando..."
	};
	
	$.fn.TXUpload = function(temp){
		var $form = $(this[0]);

		options = $.extend(options,temp);
		
		$form.submit(function(e){
			e.preventDefault();

			var $inputs = [];
			$form.find('input[type^=file]').each(function(){
				if ($(this).val() != "") {
                                        $(this).attr('disabled',true);
					$inputs.push($(this));
					$(this).css('display','none').parent().append("<span>"+options.queue+"<span>");
				}
			});
                        if ($inputs.length) {
                            $('input[type^=file]:enabled').remove();
                        } else {
                            $('input[type^=file]:disabled').attr('disabled',false);
                        }

			sendNext($inputs,$form);
		});
	}

	function sendNext($inputs,$form) {
		if ($inputs <= 0) {
                    window.location.reload(true);
                    return;
                }
		$('#TXUpload_iFrame').remove();

		var formAction = $form.attr('action');
		$iframe = $('<iframe>');
		$iframe.attr({
			src: formAction,
			name: 'TXUpload_iFrame',
			id: 'TXUpload_iFrame',
			width:0,
                        height:0
		});
		$form.append($iframe);

		$form.attr('target','TXUpload_iFrame');

		var $input = $inputs.shift();
		$input.attr('disabled',false);

		$iframe.load(function(){
			var content = getIFrameBodyContent($iframe);
			$input.parent().html(content);
			$input.remove();
			sendNext($inputs,$form);
		});
		
		
		$input.parent().find('span').remove();
		$input.parent().append('<span>'+options.sending+'</span>');
		
		
		$form.get(0).submit();
	}
	
	function getIFrameBodyContent($iframe) {
		return $iframe.get(0).contentDocument.getElementsByTagName('body')[0].innerHTML;
	}
})(jQuery);