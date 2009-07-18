<?php
class AppModel extends Model
{
	/*
	 * unique
	 * used for validation
	 */
	function unique($data)
	{
		return $this->isUnique(array(key($data)=>current($data)));
	}
}
?>
