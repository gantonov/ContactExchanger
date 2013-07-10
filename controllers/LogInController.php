<?php
class LogInController extends Controller
{	
	public function __construct() 
	{
		parent::__construct();
	}
	public function init()
	{
		if (!empty($_GET['logout']))
		{
			User::LogOut();
		}
		parent::init();
	}
	
	public function display()
	{
		global $smarty;
		$smarty->display('login.tpl');
	}
	
	public function runService($servce) {
		parent::runService($servce);
		switch ($servce) {
			case 'sign_up':
				if (empty($_POST['email']))
					header("HTTP/1.0 404 Email is empty");
				elseif (empty($_POST['name']))
					header("HTTP/1.0 404 Name is empty");
				elseif (empty($_POST['password']))
					header("HTTP/1.0 404 Password is empty");
				elseif (User::signUp($_POST['email'], $_POST['name'], $_POST['password']))
					header("HTTP/1.0 200 OK");
				else
					header("HTTP/1.0 403 User Alredy Exists");
				break;
			case 'log_in':
				if (User::logIn($_POST['email'], $_POST['password']))
				{
					header("HTTP/1.0 200 OK");
				}
				else
					header("HTTP/1.0 403 Wrong email or password");
				break;
			default:
				header("HTTP/1.0 400 Bad Request");
				break;
		}
		
	}
	public function checkAccess()
	{
		return true;
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/signup.js";
		$this->sctipts[] ="js/login.js";
		parent::loadJS();
	}
}