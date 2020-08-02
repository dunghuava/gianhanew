<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgroup_advertings extends MY_Model
{
	protected $table_name = 'group_advertings';
	
	public function __construct()
	{
		parent::__construct();
	}	

	public function allgroups()
	{
		$this->db->select('group_advertings.id, group_advertings.title, users.username, group_advertings.updated_at');
		$this->db->join('users', 'users.id = group_advertings.created_by');
		$this->db->order_by('group_advertings.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}

	public function group($group_id)
	{
		$this->db->where('id', $group_id);
		return $this->db->get($this->table_name)->row();
	}
}

/* End of file Mgroup_adverting.php */
/* Location: ./application/models/Mgroup_adverting.php */