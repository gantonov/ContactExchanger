<?php
class LogInController extends Controller
{	
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
		if ($_GET['service'] == 'sign_up')
		{
			$user = new User();
			$user->set('email', $_POST['email']);
			$user->set('name', $_POST['name']);
			$user->set('password', $_POST['password']);
			if ($user_id = $user->save())
			{
				echo "success";
				$_SESSION['user_id'] = $user_id;
			}
			else
				echo "fail";
		}
		if ($_GET['service'] == 'log_in')
		{
			$user = new User();
			$user->set('email', $_POST['email']);
			$user->set('password', $_POST['password']);
			if ($user_id = $user->logIn())
			{
				echo "success";
			}
			else
				echo "fail";
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