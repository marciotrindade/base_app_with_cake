$(document).ready(function() {
	if ($.browser.msie && $.browser.version	< 7) {
		$("body").prepend('<div id="crossbrowser"><div id="corss_content"><h1>Please Upgrade Your Browser</h1><p>This website is designed using new technology and best practices in web standards.<br />We recommend upgrading your browser with one of the following to properly view our website:</p><a href="#" title="Close" class="cross_close">Close</a><ul><li class="firefox"><a target="_blank" href="http://www.mozilla.com/en-US/" title="Mozilla Firefox">Firefox</a></li><li class="chrome"><a target="_blank" href="http://www.google.com/chrome" title="Google Chrome">Chrome</a></li><li class="safari"><a target="_blank" href="http://www.apple.com/safari/download/" title="Apple Safari">Safari</a></li><li class="opera"><a target="_blank" href="http://www.opera.com/download/" title="Opera">Opera</a></li><li class="explorer"><a target="_blank" href="http://www.microsoft.com/windows/internet-explorer/worldwide-sites.aspx" title="Internet Explorer">Internet Explorer</a></li></ul></div></div>');
		$("#crossbrowser").slideDown();

		$("#crossbrowser .cross_close").click(function() {
			$("#crossbrowser").slideUp();
			return false
		});
	}
});