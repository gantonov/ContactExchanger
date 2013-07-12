<?php
class Tools {
	/**
	 * Converts user permission flags to an array
	 * @param int $permissions_flags
	 * @return array an array of user permissions
	 */
	public static function getPermissionsArray($permissions_flags)
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
