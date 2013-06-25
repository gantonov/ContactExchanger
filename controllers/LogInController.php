<?php
class LogInController extends Controller
{	
	public function display()
	{
		global $smarty;
		$smarty->display('login.tpl');
	}
	
	public function checkAccess()
	{
		return true;
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/signup.js";
		parent::loadJS();
	}
}