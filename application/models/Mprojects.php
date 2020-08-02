<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprojects extends MY_Model{
	protected $table_name = 'articles_projects';

	public function __construct()
	{
		parent::__construct();
	}
	public $rules = array(
		'insert' => array(
			'title' => array(
				'field'=>'title',
				'label'=>'tiêu đề',
				'rules'=>'trim|required'
			),
			'category_id' => array(
				'field'=>'category_id',
				'label'=>'tiêu đề',
				'rules'=>'callback_check_select[chuyên mục]'
			),
			'province_id' => array(
				'field'=>'province_id',
				'label'=>'tiêu đề',
				'rules'=>'callback_check_select[tỉnh/thành phố]'
			),
			'district_id' => array(
				'field'=>'district_id',
				'label'=>'tiêu đề',
				'rules'=>'callback_check_select[quận/huyện]'
			),
			'title_alias' 	 => array(
					'field'=>'title_alias',
					'label'=>'tên bí danh</b>',
					'rules'=>'trim|required'
			),
			'content' => array(
				'field'=>'content',
				'label'=>'nội dung',
				'rules'=>'trim|required'
			),
			'params[meta_description]' => array(
				'field'=>'params[meta_description]',
				'label'=>'meta description</b>',
				'rules'=>'trim|required'
			),
			'params[meta_keywords]' => array(
				'field'=>'params[meta_keywords]',
				'label'=>'meta keywords',
				'rules'=>'trim|required'
			)
		),
	);
	public function getProjects($level,$user_id)
	{
		$this->db->select('articles_projects.id, articles_projects.title, articles_projects.image, articles_projects.updated_at, articles_projects.public, districts.name as district_name, districts.pre as district_pre, provinces.name as province_name, categories.title as title_cate, users.username');
		$this->db->join('provinces','provinces.province_id = articles_projects.province_id');
		$this->db->join('districts','districts.district_id = articles_projects.district_id');
		$this->db->join('users','users.id = articles_projects.created_by');
		$this->db->join('categories','categories.id = articles_projects.category_id');
		if ($level != null && ($level > 3 || $level == 3))
		{
			$this->db->where('articles_projects.created_by',$user_id);
		}
        
        $this->db->order_by('articles_projects.created_at','desc');
        $this->db->order_by('articles_projects.public','desc');
		return $this->db->get($this->table_name)->result();
	}
	/**
	* GET 1 DỰ ÁN
	*/
	public function getProject($id,$level,$user_id)
	{
		if ($level != null && ($level > 3 || $level == 3))
		{
			$this->db->where('created_by',$user_id);
		}
		$this->db->where('id',$id);
		return $this->db->get($this->table_name)->row();
	}
	/**
	* Ngoài Frontend
	*/
	// Liệt kê theo danh mục
	public function getProjectsByCateID($category_id,$record,$start)
	{
		$this->db->select('articles_projects.id, articles_projects.title, articles_projects.summary, articles_projects.params, articles_projects.image, articles_projects.title_alias, concat_ws("-", categories.title_alias,districts.slug_name) as slug_name, categories.title_alias as category_alias',false);
		//join
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id');
		$this->db->join('districts', 'districts.district_id = articles_projects.district_id');
		if (is_array($category_id)) {
			$this->db->where_in('articles_projects.category_id', $category_id);
		}else{
			$this->db->where('articles_projects.category_id', $category_id);
		}
		$this->db->where(['articles_projects.public' => 1,'articles_projects.status' => 1]);
		$this->db->limit($record,$start);
		$this->db->order_by('articles_projects.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}
	/**
	 * Điếm số record project theo ID danh mục
	 * @return number
	 */
	public function count_getProjectsByCateID($category_id)
	{
		$this->db->select('articles_projects.title');
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id');
		$this->db->join('districts', 'districts.district_id = articles_projects.district_id');
		if (is_array($category_id)) {
			$this->db->where_in('articles_projects.category_id', $category_id);
		}else{
			$this->db->where('articles_projects.category_id', $category_id);
		}
		$this->db->where(['articles_projects.public' => 1,'articles_projects.status' => 1]);
		$this->db->order_by('articles_projects.created_at', 'desc');
		return $this->db->get($this->table_name)->num_rows();
	}
	/**
	 * chi tiet
	 */
	public function show($category_id,$title_alias)
	{
		$this->db->select('articles_projects.*');
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->where(['articles_projects.public' => 1,'articles_projects.title_alias' => $title_alias, 'articles_projects.category_id' => $category_id]);
		return $this->db->get($this->table_name)->row();
	}
	/**
	 * Dự án nổi bật
	 */
	public function featureds($category_id = null)
	{
		$this->db->select('articles_projects.id,articles_projects.title,articles_projects.image, articles_projects.title_alias, categories.title_alias as category_alias');
		//join
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id');
		$this->db->join('districts', 'districts.district_id = articles_projects.district_id');
		if ($category_id != null) {
			if (is_array($category_id)) {
			$this->db->where_in('articles_projects.category_id', $category_id);
			}else{
				$this->db->where('articles_projects.category_id', $category_id);
			}
		}
		$this->db->where(['articles_projects.public' => 1,'articles_projects.status' => 1, 'articles_projects.featured' => 1]);
		$this->db->limit(1);
		$this->db->order_by('articles_projects.id', 'random');
        $this->db->order_by('articles_projects.created_at', 'desc');
		return $this->db->get($this->table_name)->row();
	}
    public function moreFeatureds($category_id = null)
    {
        $this->db->select('articles_projects.id,articles_projects.title,articles_projects.image, articles_projects.title_alias, categories.title_alias as category_alias');
		//join
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id');
		$this->db->join('districts', 'districts.district_id = articles_projects.district_id');
		if ($category_id != null) {
			if (is_array($category_id)) {
			$this->db->where_in('articles_projects.category_id', $category_id);
			}else{
				$this->db->where('articles_projects.category_id', $category_id);
			}
		}
		$this->db->where(['articles_projects.public' => 1,'articles_projects.status' => 1, 'articles_projects.featured' => 1]);
		$this->db->limit(4,1);
		$this->db->order_by('articles_projects.id', 'random');
        $this->db->order_by('articles_projects.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
    }
	public function getArticleProjectSameCate($district_id,$projectID)
	{
		$this->db->select('articles_projects.id,articles_projects.title,categories.title_alias as category_alias, articles_projects.params, articles_projects.summary, articles_projects.image, articles_projects.title_alias, concat_ws("-", categories.title_alias,districts.slug_name) as slug_name',false);
		//join
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id');
		$this->db->join('districts', 'districts.district_id = articles_projects.district_id');
		$this->db->where(['articles_projects.id !=' => $projectID, 'districts.district_id' => $district_id, 'articles_projects.public' => 1,'articles_projects.status' => 1]);
		//$this->db->limit($record,$start);
		$this->db->order_by('articles_projects.created_at', 'desc');
		return $this->db->get($this->table_name)->result();
	}
	// Hiển theo danh muc và quận
	public function mfindProjectDistrict($category_id,$district_id)
	{
		$sql  = "SELECT apro.id,apro.title, apro.params, apro.image, apro.title_alias, c.title_alias as cate_slug ";
		$sql .= "FROM articles_projects as apro ";
		$sql .= "INNER JOIN categories as c ON c.id = apro.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = apro.district_id ";
		$sql .= "WHERE apro.category_id = $category_id AND apro.district_id = $district_id";
		return $this->db->query($sql)->result();
	}
	// Hiển theo danh muc và quận
	

	public function mfindProjectProvince($category_id,$province_id,$record,$limit)
	{
		$sql  = "SELECT apro.id,apro.title, apro.params, apro.image, apro.title_alias, c.title_alias as cate_slug ";
		$sql .= "FROM articles_projects as apro ";
		$sql .= "INNER JOIN categories as c ON c.id = apro.category_id ";
		$sql .= "INNER JOIN provinces as d ON d.province_id = apro.province_id ";
		$sql .= "WHERE apro.category_id = $category_id AND apro.province_id = $province_id ";
		$sql .= "LIMIT $limit, $record";
		return $this->db->query($sql)->result();
	}
	/**
	 * Count GetProjectsByProvinceID
	 * 
	 * @param  [type] $category_id [description]
	 * @param  [type] $province_id [description]
	 * @return [type]              [description]
	 */
	public function count_getProjectsByProvinceID($category_id,$province_id)
	{
		$this->db->where(['articles_projects.category_id' => $category_id, 'articles_projects.province_id' => $province_id]);
		$this->db->join('categories', 'categories.id = articles_projects.category_id', 'left');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id', 'left');
		return $this->db->get($this->table_name)->num_rows();
	}

	public function searchProject($s,$type,$city,$district,$record,$limit)
	{
		$this->db->select('articles_projects.id, articles_projects.title, articles_projects.summary, articles_projects.params, articles_projects.image, articles_projects.title_alias, categories.title_alias as category_alias ');
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id');
		
		if ($s != '') {
			$this->db->like('articles_projects.title', $s, 'BOTH');
		}
		if ($type !=0) {
			$this->db->where('articles_projects.category_id', $type);
		}
		if ($city != 0) {
			$this->db->where('articles_projects.province_id', $city);
		}
		if ($district != 0) {
			$this->db->where('articles_projects.district_id', $district);
		}
		$this->db->limit($limit, $record);
		return $this->db->get($this->table_name)->result();
	}

	public function countSearchProject($s,$type,$city,$district)
	{
		$this->db->select('articles_projects.id, articles_projects.title, articles_projects.params, articles_projects.image, articles_projects.title_alias, categories.title_alias as category_alias ');
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->join('provinces', 'provinces.province_id = articles_projects.province_id');
		
		if ($s != '') {
			$this->db->like('articles_projects.title', $s, 'BOTH');
		}
		if ($type !=0) {
			$this->db->where('articles_projects.category_id', $type);
		}
		if ($city != 0) {
			$this->db->where('articles_projects.province_id', $city);
		}
		if ($district != 0) {
			$this->db->where('articles_projects.district_id', $district);
		}
		return $this->db->get($this->table_name)->num_rows();
	}
	/**
	 * $this->marticles->loadBlocks($params)
	 * 
	 * @param  [int] $category_id       [ Categories ID]
	 * @param  [int] $include_sub_cates [ Include sub categorie]
	 * @param  [int] $feature_only      [ Feature]
	 * @param  [int] $orderBy           [ description]
	 * @param  [string] $amount_of_data [ description]
	 * @param  [int] $direction         [ description]
	 * @return [object]                 [ description]
	 */
	public function loadBlocks($params)
	{
		
		if (!is_object($params)) {
			return false;
		}
		$this->db->select('articles_projects.title, articles_projects.title_alias, articles_projects.summary, articles_projects.image, articles_projects.updated_at, categories.title_alias as category_alias');
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->where(['articles_projects.public' => 1]);
		$this->db->where_in('articles_projects.category_id', $this->mcategory->getCategoriesByParentId($params->category_id));
		if ($params->feature_only != 0)
			$this->db->where('articles_projects.featured',1);
		$this->db->order_by('articles_projects.'.$params->orderBy, $params->direction);
		$this->db->limit($params->amount_of_data);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function loadproduct($params)
	{
		
		if (!is_object($params)) {
			return false;
		}
		$this->db->select('articles_projects.title, articles_projects.title_alias, articles_projects.summary, articles_projects.image, articles_projects.updated_at, categories.title_alias as category_alias');
		$this->db->join('categories', 'categories.id = articles_projects.category_id');
		$this->db->where(['articles_projects.public' => 1]);
		$this->db->where_in('articles_projects.category_id', $this->mcategory->getCategoriesByParentId($params->category_id));
		if ($params->feature_only != 0)
			$this->db->where('articles_projects.featured',1);
		$this->db->order_by('articles_projects.'.$params->orderBy, $params->direction);
		$this->db->limit(3);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
}

/* End of file mprojects.php */
/* Location: ./application/models/mprojects.php */