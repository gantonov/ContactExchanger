<?php
class ContactGroupController extends Controller
{	
	public function display()
	{
		global $smarty;
		
		$contact_group_id = (empty($_GET['group_id']))?null:$_GET['group_id'];
		$contact_group = new ContactGroup($contact_group_id);
		
		$smarty->assign('group_id',$contact_group->id);
		$smarty->assign('group_name',$contact_group->name);
		$smarty->assign('contacts',$contact_group->contacts);
		$smarty->assign('user_permissions',$contact_group->user_permissions);
		$smarty->display('contactgroup.tpl');
	}
	
	public function runService($servce) {
		parent::runService($servce);
	}
	
	//TODO
	public function checkAccess()
	{
		return !empty($_SESSION['user_id']);
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/deleteContact.js";
		parent::loadJS();
	}
}