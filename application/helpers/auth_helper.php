<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Helper List Template
	*/
if (!function_exists('list_role')) {
	function list_role(){
		return array(
			'2',
			'3',
			'4'
		);
	}
}
if (!function_exists('in_list_role')) {
	function in_list_role($role){
		$list_role = list_role();
		return in_array($role, $list_role);
	}
}
if (!function_exists('check_show')) {
	function check_show($permissions,$level){
		$flag = TRUE;
		if ($level == 1) {
			$flag = TRUE;
		}else{
			$CI=& get_instance();
			$CI->db->select('users.id');
			$CI->db->join('assigned_roles', 'assigned_roles.user_id = users.id');
			$CI->db->join('roles', 'roles.id = assigned_roles.role_id');
			$CI->db->where(['roles.name'=> $permissions, 'roles.level'=>$level]);
			$data = $CI->db->get('users')->row_array();
			if (!empty($data)) {
				$flag = TRUE;
			}else{
				$flag = FALSE;
			}
		}
		return $flag;
	}
}