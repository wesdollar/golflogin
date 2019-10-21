(function ($) {
	$(function () {
		if ($("#frmCreatePlayers").length > 0) {
			$("#frmCreatePlayers").validate();
		}
		if ($("#frmUpdatePlayers").length > 0) {
			$("#frmUpdatePlayers").validate();
		}
	});
})(jQuery);