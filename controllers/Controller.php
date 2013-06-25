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
	}
	
	public function init()
	{
		$this->loadJS();
		$this->display();
	}
	
	abstract public function display();
	
	abstract public function checkAccess();
	
	protected function loadJS()
	{
		global $smarty;
		$smarty->assign("scripts",$this->sctipts);
	}
}

