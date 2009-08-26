(function($) {
	$.fn.decimal = function(separador,quantCasas) {
		separador = separador || ".";
		quantCasas = quantCasas || 2;
		$(this).each(function(){
			$(this).keydown(function(e){
				var key = $.browser.msie ? e.keyCode : e.which;
				var erNums = new RegExp('[0-9]');
				var erNotNums = new RegExp('[^0-9]');
				var erStartZero = new RegExp('^0+');
				var value = $(this).val();
				while (erNotNums.test(value)) value = value.replace(erNotNums,'');
				while (erStartZero.test(value)) value = value.replace(erStartZero,'');

				if (key == 0) return true;
				if (key == 9) return true;  // tab
				if (key == 13) return true; // enter
				if (key == 18) return true; // alt
				if (key == 27) return true; // esc
				if (key >= 112 && key <= 123) return true; // F1 - F12

				e.preventDefault(); // impede a a��o padr�o dos navegadores

				if (key >= 96 && key <= 105) key -= 48; // Para funcionar com teclado num�rico
				
				if (key == 8) {
					value = value.substring(0,value.length-1);
					if (value.length <= 2) {
						value = new Array(quantCasas+1-value.length).join('0') + value;
						value = '0' + separador + value;
						$(this).val(value);
						return true;
					} else {
						var decimal = value.substring(value.length-quantCasas);
						var inteiro = value.substring(0,value.length-quantCasas);
						value = inteiro + separador + decimal;
						$(this).val(value);
						return true;
					}
				}

				key = String.fromCharCode(key); // pega o caracter

				if (!erNums.test(key)) return false; // termina se n�o for n�mero
				value = value + key;

				if (value.length <= quantCasas) {
					value = new Array(quantCasas+1-value.length).join('0') + value;
					value = '0' + separador + value;
					$(this).val(value);
					return true;
				} else {
					var decimal = value.substring(value.length-quantCasas);
					var inteiro = value.substring(0,value.length-quantCasas);
					value = inteiro + separador + decimal;
					$(this).val(value);
					return true;
				}
			});
		});
		return this;
	}
})(jQuery);