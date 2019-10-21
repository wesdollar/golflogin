(function ($) {
	$(function () {
		if ($('#frmCreateClient').length > 0) {
			$('#frmCreateClient').validate();
		}
		if ($('#frmUpdateClient').length > 0) {
			$('#frmUpdateClient').validate();
		}
	});
})(jQuery);