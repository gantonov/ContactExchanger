<?php
/**
 * The Dispatcher is the main entrance to the application. 
 */
class Dispatcher{
	/**
	 * Checks the URL and finds the controller class that is requested. 
	 * Checks permissions.
	 * Loads the controller and runs it.
	 */
	public static function dispatch()
	{
		if (empty($_GET['controller']))
		{
			$controller = 'ContactGroupsController';
		}
		else
		{
			if (file_exists(_CONTROLLERS_DIR_ . $_GET['controller'] . 'Controller.php'))
			{
				$controller = $_GET['controller'] . 'Controller';
			}
			else
			{
				$controller = 'ContactGroupsController';
			}
		}
		
		require(_CONTROLLERS_DIR_ . $controller . '.php');
		$controller = new $controller();
		if (empty($_GET['service']))
		{
			$controller->run();
		}
		else
		{
			$controller->runService($_GET['service']);
		}
	}
}
