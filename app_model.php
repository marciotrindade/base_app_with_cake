<?php

class AppModel extends Model
{
	/*
	 * unique
	 * used for validation
	 */
	function unique($data) {
		return $this->isUnique(array(key($data)=>current($data)));
	}

	function afterFind($result){
		foreach($result as &$rs){
			if(isSet($rs[$this->name]['created'])){
				$rs[$this->name]['created'] = date('m/d/Y H:i:s', strtotime($rs[$this->name]['created']));
			}
			if(isSet($rs[$this->name]['modified'])){
				$rs[$this->name]['modified'] = date('m/d/Y H:i:s', strtotime($rs[$this->name]['modified']));
			}
		}
		return $result;
	}

}
?>
