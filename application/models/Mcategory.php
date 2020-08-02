<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model Categories
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com > | 0949.133.224
* @copyright 2015
*/
class Mcategory extends MY_Model
{
	#table_name
	protected $table_name = 'categories';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function get_all_categories($component=null,$currentID =null)
	{
		$this->db->select('categories.id, categories.title,categories.title_alias, categories.public,categories.updated_at,categories.component,users.username,categories.path,categories.path_alias,categories.parent_id');
		$this->db->join('users', 'users.id = categories.created_by');
		if ($component != null) {
			$this->db->where('categories.component', $component);
		}
		if ($currentID != null) {
			$this->db->where('categories.id !=', $currentID);
		}
		$this->db->order_by('categories.parent_id', 'asc');
		return $this->db->get($this->table_name)->result_array();
	}
	public function get_path_and_path_alias($id)
	{
		$this->db->select('path, path_alias');
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row_array();
	}
	public function getCategoriesById($id,$component)
	{
		$this->db->where(array('component' => $component ,'id' => $id));
		return $this->db->get($this->table_name)->row_array();
	}
	/**
	 *
	 * Load Ajax
	 *
	 * @return [type] [description]
	 */
	public function load_ajax($component)
	{
	 	$this->db->select('id, path');
	 	$this->db->where('component', $component);
	 	$data = $this->db->get($this->table_name)->result();
	 	$result = null;
	 	if (!empty($data)) {
	 		foreach ($data as $key => $item)
	 		{
	 			$result[$key]['id'] 	= $item->id;
	 			$result[$key]['title']  = $item->path;
	 		}
	 	}
	 	return $result;
	}
	/**
	 * Check Cagegory
	*/
	public function checkCate($slug)
	{
		return $this->db->where(['public'=>1,'title_alias'=>$slug])
						->get($this->table_name)
						->row();
	}
	public function hasParent($category_id,$parent_id){
		return $this->db->select('id,title,title_alias')
						->where(['parent_id' => $parent_id,'id !=' => $category_id, 'public'=> 1])
						->get($this->table_name)
						->result();
	}
	/**
	 *
	 */
	public function getHasParent($category_id)
	{
		$info = $this->db->where('id',$category_id)->get($this->table_name)->row();
		if ($info->parent_id > 0)
		{
			return $this->db->select('id,title,title_alias')
						->where(['parent_id' => $info->parent_id,'id !=' => $category_id, 'public'=> 1])
						->get($this->table_name)
						->result();
		}
	}
	// show cate by type_id
	public function showCategoriesByType($type_id,$component)
	{
		return $this->db->select('id,title')
						->where(['type_id' => $type_id ,'parent_id >' => 0,'component' => $component])
					    ->get($this->table_name)
					    ->result();
	}
	// show Info Cate
	public function getCateInfo($category_id)
	{
		$this->db->select('id,title, title_alias, params,component,parent_id');
		$this->db->where(['id' => $category_id,'public'=>1]);
		return $this->db->get($this->table_name)->row();
	}
	// show categories have admin parent_id > 0
	public function showCategoriesParent($component)
	{
		$this->db->select('id,title');
		$this->db->where(['parent_id >' => 0,'component' => $component]);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	/**
	 * Get Categories By Parent Id
	 * 
	 * @param  [type] $category_id [description]
	 * @return [type]              [description]
	 */
	public function getCategoriesByParentId($category_id)
	{
	    $category_data = array();
	    $category_query = $this->db->query("SELECT id FROM categories WHERE parent_id = '" . (int)$category_id . "'");
	    foreach ($category_query->result() as $category) {
	    	$category_data[] = $category->id;
	    	$children = $this->getCategoriesByParentId($category->id);
	    	if ($children) {
	    		$category_data = array_merge($children, $category_data);
	    	}          
	    }
	    $category_data[] = $category_id;
	    return $category_data;
	}

	public function frontend($component)
	{
		$this->db->select('id, title, title_alias');
		$this->db->where(['component' => $component,'public'=>1]);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}
	/**
	 * $this->mcategory->loadBlocksContent($category_id)
	 * 
	 * @param  [int] $category_id
	 * @return [array]              [description]
	 */
	public function loadBlocksContent($category_id)
	{
		$result = [];
		$checkCate = $this->db->where('id',$category_id)->get('categories')->row();
		if (!empty($checkCate)) {
			$get_cate_child = $this->getAllParent($checkCate->id);
			if (!empty($get_cate_child)) {
				foreach ($get_cate_child as $k => $item){
					$result[$k]['title'] = $item->title;
					$result[$k]['title_alias'] = 'danh-muc/'.$item->path_alias;
				}
			}
		}
		return $result;
	}
}