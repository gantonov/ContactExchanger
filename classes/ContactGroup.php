<?php
class ContactGroup extends ObjectModel{
	protected $id;
	protected $name;
	protected $users;
	protected $shareings;
	
	public function __construct($id = null)
	{
		//TODO
		if (!empty($id))
		{
			
		}
	}
	
	public function save()
	{
		$query = "INSERT INTO "._DB_PREFIX_."contact_group
			SET name='$this->name' ";
		$db = new DBComutator();
		$db->executeQuery("BEGIN");
		if (!$this->id = $db->executeInsertQuery($query))
		{
			$db->executeQuery ("ROLLBACK");
			return false;
		}
		
		$query = "INSERT INTO "._DB_PREFIX_."shareing (id_user, id_contact_group, permissions) VALUES";

		foreach ($this->shareings as $shareing) {
			$query .= " ({$shareing['id_user']},$this->id,{$shareing['premissions']})";
		}
		
		if (!$db->executeQuery($query))
		{
			$db->executeQuery ("ROLLBACK");
			return false;
		}
		
		$db->executeQuery("COMMIT");
		return true;
	}
	
	public static function getPermissions($permissions_flags)
	{
		$permissions = array();
		$permissions['add'] = (($permissions_flags & CAN_ADD) == CAN_ADD);
		$permissions['edit'] = (($permissions_flags & CAN_EDIT) == CAN_EDIT);
		$permissions['see_others'] = (($permissions_flags & CAN_SEE_OTHERS) == CAN_SEE_OTHERS);
		$permissions['share'] = (($permissions_flags & CAN_SHARE) == CAN_SHARE);
		$permissions['delete'] = (($permissions_flags & CAN_DELETE) == CAN_DELETE);
		$permissions['flags'] = $permissions_flags;
		return $permissions;
	}
}
