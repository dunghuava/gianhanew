<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model Pages
* 
* @author Pham Quoc Hieu quochieuhcm@gmail.com  | 0949.133.224
* @copyright 2015
*/
class Mpages extends MY_Model
{
	#table_name
	protected $table_name = 'pages';
	public function __construct()
	{
		parent::__construct();
		// Connection
		$this->open();
	}
	public function get_all_pages()
	{
		$this->db->select('pages.id, pages.title, pages.public,pages.title_alias,users.username');
		$this->db->join('users', 'users.id = pages.created_by');
		return $this->db->get($this->table_name)->result_array();
	}
	public function load_ajax()
	{
	 	$this->db->select('id, title');
	 	$data = $this->db->get($this->table_name)->result();
	 	$result = null;
	 	if (!empty($data)) {
	 		foreach ($data as $key => $item)
	 		{
	 			$result[$key]['id'] 	= $item->id;
	 			$result[$key]['title']  = $item->title;
	 		}
	 	}
	 	return $result;
	}
	/**
	* GET BY ID
	*/
	public function get_page_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row_array();
	}
	/**
	* Get for Frontend
	*/
	public function get_detail($alias)
	{
		$this->db->select('id,title,templates,content,params');
		$this->db->where('public', 1);
		$this->db->where('title_alias', $alias);
		return $this->db->get($this->table_name)->row_array();
	}
	public function get_date_by_templates($templates)
	{
		$this->db->select('id,title,content,image');
		$this->db->where('public', 1);
		$this->db->where('templates', $templates);
		return $this->db->get($this->table_name)->row_array();
	}
}