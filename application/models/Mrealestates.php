<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrealestates extends MY_Model
{
	protected $table_name = 'realestates';
	public function __construct()
	{
		parent::__construct();
	}

	public function getRealestates($record,$start,$approval)
	{
		$this->db->select('realestates.id, realestates.title, realestates.created_by, realestates.approval, realestates.created_at, realestates.title_alias, users.username, categories.title_alias as alias');
		$this->db->where('realestates.approval', $approval);
		$this->db->order_by('realestates.created_at', 'desc');
		$this->db->join('users','users.id = realestates.created_by');
		$this->db->join('categories','categories.id = realestates.category_id');
		$this->db->limit($record,$start);
		return $this->db->get('realestates')->result();
	}
	// Điếm
	public function countGetRealestates($approval)
	{
		$this->db->where('realestates.approval', $approval);
		return $this->db->get('realestates')->num_rows();
	}
	// lấy danh sách rap vặt của user
	public function getRealestateUserId($user_id)
	{
		$this->db->select('realestates.id, realestates.created_by, realestates.title, realestates.created_at, realestates.title_alias, categories.title_alias as category_slug, users.username,realestates_type.type_name');
		$this->db->join('users', 'users.id = realestates.created_by');
		$this->db->join('categories', 'categories.id = realestates.category_id');
		$this->db->join('realestates_type', 'realestates_type.type_id = realestates.vip_type');
		$this->db->order_by('realestates.created_at', 'desc');
		$this->db->where('realestates.created_by',$user_id);
		return $this->db->get('realestates')->result();
	}
	public function checkUserHaveReal($created_by)
	{
		$query = $this->db->where('created_by',$created_by)->get($this->table_name);
		if ($query->num_rows() > 0) {
			return true;
		}else {
			return false;
		}
	}

	public function checkCategoryHaveReal($category_id)
	{
		$query = $this->db->where('category_id',$category_id)->get($this->table_name);
		if ($query->num_rows() > 0) {
			return true;
		}else {
			return false;
		}
	}

	public function getRealestate($id){
		$query = $this->db->where('id',$id)->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}
}

/* End of file Mrealestates.php */
/* Location: ./application/models/Mrealestates.php */