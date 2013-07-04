<?php
/**
 * All Model classes extend ObjectModel. They are used to interact with the DB.
 */
abstract class ObjectModel {
	
	/**
	 * Sets a property. If the value is a String mysql_real_escape_string() is used. 
	 * @param string $var property name
	 * @param mixed $value 
	 */
	public function set($var, $value)
	{
		if (is_string($value))
			$this->$var = mysql_real_escape_string($value);
		else
			$this->$var = $value;
	}
}
