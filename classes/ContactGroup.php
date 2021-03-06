<?php
class ContactGroup extends ObjectModel{
	public $id;
	public $name;
	public $contacts;
	public $sharings;
	public $user_permissions;
	
	/**
	 * Extracts the required contact group from the DB
	 * @param int $id Contact group id
	 */
	public function __construct($id = null)
	{
		if (!empty($id))
			$this->set ('id', $id);
		$this->contact_groups = array();
		
		if (!empty($this->id))
		{
			$db = new DBComutator;
			
			$query = "SELECT * FROM "._DB_PREFIX_."contact_group WHERE id_contact_group=$this->id";
			$result = $db->executeQuery($query);
			if ($row = mysql_fetch_assoc($result))
			{
				$this->id = $row['id_contact_group'];
				$this->name = $row['name'];
			}
			
			$this->contacts = array();
			$query = "SELECT c.* FROM "._DB_PREFIX_."contact_in_group AS cg 
					LEFT JOIN "._DB_PREFIX_."contact AS c ON cg.id_contact = c.id_contact
					WHERE id_contact_group=$this->id";
			$result = $db->executeQuery($query);
			while ($row = mysql_fetch_assoc($result))
			{
				$this->contacts[] = array('id' => $row['id_contact'], 
					'first_name' => $row['first_name'], 
					'last_name' => $row['last_name']);
			}
			
			$query ="SELECT u.id_user, u.name, u.email, s.permissions
						FROM "._DB_PREFIX_."shareing AS s
						LEFT JOIN "._DB_PREFIX_."user AS u ON s.id_user = u.id_user
						WHERE s.id_contact_group =$this->id";
			$result = $db->executeQuery($query);
			$this->sharings = array();
			while ($row = mysql_fetch_assoc($result))
			{
				$this->sharings[] = array('user_id' => $row['id_user'],
						'user_name' => $row['name'],
						'user_email' => $row['email'],
						'user_permissions' => Tools::getPermissionsArray($row['permissions']));
			}
			
			unset($db);
			$this->user_permissions = self::getGroupPermissions($this->id, $_SESSION['user_id']);
		}
	}
	
	/**
	 * Saves the contact group to the DB
	 * @return boolean
	 */
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

		foreach ($this->sharings as $shareing) {
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
	/**
	 * Updates the DB
	 * @return boolean 
	 */
	public function update()
	{
		$query = "UPDATE "._DB_PREFIX_."contact_group 
				SET name = '$this->name' 
				WHERE id_contact_group =$this->id";
		if(DBComutator::getInstance()->executeQuery($query))
			return true;
		else
			return false;
	}
	/**
	 * Deletes a contact group
	 * @param int $id_group
	 * @return boolean 
	 */
	public static function deleteContactGroup($id_group)
	{
		$id_group = mysql_real_escape_string($id_group);
		$query = "DELETE FROM "._DB_PREFIX_."contact_group 
			WHERE id_contact_group = $id_group";
		if (!DBComutator::getInstance()->executeQuery($query))
			return false;
		$query = "SELECT c.id_contact FROM ce_contact AS c
			LEFT JOIN ce_contact_in_group AS cg ON cg.id_contact = c.id_contact
			WHERE cg.id_contact_group IS NULL";
		if ($result = DBComutator::getInstance()->executeQuery($query))
		{
			while ($row = mysql_fetch_assoc($result))
			{
				DBComutator::getInstance()->executeQuery("DELETE FROM "._DB_PREFIX_."contact WHERE id_contact=".$row['id_contact']);
			}
		}
		return true;	
	}
	/**
	 * Shares group with user
	 * @param int $id_group
	 * @param int $id_user
	 * @param int $permissions 
	 */
	public static function shareContactGroup($id_group,$id_user,$permissions)
	{
		$query = "INSERT INTO "._DB_PREFIX_."shareing (id_user, id_contact_group, permissions) 
			VALUES ($id_user, $id_group, $permissions)";
		if (DBComutator::getInstance()->executeQuery($query))
			return true;
		else
			return false;
		
	}
	/**
	 * Returns an array of the user permissions
	 * @param int $id_group
	 * @param int $id_user
	 * @return array|false an array of user permissions or false
	 */
	public static function getGroupPermissions($id_group, $id_user)
	{
		$id_group = mysql_real_escape_string($id_group);
		$id_user = mysql_real_escape_string($id_user);
		
		$query = "SELECT permissions
					FROM "._DB_PREFIX_."shareing 
					WHERE id_user=$id_user AND id_contact_group=$id_group
					LIMIT 1";
		$result = DBComutator::getInstance()->executeQuery($query);
		if (!$row = mysql_fetch_assoc($result))
			return false;
		
		return Tools::getPermissionsArray($row['permissions']);
	}
}
