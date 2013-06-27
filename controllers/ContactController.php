<?php
class ContactController extends Controller
{	
	public function display()
	{
		global $smarty;
		$smarty->display('contact.tpl');
	}
	
	public function runService($servce) {
		parent::runService($servce);
		if ($_GET['service'] == 'save')
		{
			
		}
		if ($_GET['service'] == 'update')
		{
			
		}		
	}
	
	public function checkAccess()
	{
		return !empty($_SESSION['user_id']);
	}
}