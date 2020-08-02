<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msliders_groups extends MY_Model {
	protected $table_name = 'sliders_groups';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function allSlidersGroups()
	{
		$this->db->select('sliders_groups.*,users.username');
		$this->db->join('users', 'users.id = sliders_groups.created_by');
		return $this->db->get($this->table_name)->result();
	}
	public function group($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row();
	}
}

/* End of file mslider_groups.php */
/* Location: ./application/models/mslider_groups.php */