<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcontent_block_types extends MY_Model {

	protected $table_name = 'content_block_types';
	public function __construct()
	{
		parent::__construct();
	}

	public function getList()
	{
		return $this->db->get($this->table_name)->result();
	}
	
	public function find($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}
	public function loadContentBlockTypes($type_id)
	{
		$query = $this->db->where('id', $type_id)->get($this->table_name);
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}
}

/* End of file Mcontent_block_types.php */
/* Location: ./application/models/Mcontent_block_types.php */