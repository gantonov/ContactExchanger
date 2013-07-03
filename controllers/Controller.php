<?php
abstract class Controller {
	protected $sctipts;
	public function __construct()
	{
		$this->sctipts = array("jquery" => "http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js");
	}
	
	public function run()
	{
		if ($this->checkAccess())
		{
			$this->init();
		}
		else
		{
			header("Location: index.php?controller=login"); 
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
	
	abstract public function display();
	
	abstract public function checkAccess();
	
	protected function loadJS()
	{
		global $smarty;
		$smarty->assign("scripts",$this->sctipts);
	}
	
	public function runService($servce) {}
}

