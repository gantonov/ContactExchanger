<?php
/**
 * DBComutator is used to establish DB connection and execute queries
 */
class DBComutator {
	/**
	 * Holds the active DB connection 
	 */
	private static $connection;
	/**
	 * Establishes a connection if $connection is empty. 
	 */
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
	
	/**
	 * Closes the current DB connection 
	 */
	public function __destruct() 
	{
		if (!self::$connection)
			if (mysql_close(self::$connection))
			self::$connection = null;
	}    
    
    public static function getConnection()
    {
        return self::$connection;
    }
	
	public static function getInstance()
	{
		return new DBComutator();
	}
	/**
	 * Executes a query. For INSER queries use executeInsertQuery()
	 * @param string $query
	 * @return resourece 
	 * @see executeInsertQuery()
	 */
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
	/**
	 * Executes an INSERT query.
	 * @param string $query INSERT query
	 * @return int|false mysql_insert_id()
	 */
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