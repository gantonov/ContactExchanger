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
		
		if ($servce == 'edit_group')
		{
			$group = new ContactGroup($_POST['group_id']);
			$group->set('name',$_POST['group_name']);
			$permissions = ContactGroup::getGroupPermissions($_POST['group_id'], $_SESSION['user_id']);

			if($permissions['edit'])
				if ($group->update())
				{
					echo "success";
					return;
				}
			echo "fail";
			return;
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
		
		if ($servce == 'share_group')
		{
			if (empty($_POST['group_id']))
			{
				echo "No group id!";
				return;
			}
			
			if (empty($_POST['share_with']))
			{
				echo "Email is empty!";
				return;
			}
			$id_group = mysql_real_escape_string($_POST['group_id']);
			$email = mysql_real_escape_string($_POST['share_with']);
			$permissions = mysql_real_escape_string($_POST['permissions']);
			$user_permissions = ContactGroup::getGroupPermissions($id_group, $_SESSION['user_id']);
			
			if (!$user_permissions['share'])
			{
				echo "Access denied!";
				return;
			}
			
			if (!$id_user = User::findUserByEmail($email))
			{
				echo "No such user!";
				return;
			}
			
			if (ContactGroup::shareContactGroup($id_group, $id_user, $permissions))
			{
				echo "success";
			}
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
		$this->sctipts[] ="js/contactGroups.js";
		$this->sctipts[] ="js/shareing.js";
		parent::loadJS();
	}
}