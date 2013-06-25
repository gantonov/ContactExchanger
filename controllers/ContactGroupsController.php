<?php
class ContactGroupsController extends Controller
{	
	public function display()
	{
		global $smarty;
		$smarty->assign('test',$_SESSION['user_id']);
		$smarty->display('contactgroups.tpl');
	}
	
	public function runService($servce) {
		
	}
	public function checkAccess()
	{
		return true;
	}
	
	protected function loadJS()
	{
		/* TODO $this->sctipts[] ="js/.......js";*/
		parent::loadJS();
	}
}