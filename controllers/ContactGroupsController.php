<?php
class ContactGroupsController extends Controller
{	
	public function display()
	{
		global $smarty;
		$user = new User($_SESSION['user_id']);
		$smarty->assign('contact_groups',$user->contact_groups);
		$smarty->display('contactgroups.tpl');
	}
	
	public function runService($servce) {
		parent::runService($servce);
		if ($servce == 'add_group')
		{
			$shareings = array(
				array('id_user' => $_SESSION['user_id'],
					'premissions' => CAN_ADD | CAN_EDIT | CAN_DELETE | CAN_SEE_OTHERS | CAN_SHARE));
			$group = new ContactGroup();
			$group->set('name',$_POST['group_name']);
			$group->set('shareings', $shareings);
			if ($group->save())
			{
				echo "success";
			}
			else
				echo "fail";
		}
		
		if ($servce == 'delete_group')
		{
			if (empty($_GET['group_id']))
			{
				echo "No group id!";
				return;
			}
			
			if (!$permissions = ContactGroup::getGroupPermissions($_GET['group_id'], $_SESSION['user_id']))
			{
				echo "Group not shared with user";
				return;
			}
			
			if (!$permissions['delete'])
			{
				echo "Deleting not permited!";
				return;
			}
			
			if (ContactGroup::deleteContactGroup($_GET['group_id']))
				echo "success";
			else
				echo "fail";
		}
		
	}
	
	public function checkAccess()
	{
		return !empty($_SESSION['user_id']);
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/ContactGroups.js";
		parent::loadJS();
	}
}