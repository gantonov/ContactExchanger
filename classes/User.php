<?php
class User extends ObjectModel{
	protected $name;
	protected $email;
	protected $password;
	public $contact_groups;
	
	public function __construct($id = null)
	{
		$this->contact_groups = array();
		if (!empty($id))
		{
			$query = "SELECT cg.id_contact_group, cg.name, s.permissions
						FROM "._DB_PREFIX_."contact_group AS cg 
						LEFT JOIN "._DB_PREFIX_."shareing AS s 
						ON cg.id_contact_group = s.id_contact_group
						WHERE s.id_user=".$id;
			$result = DBComutator::getInstance()->executeQuery($query);
			while ($row = mysql_fetch_assoc($result))
			{
				$contact_group = array('id' => $row['id_contact_group'], 'name' => $row['name'], 
					'permissions' => ContactGroup::getPermissions($row['permissions']));
				$this->contact_groups[] = $contact_group;
			}
		}
	}
	
	public function save()
	{
		$query = "INSERT INTO "._DB_PREFIX_."user
			(name, email, password)
			VALUES ('$this->name', '$this->email', SHA1( '$this->password' )) ";
		return DBComutator::getInstance()->executeInsertQuery($query);
	}
	
	public function logIn()
	{
		$query = "SELECT `id_user` 
					FROM "._DB_PREFIX_."user 
					WHERE `email`='$this->email' AND `password`=SHA1('$this->password') 
					LIMIT 1";
		$result = DBComutator::getInstance()->executeQuery($query);
		if (mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			$_SESSION['user_id'] = $row['id_user'];
			return true;
		}
		else
			return false;
	}
			
	public static function logOut()
	{
		if (!empty($_SESSION['user_id']))
		{
			session_destroy();
		}
	}
}
