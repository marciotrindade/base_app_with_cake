<?php

class PasswordBehavior extends ModelBehavior
{
	var $__settings = array();

	function setup(&$model, $settings = array())
	{
		$this->__settings[$model->name] = am(array('fields'=>array('password')), ife(is_array($settings), $settings, array()));
		if(!is_array($this->__settings[$model->name]['fields']))
		{
			$this->__settings[$model->name]['fields'] = array($this->__settings[$model->name]['fields']);
		}
	}

	function beforeSave(&$model)
	{
		$return = parent::beforeSave($model);
		extract($this->__settings[$model->name]);
		foreach($fields as $field)
		{
			if(!empty($model->data[$model->alias][$field]))
			{
				$model->data[$model->alias][$field] = $this->__encode($model->data[$model->alias][$field]);
			}
		}
		return $return;
	}

	function afterFind(&$model, &$results, $primary)
	{
		extract($this->__settings[$model->name]);
		if ( is_array( $results ) )
		{
			if (isset($results[0]))
			{
				foreach($results as &$rs)
				{
					foreach ($fields as $field)
					{
						if (isset($rs[$model->name][$field]))
						{
							$rs[$model->name][$field] = $this->__decode($rs[$model->name][$field]);
						}
					}
				}
			}
			else
			{
				foreach ($fields as $field)
				{
					if (isset($results[$model->name][$field]))
					{
						$results[$model->name][$field] = $this->__decode($results[$model->name][$field]);
					}
				}
			}
		}
		return $results;
	}

	function __encode($str)
	{
		srand((double)microtime()*1000000);
		$r = md5(rand(0,32000));
		$c = 0;
		$v = "";
		for ($i = 0; $i < strlen($str); $i++)
		{
			if ($c == strlen($r))
			{
				$c = 0;
			}
			$v .= substr($r,$c,1) . (substr($str,$i,1) ^ substr($r,$c,1));
			$c++;
		}
		return base64_encode($this->__key($v));
	}

	function __decode($str)
	{
		$str = $this->__key(base64_decode($str));
		$v = "";
		for ($i = 0; $i < strlen($str); $i++)
		{
			$md5 = substr($str,$i,1);
			$i++;
			$v .= (substr($str,$i,1) ^ $md5);
		}
		return $v;
	}

	function __key($str)
	{
		$r = md5(Configure::read('Project.alias'));
		$c = 0;
		$v = "";
		for ($i = 0; $i < strlen($str); $i++)
		{
			if ($c == strlen($r))
			{
				$c = 0;
			}
			$v .= substr($str,$i,1) ^ substr($r,$c,1);
			$c++;
		}
		return $v;
	}

}
?>
