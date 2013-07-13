<?php
class ContactGroupController extends Controller
{
	private $contact_group;
	public function __construct() {
		$contact_group_id = (empty($_GET['group_id']))?null:$_GET['group_id'];
		$this->contact_group = new ContactGroup($contact_group_id);
		parent::__construct();
	}
	public function display()
	{
		global $smarty;
		$smarty->assign('group_id',$this->contact_group->id);
		$smarty->assign('group_name',$this->contact_group->name);
		$smarty->assign('contacts',$this->contact_group->contacts);
		$smarty->assign('user_permissions',$this->contact_group->user_permissions);
		if ($this->contact_group->user_permissions['see_others'])
			$smarty->assign('sharings',$this->contact_group->sharings);
		$smarty->display('contactgroup.tpl');
	}
	
	public function runService($servce) {
		parent::runService($servce);
	}
	
	public function checkAccess()
	{
		if (!parent::checkAccess())
			return false;
		
		if (empty($this->contact_group->user_permissions))
			return false;
		return true;
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/deleteContact.js";
		parent::loadJS();
	}
}