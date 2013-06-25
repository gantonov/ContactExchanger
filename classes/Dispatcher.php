<?php
class Dispatcher{

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
				$controller = 'NotFoundController';
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
