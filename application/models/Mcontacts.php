<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*****************************************************
*     Tiết Kiệm Chi Phí Với Giải Pháp Mới           *
*     Email:    quochieuhcm@gmail.com               *
*     Skype:    quochieuhcm                         *
*     Tel  :    0949.133.224                        *
*     Website:  www.qhweb.biz                       *
*****************************************************
* Contacts Controller
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com  | 0949.133.224
* @copyright 2015
*/
class Mcontacts extends MY_Model {

	protected $table_name = 'contacts';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	/**
	 * Get List
	 * 
	 * @return [type] [description]
	 */
	public function getList()
	{
		$this->db->select('contacts.*, users.display_name, categories.title as cate_title');
		$this->db->join('users', 'users.id = contacts.created_by');
		$this->db->join('categories', 'categories.id = contacts.category_id');
		$this->db->order_by('contacts.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}
	/**
	 * Get_all_pages description]
	 * 
	 * @return [type] [description]
	 */
	public function get_all_pages()
	{
		$this->db->select('contacts.id, contacts.title');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return false;
		}
		
	}
	/**
	 * Load Ajax
	 * 
	 * @return [type] [description]
	 */
	public function load_ajax()
	{
		$this->db->select('contacts.id, contacts.title');
		$this->db->join('categories', 'categories.id = contacts.category_id');
		$this->db->order_by('contacts.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}
	/**
	 * Get By Id Contact
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getById($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row();
	}
	/**
	 * Load Contact
	 * 
	 * @param  [int] $contact_id [description]
	 * @return [type]             [description]
	 */
	public function loadContact($contact_id)
	{
		$this->db->where(['public' => 1,'id'=> $contact_id]);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}

	public function showContact($categories_id,$title_alias)
	{
		$this->db->select('contacts.*');
		$this->db->join('categories', 'categories.id = contacts.category_id');
		$this->db->where(['contacts.title_alias' => $title_alias,'contacts.category_id' => $categories_id,'contacts.public' => 1]);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}
	/**
	 * Show Contact
	 * 
	 * @param  [type] $contact_id [description]
	 * @return [type]             [description]
	 */
	public function getContact($contact_id)
	{
		$this->db->select('contacts.*');
		$this->db->where(['contacts.id' => $contact_id,'contacts.public' => 1]);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}
}

/* End of file Mcontacts.php */
/* Location: ./application/models/Mcontacts.php */