$(function (){
	//Admin Menu
	$("#menu").superfish({
		hoverClass: "sfHover",
		currentClass: "overideThisToUse",
		delay: 800,
		animation: {opacity:"show"},
		speed: "normal"
	});

	// act_as_tree
	$(".act_as_tree>li:last").css("background", "none").parent().find(".first").click(function(e) {
		e.preventDefault();
		if ($(this).hasClass("first")) {
			$.get($(this).attr("href"), null, null, "script");
		}
	});
	act_as_tree_start_efect();

	// validate
	$(".validate").each(function(){
		$(this).validate();
	});

	$("#table").dataTable( {
		"aaSorting": [[ 0, "asc" ]],
		"sPaginationType": "full_numbers",
		"bStateSave": true,
		"bInfo": false
	});
});

var act_as_tree_id;

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
	}).click(function(e) {
		e.preventDefault();
		$(this).parent().find("div:first").fadeIn(500).css({
			left: (e.pageX - 2) + "px",
			top: (e.pageY - 2) + "px"
		});
	});
	$(".act_as_tree div").hover(function () {
		clearTimeout(act_as_tree_id);
	},function () {
		obj = $(this);
		act_as_tree_id = setTimeout(function(){act_as_tree_close_menu(obj);}, 1000);
	});
}