$(function(){
	// ajax
	$(".ajax").click(function(){
		$.get($(this).attr("href"), null, null, "script");
		return false;
	});
	
	// validate
	$(".validate").each(function(){
		$(this).validate();
	});
});