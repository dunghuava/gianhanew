<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mexternal_links extends MY_Model
{
	protected $table_name = 'external_links';
	public function __construct()
	{
		parent::__construct();
	}
	public function getAll()
	{
		$this->db->select('external_links.*,users.display_name');
		$this->db->join('users', 'users.id = external_links.created_by', 'left');
		return $this->db->get($this->table_name)->result();
	}
	//
	public function getLink($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row();
	}
	//
	public function getExternalLinks()
	{
		$this->db->where('public',1);
        $this->db->order_by('id','RANDOM');
		return $this->db->get('external_links')->result();
	}
}

/* End of file Mexternal_links.php */
/* Location: ./application/models/Mexternal_links.php */