<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmenus_type extends MY_Model {
	protected $table_name = 'menu_types';
	public function __construct()
	{
		parent::__construct();
	}
	public function getMenusType()
	{
		return $this->db->get($this->table_name)->result();
	}
	public function getMenusTypeByID($id)
	{
		return $this->db->select('type,component')
						->where('id',$id)
						->get($this->table_name)
						->row();
	}
}

/* End of file mmenu_type.php */
/* Location: ./application/models/mmenu_type.php */