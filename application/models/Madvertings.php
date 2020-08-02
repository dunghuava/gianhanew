<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madvertings extends MY_Model {

	protected $table_name = 'advertings';

	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	
	public function getAll()
	{
		$this->db->select('advertings.adv_id, advertings.adv_title, advertings.adv_type, advertings.adv_image, group_advertings.title, users.username, advertings.updated_at, advertings.public');
		$this->db->join('group_advertings', 'group_advertings.id = advertings.group_id');
		$this->db->join('users', 'users.id = advertings.created_by');
		return $this->db->get($this->table_name)->result();
	}

	public function getAdverting($id)
	{
		$this->db->where('adv_id', $id);
		return $this->db->get($this->table_name)->row();
	}
	public function checkGroup($group_id)
	{
		$this->db->where('group_id', $group_id);
		$data = $this->db->get($this->table_name);
		if ($data->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function getAdvertingInPage($group_id)
	{
		$advertings = [];

		$advertings['top'] = $this->getAdvertingPositionTop($group_id,'top');
		$advertings['bar'] = $this->getAdvertingPositionTop($group_id,'bar');
		return $advertings;
	}
	public function getAdvertingPositionTop($group_id = 1,$position)
	{
		$this->db->select('adv_image, adv_title, adv_link, adv_code, adv_type');
		$this->db->where(['group_id' => $group_id, 'public' => 1 ,'adv_position' => $position]);
		$this->db->order_by('created_at','RANDOM');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}
}

/* End of file Madvertings.php */
/* Location: ./application/models/Madvertings.php */