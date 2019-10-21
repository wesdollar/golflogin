(function ($) {
	$(function () {
		if ($('#frmStep1').length > 0) {
			
			$.validator.addMethod("prefix", function (value, element, param) {
				if (value.length == 0) {
					return true;
				}
				if (value.length > 30) {
					return false;
				}
				var re = /\.|\/|\\|\s|\W/;
				return !re.test(value)
			}, "Prefix must be no more than 30 characters long and could contain only digits, letters, and '_'");
			
			$('#frmStep1').validate({
				rules: {
					prefix: "prefix"
				}
			});
		}		
		if ($('#frmStep2').length > 0) {
			$('#frmStep2').validate({
				submitHandler: function(form) {
					$("input[type='submit'], input[type='button']").attr("disabled", "disabled");
					form.submit();
				}				
			});			
		}
	});
})(jQuery);