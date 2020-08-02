<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrealestate_type extends MY_Model {
	protected $table_name = 'realestates_type';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function getPointType($type_id)
	{
		$this->db->select('type_name,type_point');
		$this->db->where('type_id', $type_id);
		return $this->db->get($this->table_name)->row();
	}
}

/* End of file Mrealestate_type.php */
/* Location: ./application/models/Mrealestate_type.php */