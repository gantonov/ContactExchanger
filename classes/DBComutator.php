<?php
class DBComutator {
	private static $connection;
	
	public function __construct() {
		
		if(empty(self::$connection))
		{
			self::$connection = mysql_connect(_DB_SERVER_,_DB_USERNAME_,_DB_PASSWORD_);
			if (!self::$connection)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db(_DB_, self::$connection);
			mysql_query("SET NAMES 'utf8'", self::$connection);
		}
	}
	
	public function __destruct() 
	{
		if (mysql_close(self::$connection))
		{
			self::$connection = null;
		}
	}    
    
    public static function getConnection()
    {
        return self::$connection;
    }
	
	public static function getInstance()
	{
		return new DBComutator();
	}
    public function executeQuery($query)
    {
        if ($result = mysql_query($query,self::$connection)) 
		{		
			return $result;
		}
        else
        {
	    	error_log($_SERVER['SCRIPT_FILENAME'].' - '.mysql_error());
            return false;
        }
    }
	public function executeInsertQuery($query)
    {
        if (mysql_query($query,self::$connection)) 
			return mysql_insert_id();
        else
        {
	    	error_log($_SERVER['SCRIPT_FILENAME'].' - '.mysql_error());
            return false;
        }
    }
}