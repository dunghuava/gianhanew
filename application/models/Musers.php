<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model Users
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com > | 0949.133.224
* @copyright 2015
*/
class Musers extends MY_Model
{
	protected $table_name = 'users';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function get_all_user()
	{
		return $this->db->get($table_name)->result_array();
	}
	/**
	* Check login admin
	* 
	* @param  string  $username
    * @param  string  $password (sha1) 
    * @return infomation users or false;
    */
	public function check_login($username,$password)
	{
		$login = $this->db->select('users.id as user_id,roles.id as role_id,roles.display_name,roles.level,users.username')
						  ->where(array('users.activated'=>1,'users.block'=>0,'users.username'=> $username,'users.password'=> $password))
						  ->join('assigned_roles','assigned_roles.user_id = users.id')
						  ->join('roles','roles.id = assigned_roles.role_id')
						  ->get($this->table_name);
		if ($login->num_rows() > 0){
			return $login->row_array();
		}else{
			return false;
		}
	}
	public function check_password_old($uid,$pass)
	{
		$user = $this->db->where('id', $uid)
						 ->where('password',$pass)
						 ->get($this->table_name);
		if ($user->num_rows() > 0) {
			return true;
		}else
		{
			return false;
		}
	}
	/**
	*
	*/
	public function get_users_by_id($id)
	{
		$this->db->select('users.id,users.username , users.mobile, users.address ,users.display_name,roles.level,users.activated,users.email,users.block,roles.display_name as roles_name,users.created_at,users.points');
		$this->db->join('assigned_roles', 'assigned_roles.user_id = users.id');
		$this->db->join('roles', 'roles.id = assigned_roles.role_id');
		$this->db->where('users.id', $id);
		return $this->db->get($this->table_name)->row_array();
	}
	/**
	 * [checkUsername description]
	 * @param  [type] $user [description]
	 * @param  string $id   [description]
	 * @return [type]       [description]
	 */
	public function checkUsername($user,$id="")
	{
		if($id != ""){
			$this->db->where("id !=",$id);
		}
		$this->db->where("username",$user);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() > 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	/**
	 * [checkEmail description]
	 * @param  [type] $email [description]
	 * @param  string $id    [description]
	 * @return [type]        [description]
	 */
	public function checkEmail($email,$id="")
	{
		if($id != ""){
			$this->db->where("id !=",$id);
		}	
		$this->db->where("email",$email);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() > 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
}