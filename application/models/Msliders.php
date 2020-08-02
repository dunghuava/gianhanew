<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msliders extends MY_Model {
	protected $table_name = 'sliders';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function getSliders()
	{
		$this->db->select('sliders.*, users.username,sliders_groups.title as group_title');
		$this->db->join('sliders_groups', 'sliders_groups.id = sliders.group_id');
		$this->db->join('users', 'users.id = sliders.created_by');
		return $this->db->get($this->table_name)->result();
	}
	public function getSlider($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row();
	}
}
/* End of file msliders.php */
/* Location: ./application/models/msliders.php */