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
		
		switch ($servce) {
			case 'add_group':
				if (empty($_POST['group_name']))
					header("HTTP/1.0 404 Group name is empty");
				else{
					$sharings = array(
						array('id_user' => $_SESSION['user_id'],
							'premissions' => CAN_ADD | CAN_EDIT | CAN_DELETE | CAN_SEE_OTHERS | CAN_SHARE));
					$group = new ContactGroup();
					$group->set('name',$_POST['group_name']);
					$group->set('shareings', $sharings);
					if ($group->save())
						header("HTTP/1.0 200 OK");
					else
						header("HTTP/1.0 500 Server error");
				}
				break;
				
			case 'edit_group':
				if (empty($_POST['group_id']))
					header("HTTP/1.0 404 Group id is empty");
				elseif (empty($_POST['group_name']))
					header("HTTP/1.0 404 Group name is empty");
				else{
					$group = new ContactGroup($_POST['group_id']);
					$group->set('name',$_POST['group_name']);
					$permissions = ContactGroup::getGroupPermissions($_POST['group_id'], $_SESSION['user_id']);

					if(!$permissions['edit'])
						header("HTTP/1.0 403 Forbidden");
					elseif ($group->update())
						header("HTTP/1.0 200 OK");
					else
						header("HTTP/1.0 500 Server error");
				}
				break;
				
			case 'delete_group':
				if (empty($_GET['group_id']))
					header("HTTP/1.0 404 Group id is empty");
				elseif (!$permissions = ContactGroup::getGroupPermissions($_GET['group_id'], $_SESSION['user_id']))
					header("HTTP/1.0 403 Group not shared with user");
				elseif (!$permissions['delete'])
					header("HTTP/1.0 403 Forbidden");
				elseif (ContactGroup::deleteContactGroup($_GET['group_id']))
					header("HTTP/1.0 200 OK");
				else
					header("HTTP/1.0 500 Forbidden");
				break;
				
			case 'share_group':
				if (empty($_POST['group_id']))
					header("HTTP/1.0 404 Group id is empty");
				elseif (empty($_POST['share_with']))
					header("HTTP/1.0 404 Email is empty");
				else
				{
					$id_group = mysql_real_escape_string($_POST['group_id']);
					$email = mysql_real_escape_string($_POST['share_with']);
					$permissions = mysql_real_escape_string($_POST['permissions']);
					$user_permissions = ContactGroup::getGroupPermissions($id_group, $_SESSION['user_id']);

					if (!$user_permissions['share'])
						header("HTTP/1.0 403 Forbidden");
					elseif (!$id_user = User::findUserByEmail($email))
						header("HTTP/1.0 404 User not found");
					elseif (ContactGroup::shareContactGroup($id_group, $id_user, $permissions))
						header("HTTP/1.0 200 OK");
					else
						header("HTTP/1.0 404 This contact group alredy shared with $email");
				}
				break;
			default:
				break;
		}
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/contactGroups.js";
		$this->sctipts[] ="js/sharing.js";
		parent::loadJS();
	}
}