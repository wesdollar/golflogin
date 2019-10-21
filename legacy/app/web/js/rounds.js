(function ($) {
	$(function () {
		if ($("#frmCreateRound").length > 0) {
			$("#frmCreateRound").validate();
		}

        // hide round basics until radio is checked
        $('#roundBasics').hide();

        // show round basics when any radio is selected
        $('input:radio').bind('change', function() {
           if($(this).is(':checked')) {
               $('#roundBasics').show();
           }
        });

        // Style radio and checkbox  controls
		$(".checkboxClass").bind('change', function() {
			if($(this).is(":checked")) {
				$(this).next("label").addClass("LabelSelected");
			} else {
				$(this).next("label").removeClass("LabelSelected");
			}
		});
			
		$(".radioClass").bind('change', function() {
			if($(this).is(":checked")) {
				$(".radioSelected:not(:checked)").removeClass("radioSelected");
				$(this).parent("label").addClass("radioSelected");
			}
		});
		
		// default states
		$(".checkboxClass").each(function() {
			if($(this).is(":checked")) {
				$(this).next("label").addClass("LabelSelected");
			}
		});
		
		$(".radioClass").each(function() {
			if($(this).is(":checked")) {
				$(".radioSelected:not(:checked)").removeClass("radioSelected");
				$(this).parent("label").addClass("radioSelected");
			}
		});
		
		// load golf card data
		$("#course_id, .radioClass").bind('change', function(){
			$.ajax({
				type: "POST",
				url: "Rounds/card/",
				data: $("#frmCreateRound").serialize(),
				success: function(html){
					$("#courseCard").html(html);
				}
			});
		});
		
		// load again golf card data if front/back nine is changed
		$("#nine_start").live('change', function(){
			$.ajax({
				type: "POST",
				url: "Rounds/card/",
				data: $("#frmCreateRound").serialize(),
				success: function(html){
					$("#courseCard").html(html);
				}
			});
		});
		
		// bind onchange event for out putts and put the result in out field
		$(".calcOutStrokes").live('change', function (){
			var $out = 0;
			
			$(".calcOutStrokes").each(function(){
				$val = $(this).val();
				
				if ($val.length > 0 && !isNaN($val)) {
					$out += parseInt($val);
				}
			});
			
			$("#outStrokes").html($out);
		});
		
		// bind onchange event for in putts and put the result in in field
		$(".calcInStrokes").live('change', function (){
			var $in = 0;
			
			$(".calcInStrokes").each(function(){
				$val = $(this).val();
				
				if ($val.length > 0 && !isNaN($val)) {
					$in += parseInt($val);
				}
			});
			
			$("#inStrokes").html($in);
		});
	});
})(jQuery);