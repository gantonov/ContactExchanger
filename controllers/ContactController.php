<?php
class ContactController extends Controller
{
	private $user_permissions;
	
	public function __construct() {
		parent::__construct();
		if (!empty($_GET['id']))
			$this->user_permissions = Contact::getUserPermissions($_SESSION['user_id'], $_GET['id']);
		else
			$this->user_permissions = true;
	}
	public function display()
	{
		global $smarty;
		
		$id_contact = (empty($_GET['id'])?null:$_GET['id']);
		$contact = new Contact($id_contact);
		$smarty->assign('id',$contact->id);
		$smarty->assign('first_name',$contact->first_name);
		$smarty->assign('last_name',$contact->last_name);
		$smarty->assign('telephones',$contact->telephones);
		$smarty->assign('emails',$contact->emails);
		$smarty->assign('ims',$contact->ims);
		
		$user = new User($_SESSION['user_id']);
		
		foreach ($contact->contact_groups as $id_group) 
			$user->contact_groups[$id_group]['selected'] = true;
		
		if (isset($_GET['group_id']) && isset($user->contact_groups[$_GET['group_id']]))
			$user->contact_groups[$_GET['group_id']]['selected'] = true;
		
		$smarty->assign('contact_groups',$user->contact_groups);	
		
		$smarty->display('contact.tpl');
	}
	
	public function runService($servce) 
	{
		parent::runService($servce);
		if ($servce == 'save')
		{
			parse_str($_POST['data'], $contact_data);
			
			if (!empty($contact_data['contact_id']))
				$permissions = Contact::getUserPermissions ($_SESSION['user_id'], $contact_data['contact_id']);
			
			if (!empty($contact_data['contact_id']) && empty($permissions['edit']))
				header("HTTP/1.0 403 Forbidden");
			else
			{
				$contact_id = (empty($contact_data['contact_id']))?null:$contact_data['contact_id'];
				$contact = new Contact();

				$contact->set('id', $contact_id);
				$contact->set('first_name', $contact_data['first_name']);
				$contact->set('last_name', $contact_data['last_name']);

				//set telephones
				$contact_telephones = array();
				$default_telepone = (!empty($contact_data['default_telephone']))?$contact_data['default_telephone']:1;
				$i = 0;
				foreach ($contact_data['telephone'] as $telephone) 
				{
					$telephone = mysql_real_escape_string($telephone);
					$type = mysql_real_escape_string($contact_data['telephone_type'][$i]);
					$preferable = ($default_telepone == $i+1)?1:0;
					if (!empty($telephone) && !empty($type))
						$contact_telephones[] = array('type' => $type, 
							'number' => $telephone, 'preferable' => $preferable);
					$i++;
				}
				$contact->set('telephones', $contact_telephones);

				//set emails
				$contact_emails = array();
				$default_email = (!empty($contact_data['default_email']))?$contact_data['default_email']:1;
				$i = 0;
				foreach ($contact_data['email'] as $email) 
				{
					$email = mysql_real_escape_string($email);
					$type = mysql_real_escape_string($contact_data['email_type'][$i]);
					$preferable = ($default_email == $i+1)?1:0;
					if (!empty($email) && !empty($type))
						$contact_emails[] = array('type' => $type, 
							'email' => $email, 'preferable' => $preferable);
					$i++;
				}
				$contact->set('emails', $contact_emails);

				//set ims
				$contact_ims = array();
				$i = 0;
				foreach ($contact_data['im'] as $im) 
				{
					$im = mysql_real_escape_string($im);
					$type = mysql_real_escape_string($contact_data['im_type'][$i]);
					if (!empty($im) && !empty($type))
						$contact_ims[] = array('type' => $type, 'username' => $im);
					$i++;
				}
				$contact->set('ims', $contact_ims);

				//set groups
				if (!empty($contact_data['contact_groups']))
				{
					$contact_groups = array();
					foreach ($contact_data['contact_groups'] as $id_contact_group) 
					{
						$id_contact_group = mysql_real_escape_string($id_contact_group);
						$contact_groups[] =  array('id_contact_group' => $id_contact_group);
					}
					$contact->set('contact_groups', $contact_groups);
				}
				if (empty($contact->first_name))
					header("HTTP/1.0 404 First name is empty");
				elseif (empty($contact->telephones) && empty($contact->emails) && empty($contact->ims))
					header("HTTP/1.0 404 Contact details are empty");
				elseif ($contact->save())
					header("HTTP/1.0 200 OK");
				else
					header("HTTP/1.0 500 Server Error");
			}
		}
		
		if ($servce == 'delete')
		{
			if (empty($_GET['contact_id']))
				header("HTTP/1.0 404 Contact id is empty");
			elseif (Contact::deleteContact($_GET['contact_id']))
				header("HTTP/1.0 200 OK");
			else
				header("HTTP/1.0 500 Server Error");
		}
	}
	
	public function checkAccess() {
		if (!parent::checkAccess())
			return false;
		if (empty($this->user_permissions))
			return false;
		return true;
	}
	protected function loadJS()
	{
		$this->sctipts[] ="js/contact.js";
		parent::loadJS();
	}
}