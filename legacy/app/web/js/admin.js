(function ($) {
	$(function () {
		if ($('#frmLoginAdmin').length > 0) {
			$('#frmLoginAdmin').validate({
				rules: {
					login_username: "required",
					login_password: "required"
				}
			});
		}
	});
})(jQuery);