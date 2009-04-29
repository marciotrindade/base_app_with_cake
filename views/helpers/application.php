<?php
class ApplicationHelper extends Helper
{
	var $helpers = array("Html");

	function is_current($url = null)
	{
		return ($this->here == $this->url($url));
	}

	function link_to_unless_current($title, $url = null, $htmlAttributes = array(), $confirmMessage = false, $escapeTitle = false)
	{
		if ($this->is_current($url))
		{
			return $title;
		}
		return $this->Html->link($title, $url, $htmlAttributes, $confirmMessage, $escapeTitle);
	}
	
}
?>