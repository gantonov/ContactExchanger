<?php
class ContactGroupsController extends Controller
{	
	public function display()
	{
		global $smarty;
		$smarty->display('contactgroups.tpl');
	}
	
	public function runService($servce) {
		parent::runService($servce);
		if ($_GET['service'] == 'add_group')
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
		
	}
	
	public function checkAccess()
	{
		return !empty($_SESSION['user_id']);
	}
	
	protected function loadJS()
	{
		$this->sctipts[] ="js/addContacGroup.js";
		parent::loadJS();
	}
}