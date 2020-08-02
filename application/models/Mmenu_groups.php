<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Mmenu Groups
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com | 0949.133.224
* @copyright 2015
*/
class Mmenu_groups extends MY_Model {
	protected $table_name = 'menu_groups';
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Danh sách Menu
	 */
	public function getMenuGroup()
	{
		$this->db->select('menu_groups.*, users.display_name');
		$this->db->join('users', 'users.id = menu_groups.created_by');
		return $this->db->get($this->table_name)->result();
	}
	public function getGroup($id)
	{
		return $this->db->where('id', $id)->get($this->table_name)->row();
	}
	public function getList()
	{
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
}

/* End of file mmenu_groups.php */
/* Location: ./application/models/mmenu_groups.php */