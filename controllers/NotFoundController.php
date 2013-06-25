<?php
class NotFoundController extends Controller
{
	public function display()
	{
		global $smarty;
		if ($_GET['controller'] != 'NotFound')
		$smarty->assign('page_name',$_GET['controller']);
		$smarty->display('404.tpl');
	}
	
	public function checkAccess()
	{
		return true;
	}
}