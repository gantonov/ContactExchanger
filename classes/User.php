<?php
class User extends ObjectModel{
	protected $name;
	protected $email;
	protected $password;
	public $contact_groups;
	
	/**
	 * Extracts the required user group from the DB
	 * @param int $id user id
	 */
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
				$this->contact_groups[$row['id_contact_group']] = $contact_group;
			}
		}
	}
	
	/**
	 * Saves the user to the DB
	 * @return int user id 
	 */
	public function save()
	{
		$query = "INSERT INTO "._DB_PREFIX_."user
			(name, email, password)
			VALUES ('$this->name', '$this->email', SHA1( '$this->password' )) ";
		return DBComutator::getInstance()->executeInsertQuery($query);
	}
	
	public static function signUp($email, $name, $password)
	{
		$user = new User();
		$user->set('name',$name);
		$user->set('email',$email);
		$user->set('password',$password);
		if (!$id = $user->save())
			return false;
		$_SESSION['user_id'] = $id;
		return true;
	}
	public static function logIn($email, $password)
	{
		$email = mysql_real_escape_string($email);
		$password = mysql_real_escape_string($password);
		$query = "SELECT `id_user` 
					FROM "._DB_PREFIX_."user 
					WHERE `email`='$email' AND `password`=SHA1('$password') 
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
	
	public static function findUserByEmail($email)
	{
		$query = "SELECT `id_user` 
					FROM "._DB_PREFIX_."user 
					WHERE `email`='$email'
					LIMIT 1";
		$result = DBComutator::getInstance()->executeQuery($query);
		if (mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);
			return $row['id_user'];
		}
		else
			return false;
	}
}
