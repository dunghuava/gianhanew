<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmenus_items extends MY_Model {

	protected $table_name = 'menus_items';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function get_all_menu()
	{
		$this->db->select('menus_items.id, menus_items.title, menus_items.ordering, menus_items.public, menus_items.parent_id,users.username, menus_items.path, menus_items.path_alias,menu_groups.title as group_title');
		$this->db->join('users', 'users.id = menus_items.created_by');
		$this->db->join('menu_groups','menu_groups.id = menus_items.group_id');
		return $this->db->get($this->table_name)->result_array();
	}

	public function get_menu_by_id($id)
	{
		$this->db->select('menus_items.*, menu_types.component, menu_types.type');
		$this->db->where('menus_items.id', $id);
		$this->db->join('menu_types', 'menu_types.id = menus_items.type_id');
		return $this->db->get($this->table_name)->row();
	}
	public function get_path_and_path_alias($id)
	{
		$this->db->select('path, path_alias');
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row_array();
	}
	public function get_menus($group_id = null)
	{
		$this->db->select('menus_items.id, menus_items.title, menus_items.parent_id,menus_items.component_id, menu_types.type, menu_types.component');
		$this->db->join('menu_types', 'menu_types.id = menus_items.type_id');
		if ($group_id != null) {
			$this->db->where('menus_items.group_id', $group_id);
		}
		$this->db->order_by('menus_items.ordering', 'asc');
		$data = $this->db->get($this->table_name)->result();
		$result = null;
		if (!empty($data)) {
			foreach ($data as $key => $item) {
				$link = $this->get_alias($item->type,$item->component,$item->component_id);
			    $result[$key]['id']  		= $item->id;
				$result[$key]['title']  	= $item->title;
				$result[$key]['parent_id']	= $item->parent_id;
				$result[$key]['title_alias']= $link;
			}
		}
		return $result;
	}
	public function get_alias($type, $component, $component_id)
	{
		switch ($type) {
			case 'page':
				$this->db->select('title_alias');
				$this->db->where('id', $component_id);
				$data = $this->db->get('pages')->row();
				if (!empty($data)) {
					return base_url().$data->title_alias.'.html';
				}
				break;
			case 'articles':
				$this->db->select('articles.id,categories.title_alias as cate_title,articles.title_alias');
				$this->db->join('categories', 'categories.id = articles.category_id');
				$this->db->where('articles.id', $component_id);
				$data = $this->db->get('articles')->row();
				if (!empty($data)) {
					return base_url().$data->cate_title.'/'.$data->title_alias.'.html';
				}
				break;
			case 'category':
				$this->db->select('categories.id,categories.title_alias,parent_id,component');
				$this->db->where('id', $component_id);
				$this->db->where('component', $component);
				$data = $this->db->get('categories')->row();
				if (!empty($data)){
					return base_url().$data->title_alias;
				}
				break;
			case 'contact':
				$this->db->select('contacts.id, contacts.title_alias, categories.title_alias as cate_title');
				$this->db->join('categories', 'categories.id = contacts.category_id');
				$this->db->where('contacts.id', $component_id);
				$data = $this->db->get('contacts')->row();
				if (!empty($data)) {
					return base_url().$data->cate_title.'/'.$data->title_alias.'.html';
				}
				break;
			default:
				return base_url();
				break;
		}
	}
	/**
	* Get menu for navigation
	*/
	public function get_menu_item($group_id)
	{
		$this->db->select('id,title,parent_id');
		$this->db->where('group_id',$group_id);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0 ) {
			return $query->result();
		}else{
			return false;
		}
	}
}

/* End of file mmenus_items.php */
/* Location: ./application/models/mmenus_items.php */