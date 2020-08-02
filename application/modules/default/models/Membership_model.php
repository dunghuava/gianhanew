<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_model extends MY_Model
{
	protected $table_name = 'users';
	public function __construct()
	{
		parent::__construct();
	}
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
	public function checkActiveUser($code)
	{
		$this->db->select('id, email');
		$this->db->where(['confirmation_code'=>$this->db->escape_str($code),'activated'=>0]);
		$data = $this->db->get($this->table_name)->row();
		if (empty($data)) {
			return FALSE;
		}else{
			$compare_email = do_hash($data->email);
			if ($compare_email == $code){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
	/**
	*
	*/
	public function get_users_by_id($id)
	{
		$this->db->select('users.id, users.username, users.display_name, roles.level, users.activated, users.email, users.block,roles.display_name as roles_name');
		$this->db->join('assigned_roles', 'assigned_roles.user_id = users.id');
		$this->db->join('roles', 'roles.id = assigned_roles.role_id');
		$this->db->where('users.id', $id);
		return $this->db->get($this->table_name)->row_array();
	}
	/**
     * 
	 * Check Username Exist
     * 
	 * @param  (string) $user
	 * @param  (int)  $id
	 * @return Boolean
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
     * 
	 * Check Email of User Exist
     * 
	 * @param  (string) $email
	 * @param  (int)  $id
	 * @return Boolean
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
    /**
     * 
	 * Check Phone of User Exist
     * 
	 * @param  (numberic) $phone
	 * @param  (int)  $id
	 * @return Boolean
	 */
    public function checkPhone($phone , $id="")
	{
		if($id != ""){
			$this->db->where("id !=",$id);
		}	
		$this->db->where("mobile",$phone);
		$query = $this->db->get($this->table_name);
		if($query->num_rows() > 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function getInfomation($id)
	{
		return $this->db->where('id', $id)
						->get($this->table_name)
						->row();
	}
	// Get diem Point
	public function pointUser($user_id)
	{
		$this->db->select('points');
		$this->db->where('id', $user_id);
		return $this->db->get($this->table_name)->row();
	}
    public function getEmail($email){
        $this->db->where("email",$email);
		$query = $this->db->get($this->table_name);
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return FALSE;
		}
    }
    // check code and id
    public function checkIdAndCode($user_id,$confirmation_code)
    {
        $this->db->where(["confirmation_code" => $confirmation_code,"id" => $user_id]);
		$query = $this->db->get($this->table_name);
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return FALSE;
		}
    }
}

/* End of file Membership_model.php */
/* Location: ./application/modules/default/models/Membership_model.php */