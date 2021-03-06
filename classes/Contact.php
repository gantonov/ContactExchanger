<?php
class Contact extends ObjectModel{
	public $id;
	public $first_name;
	public $last_name;
	public $telephones;
	public $emails;
	public $ims;
	public $contact_groups;
	
	/**
	 * Extracts the required contact from the DB
	 * @param int $id Contact id
	 */
	public function __construct($id = null)
	{
		if (!empty($id))
			$this->set ('id', $id);
		$this->contact_groups = array();
		
		if (!empty($this->id))
		{
			$db = new DBComutator;
			
			$query = "SELECT * FROM "._DB_PREFIX_."contact WHERE id_contact =$this->id";
			$result = $db->executeQuery($query);
			if ($row = mysql_fetch_assoc($result))
			{
				$this->id = $row['id_contact'];
				$this->first_name = $row['first_name'];
				$this->last_name = $row['last_name'];
			}
			
			$this->telephones = array();
			$query = "SELECT * FROM "._DB_PREFIX_."phone_number WHERE id_contact=$this->id";
			$result = $db->executeQuery($query);
			while ($row = mysql_fetch_assoc($result))
			{
				$this->telephones[] = $row;
			}
			
			$this->emails = array();
			$query = "SELECT * FROM "._DB_PREFIX_."email WHERE id_contact=$this->id";
			$result = $db->executeQuery($query);
			while ($row = mysql_fetch_assoc($result))
			{
				$this->emails[] = $row;
			}
			
			$this->ims = array();
			$query = "SELECT * FROM "._DB_PREFIX_."im WHERE id_contact=$this->id";
			$result = $db->executeQuery($query);
			while ($row = mysql_fetch_assoc($result))
			{
				$this->ims[] = $row;
			}
			
			$this->contact_groups = array();
			$query = "SELECT * FROM "._DB_PREFIX_."contact_in_group WHERE id_contact=$this->id";
			$result = $db->executeQuery($query);
			while ($row = mysql_fetch_assoc($result))
			{
				$this->contact_groups[] = $row['id_contact_group'];
			}
			
			unset($db);
		}
	}
	
	/**
	 * Saves the contact to the DB
	 * @return boolean
	 */
	public function save()
	{
		$db = new DBComutator();
		$db->executeQuery("BEGIN");
		if (empty($this->id))
		{
			$query = "INSERT INTO "._DB_PREFIX_."contact
				(first_name, last_name)
				VALUES ('$this->first_name', '$this->last_name') ";
			if (!$this->id = $db->executeInsertQuery($query))
			{
				$db->executeQuery ("ROLLBACK");
				return false;
			}
		}
		else
		{
			$db->executeQuery("DELETE FROM "._DB_PREFIX_."phone_number WHERE id_contact=".$this->id);
			$db->executeQuery("DELETE FROM "._DB_PREFIX_."email WHERE id_contact=".$this->id);
			$db->executeQuery("DELETE FROM "._DB_PREFIX_."im WHERE id_contact=".$this->id);
			$db->executeQuery("DELETE FROM "._DB_PREFIX_."contact_in_group WHERE id_contact=".$this->id); //TODO Restrictions
			
			$query = "UPDATE "._DB_PREFIX_."contact
				SET first_name='$this->first_name', last_name='$this->last_name'
				WHERE id_contact=$this->id";
			if (!$db->executeQuery($query))
			{
				$db->executeQuery ("ROLLBACK");
				return false;
			}
		}
		
		//insert phone numbers
		if (!empty($this->telephones))
		{
			$query = "INSERT INTO "._DB_PREFIX_."phone_number
				(id_contact, type, number, preferable) VALUES";
			foreach ($this->telephones as $telephone) 
			{
				$query .= "($this->id, '{$telephone['type']}', '{$telephone['number']}', {$telephone['preferable']}), ";
			}
			$query = substr($query,0,-2); //remove ", "
			if (!$db->executeInsertQuery($query))
			{
				echo mysql_error();
				$db->executeQuery ("ROLLBACK");
				return false;
			}
		}
		
		//insert emails
		if (!empty($this->emails))
		{
			$query = "INSERT INTO "._DB_PREFIX_."email
				(id_contact, type, email, preferable) VALUES";
			foreach ($this->emails as $email) 
			{
				echo mysql_error();
				$query .= "($this->id, '{$email['type']}', '{$email['email']}', {$email['preferable']}), ";
			}
			$query = substr($query,0,-2); //remove ", "
			if (!$db->executeInsertQuery($query))
			{
				$db->executeQuery ("ROLLBACK");
				return false;
			}
		}
		
		//insert ims
		if (!empty($this->ims))
		{
			$query = "INSERT INTO "._DB_PREFIX_."im
				(id_contact, type, value) VALUES";
			foreach ($this->ims as $im) 
			{
				$query .= " ($this->id, '{$im['type']}', '{$im['username']}'), ";
			}
			$query = substr($query,0,-2); //remove ", "
			if (!$db->executeInsertQuery($query))
			{
				$db->executeQuery ("ROLLBACK");
				return false;
			}
		}
		
		//insert contact groups
		if (empty($this->contact_groups))
		{
			echo "empty";
			$db->executeQuery ("ROLLBACK");
			return false;
		}
		else
		{
			$query = "INSERT INTO "._DB_PREFIX_."contact_in_group
				(id_contact, id_contact_group) VALUES";
			foreach ($this->contact_groups as $contact_group) 
			{
				$query .= " ($this->id, {$contact_group['id_contact_group']}), ";
			}
			$query = substr($query,0,-2); //remove ", "
			if (!$db->executeQuery($query))
			{
				$db->executeQuery ("ROLLBACK");
				return false;
			}
		}
		
		$db->executeQuery("COMMIT");
		return true;
	}
	
	/**
	 * Deletes a contact
	 * @param int $id_contact The id if the contact to be deleted
	 * @return boolean 
	 */
	public static function deleteContact($id_contact)
	{
		$id_contact = mysql_real_escape_string($id_contact);
		$query = "DELETE FROM "._DB_PREFIX_."contact 
			WHERE id_contact = $id_contact";
		if (!DBComutator::getInstance()->executeQuery($query))
			return false;
		
		return true;
	}
	
	/**
	 * Returns user permissions over a contact
	 * @param int $id_user
	 * @param int $id_contact
	 * @return int|false user permission flags 
	 */
	public static function getUserPermissions($id_user, $id_contact)
	{
		$id_user = mysql_real_escape_string($id_user);
		$id_contact = mysql_real_escape_string($id_contact);
		
		$query = "SELECT s.permissions
					FROM "._DB_PREFIX_."contact_in_group AS cg
					LEFT JOIN "._DB_PREFIX_."shareing AS s ON s.id_contact_group = cg.id_contact_group
					WHERE cg.id_contact =$id_contact AND s.id_user =$id_user";
		if (!$result = DBComutator::getInstance()->executeQuery($query))
			return false;
		if ( mysql_affected_rows() == 0)
			return false;
		$permissions = 0;
		while ($row = mysql_fetch_assoc($result))
		{
			$permissions = $permissions | $row['permissions'];
		}
		 return Tools::getPermissionsArray($permissions);
	}
}
