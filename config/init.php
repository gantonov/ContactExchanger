<?php
session_start();

require 'globals.php';

spl_autoload_register('autoload');
function autoload($class)
{
	if (file_exists(_CLASSES_DIR_ . $class . '.php'))
	{
		require_once(_CLASSES_DIR_ . $class . '.php');
	}
	elseif (file_exists(_CONTROLLERS_DIR_ . $class . '.php'))
	{
		require_once(_CONTROLLERS_DIR_ . $class . '.php');
	}
}

require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir(_ROOT_DIR_.'view/');
$smarty->setCompileDir(_ROOT_DIR_.'temp/smarty_c/');
$smarty->setCacheDir(_ROOT_DIR_.'temp/cache/');