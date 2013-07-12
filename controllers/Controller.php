<?php
abstract class Controller {
	protected $sctipts;
	public function __construct()
	{
		//$this->sctipts = array("jquery" => "http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js");
		$this->sctipts = array("jquery" => "js/jquery-1.8.2.min.js");
	}
	/**
	 * Runs the controller 
	 */
	public function run()
	{
		if ($this->checkAccess())
		{
			$this->init();
		}
		else
		{
			header("HTTP/1.0 403 Forbidden");
			exit();
		}
	}
	
	public function init()
	{
		$this->loadJS();
		
		global $smarty;
		$smarty->assign('base_url',_ROOT_URL_);
		$this->display();
	}
	
	/**
	 * Loads the content and displays the *.tpl file. 
	 */
	abstract public function display();
	/**
	 * Checks if the user has access to the page.
	 * @return boolean 
	 */
	public function checkAccess()
	{
		if (empty($_SESSION['user_id']))
		{
			header("Location: index.php?controller=LogIn");
			exit();
		}
		return true;
	}
	
	/**
	 * Loads all required js files.
	 */
	protected function loadJS()
	{
		global $smarty;
		$smarty->assign("scripts",$this->sctipts);
	}
	
	/**
	 * Runs a GET or POST service
	 * @param string $servce service name. It is passed as a $_GET variable
	 */
	public function runService($servce) {}
}

