<?php

class PermalinkBehavior extends ModelBehavior
{
	var $options = array();
	var $model;
	
	function setup(&$model, $options = array())
	{
		$this->options = am(array(
			"field" => "name", 
			"separator" => "-" 
		), $options);
	}

	function beforeSave(&$model)
	{
		$return = parent::beforeSave($model);
		if (!$model->hasField($this->options["field"]))
		{
			return $return;
		}
		$this->permalink($model);
		return $return;
	}

	function permalink(&$model, $level = 0)
	{
		$value = $model->data[$model->name][$this->options["field"]];
		$value = low($value);
		$value = preg_replace('/[^a-z0-9_ -]/i', "", $value);
		$value = preg_replace('/[_ ]/i', $this->options["separator"], $value);

		if ($level > 0)
		{
			$value = $value . "-{$level}";
		}

		$conditions = array($model->alias . ".permalink" => $value);

		if (!empty($model->id))
		{
			$conditions = am(array($model->alias . ".id <>" => $model->id), $conditions);
		}
		$count = $model->find("count", array("conditions" => $conditions));
		
		if($count > 0)
		{
			$this->permalink($model, ++$level);
		}
		else
		{
			$model->data[$model->name]["permalink"] = $value;
		}
	}

}
?>
