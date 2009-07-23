$(document).ready(function() {
	$("#order").sortable({
		axis:'y',
		dropOnEmpty:false,
		update:function(){$.ajax({complete:function(request){$('#order').effect('highlight');},
		data:$(this).sortable('serialize',{key:'order[]'}),
		dataType:'script',
		type:'post',
		url:$("#url_order").attr("href")
	})}});
});
