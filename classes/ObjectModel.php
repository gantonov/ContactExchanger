<?php
class ObjectModel {
	
	public function set($var, $value)
	{
		if (is_string($value))
			$this->$var = mysql_real_escape_string($value);
		else
			$this->$var = $value;
	}
}
