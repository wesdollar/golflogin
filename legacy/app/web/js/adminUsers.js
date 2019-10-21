(function ($) {
	$(function () {
		if ($("#frmCreateUser").length > 0) {
			$("#frmCreateUser").validate();
		}
		if ($("#frmUpdateUser").length > 0) {
			$("#frmUpdateUser").validate();
		}
	});
})(jQuery);