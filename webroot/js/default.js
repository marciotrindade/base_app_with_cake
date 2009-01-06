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
	
	// act_as_tree
	$(".act_as_tree>li:last").css("background", "none").parent().find(".first").click(function() {
		if ($(this).hasClass("first")) {
			$.get($(this).attr("href"), null, null, "script");
		}
		return false;
	});
	act_as_tree_start_efect();
});

var act_as_tree_id = 0;

function act_as_tree_close_menu (obj) {
	obj.fadeOut(500);
}

function act_as_tree_start_efect(){
	$(".act_as_tree span").hover(function () {
		$(this).css({
			background: "#ffff99",
			cursor: "pointer"
		});
	}, function () {
		$(this).css("background", "#ffffff");
	}).click(function(a) {
		$(this).parent().find("div:first").fadeIn(500).css({
			left: (a.pageX - 2) + "px",
			top: (a.pageY - 2) + "px"
		});
	});
	$(".act_as_tree div").hover(function () {
		clearTimeout(act_as_tree_id);
	},function () {
		act_as_tree_id = setTimeout(act_as_tree_close_menu, 10, $(this));
	});
}