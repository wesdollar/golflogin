$(".plan-btn").on("click", function() {
  $(".plan-btn").removeClass("active");

  var plan = $(this).attr("data-plan");

  $(this).addClass("active");

  $("#subscriptionPlan").val(plan);

  return false;
});
