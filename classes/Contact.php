<?php
class Contact extends ObjectModel{
	protected $id;
	protected $first_name;
	protected $last_name;
	protected $telephones;
	protected $emails;
	protected $ims;
	protected $contact_groups;
	
	public function __construct($id = null)
	{
		$this->contact_groups = array();
		if (!empty($id))
		{
			$query = "";
			$result = DBComutator::getInstance()->executeQuery($query);
			while ($row = mysql_fetch_assoc($result))
			{
				;
			}
		}
	}
	
	public function save()
	{
		$db = new DBComutator();
		$db->executeQuery("BEGIN");
		
		$query = "INSERT INTO "._DB_PREFIX_."contact
			(first_name, last_name)
			VALUES ('$this->first_name', '$this->last_name') ";
		if (!$this->id = $db->executeInsertQuery($query))
		{
			$db->executeQuery ("ROLLBACK");
			echo "000";
			return false;
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
				echo mysql_error();
				$db->executeQuery ("ROLLBACK");
				return false;
			}
		}
		
		$db->executeQuery("COMMIT");
		return true;
	}
}
