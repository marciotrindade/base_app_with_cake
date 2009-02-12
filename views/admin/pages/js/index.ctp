<?php $id = $collection[0][$model]["parent_id"]; ?>
var img = $("#page_<?php echo $id ?> .first").find("img");
$("#page_<?php echo $id ?> .first").removeClass("first").find("img").attr("src", img.attr("src").replace("open", "close")).parent().click(function() {
	if ($(this).hasClass("close")) {
		$(this).parent().find("ul:first").show();
		$(this).removeClass("close").find("img").attr("src", $(this).find("img").attr("src").replace("open", "close"));
	}else{
		$(this).parent().find("ul:first").hide();
		$(this).addClass("close").find("img").attr("src", $(this).find("img").attr("src").replace("close", "open"));
	}
	return false;
}).parent().append("<ul><?php echo $javascript->escapeScript($this->element("../admin/scaffolds/_list")) ?></ul>").find(".first").click(function(){
	if ($(this).hasClass("first")) {
		$.get($(this).attr("href"), null, null, "script");
	}
	return false;
});

$("#page_<?php echo $id ?> ul li:last").css("background", "none");
act_as_tree_start_efect();