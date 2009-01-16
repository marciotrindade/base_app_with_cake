<?php
class FckHelper extends Helper
{
	var $helpers = array('Html', 'Form', 'Javascript');

	function input($fieldName,  $options = array())
	{
		$options = array_merge(array('attributes'=>array(), 'toolbar' => 'dburns', 'width' => '100%', 'height' => 300), $options);
		
		$attributes = $options['attributes'] = $this->_initInputField($fieldName, $options['attributes']);
		unset($attributes['name']);

		$baseDir = $this->webroot("/fckeditor/editor/");
		
		$file = $baseDir . "fckeditor.html?InstanceName={$options['attributes']["id"]}&amp;Toolbar={$options['toolbar']}";

		$html = "\n\n\n".'<div class="input required">';
		$html .= (!isSet($options['label']) || $options['label'] != false)?$this->Form->label($fieldName):'';
		$html .= '<div class="fckeditor">';
		$html .= "<iframe id=\"{$options['attributes']['id']}___Frame\" src=\"{$file}\" width=\"{$options['width']}\" height=\"{$options['height']}\" frameborder=\"0\" scrolling=\"no\"></iframe>" ;
		$html .= sprintf($this->Html->tags['hidden'], $options['attributes']['name'], $this->_parseAttributes($attributes));
		$html .= '</div>';
		$html .= $this->Form->error($fieldName);
		$html .= '</div>'."\n\n\n";
		
		$view =& ClassRegistry::getObject('view');
		$view->addScript($this->Javascript->link('fckeditor'));
		
		return  $html;
	}
}
?>