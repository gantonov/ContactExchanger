<?php
class ContactController extends Controller
{	
	public function display()
	{
		$user = new User($_SESSION['user_id']);
		global $smarty;
		$smarty->assign('contact_groups',$user->contact_groups);		
		$smarty->display('contact.tpl');
	}
	
	public function runService($servce) {
		parent::runService($servce);
		if ($_GET['service'] == 'save')
		{
			parse_str($_POST['data'], $contact_data);
			
			$contact = new Contact();
			
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
			if ($contact->save())
				echo "success";
			
		}
		if ($_GET['service'] == 'update')
		{
			
		}		
	}
	
	//TODO
	public function checkAccess()
	{
		return !empty($_SESSION['user_id']);
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/contact.js";
		parent::loadJS();
	}
}