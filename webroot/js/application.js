// Use this file only for use in the whole application (Admin and Frontend)

$(document).ready(function() {
	// validate
	$(".validate").each(function(){
		$(this).validate();
	});

	// ajax
	$(".ajax").click(function(){
		$.get($(this).attr("href"), null, null, "script");
		return false;
	});
});
