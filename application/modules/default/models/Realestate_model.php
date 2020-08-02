<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realestate_model extends MY_Model
{
	protected $table_name = 'realestates';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	// Chỉnh sửa
	public function getRealestateEdit($id)
	{
		return $this->db->where('id',$id)->get($this->table_name)->row();
	}
	
	public function getRealestates($user_id,$record,$start)
	{
		$this->db->select('realestates.id, realestates.title, realestates.start_date, realestates.end_date, realestates.updated_at, realestates.title_alias, categories.title_alias as slug_cate,realestates_type.type_name');
		$this->db->join('users', 'users.id = realestates.created_by');
		$this->db->join('categories', 'categories.id = realestates.category_id');
		$this->db->join('realestates_type', 'realestates_type.type_id = realestates.vip_type');
		$this->db->where('realestates.created_by', $user_id);
		$this->db->order_by('realestates.updated_at', 'desc');
		$this->db->order_by('realestates.vip_type', 'asc');
		$this->db->limit($record,$start);
		return $this->db->get($this->table_name)->result();
	}

	public function countGetRealestates($user_id)
	{
		$this->db->select('realestates.id, realestates.title, realestates.start_date, realestates.end_date, realestates.updated_at, realestates.title_alias, categories.title_alias as slug_cate,realestates_type.type_name');
		$this->db->join('users', 'users.id = realestates.created_by');
		$this->db->join('categories', 'categories.id = realestates.category_id');
		$this->db->join('realestates_type', 'realestates_type.type_id = realestates.vip_type');
		$this->db->where('realestates.created_by', $user_id);
		$this->db->order_by('realestates.updated_at', 'desc');
		$this->db->order_by('realestates.vip_type', 'asc');
		return $this->db->get($this->table_name)->num_rows();
	}
	/**
	*  Show Main
	*/
	public function getRealestateMain()
	{
		$sql  = "SELECT r.id, r.title, r.image, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 ";
		$sql .= "ORDER BY RAND() ";
		$sql .= "LIMIT 15";
		return $this->db->query($sql)->result();
	}

	/**
	*  SHOW BY ID
	*/
	public function showID($id)
	{
		$sql  = "SELECT r.*, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.pre, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class, u.display_name, u.address ,u.email, u.mobile ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "INNER JOIN users as u ON u.id = r.created_by ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.id = $id";
		return $this->db->query($sql)->row();
	}
	/**
	 * Cùng khu vực quận
	 */
	public function getRealestateSameDistrict($realestate_id,$category_id,$districtID)
	{
		$sql  = "SELECT r.id, r.title, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2  AND r.category_id = ($category_id) AND r.district_id = $districtID AND r.id != $realestate_id ";
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		$sql .= "LIMIT 6";
		return $this->db->query($sql)->result();
	}
	/**
	 *  GET REALESTATE BY CATEGORY ID
	 */
	public function getRealestateCategoryId($category_id,$record,$start,$where='')
	{
		$sql  = "SELECT r.id, r.title, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 ";
		if (is_array($category_id)){
			$sql .= "AND r.category_id IN (".implode(',', $category_id).") ";
		}else{
			$sql .= "AND r.category_id = ($category_id) ";
		}
		if ($where !='') {
			$sql .= $where.' ';
		}
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		$sql .= "LIMIT $record offset $start";
		return $this->db->query($sql)->result();
	}
	/**
	 * COUNT REALESTATE BY CATEGORY ID
	 */
	public function countRealestateCategoryId($category_id,$where='')
	{
		$sql  = "SELECT *";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 ";
		if (is_array($category_id))
		{
			$sql .= "AND r.category_id IN (".implode(',', $category_id).") ";
		}else{
			$sql .= "AND r.category_id = ($category_id) ";
		}
		if ($where !='') {
			$sql .= $where.' ';
		}
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		return $this->db->query($sql)->num_rows();
	}
	/**
	 * Get Realestate by Province Id 
	 */
	public function getRealestateByProvinceId($category_id,$province_id,$record,$start,$where='')
	{
		$sql  = "SELECT r.id, r.title, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.province_id = $province_id ";
		if (is_array($category_id))
		{
			$sql .= "AND r.category_id IN (".implode(',', $category_id).") ";
		}else{
			$sql .= "AND r.category_id = $category_id ";
		}
		if ($where !='') {
			$sql .= $where.' ';
		}
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		$sql .= "LIMIT $record offset $start";
		return $this->db->query($sql)->result();
	}
	public function countRealestateByProvinceId($category_id,$province_id,$where='')
	{
		$sql  = "SELECT * ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.province_id = $province_id ";
		if (is_array($category_id))
			$sql .= "AND r.category_id IN (".implode(',', $category_id).") ";
		else 
			$sql .= "AND r.category_id = ($category_id) ";
		if ($where !='')
			$sql .= $where.' ';
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		return $this->db->query($sql)->num_rows();
	}
	// End 
	/**
	 * Get Realestate by District Id
	 */
	public function getRealestateByDistrictId($category_id,$district_id,$record,$start,$where='')
	{
		$sql  = "SELECT r.id, r.title, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id,rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.district_id = $district_id ";
		if (is_array($category_id))
			$sql .= "AND r.category_id IN (".implode(',', $category_id).") ";
		else
			$sql .= "AND r.category_id = ($category_id) ";
		if ($where !='')
			$sql .= $where.' ';
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		$sql .= "LIMIT $record offset $start";
		return $this->db->query($sql)->result();
	}
	public function countRealestateByDistrictId($category_id,$district_id,$where='')
	{
		$sql  = "SELECT * ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.district_id = $district_id ";
		if (is_array($category_id))
			$sql .= "AND r.category_id IN (".implode(',', $category_id).") ";
		else
			$sql .= "AND r.category_id = ($category_id) ";
		if ($where !='')
			$sql .= $where.' ';
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		return $this->db->query($sql)->num_rows();
	}
	// By PROJECT
	public function getRealestateByProject($category_id,$project_id,$record,$start)
	{
		$sql  = "SELECT r.id, r.title, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.category_id = ($category_id) AND r.project_id = $project_id ";
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		$sql .= "LIMIT $record offset $start";
		return $this->db->query($sql)->result();
	}
	public function countGetRealestateByProject($category_id,$project_id)
	{
		$sql  = "SELECT r.id, r.title, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.category_id = ($category_id) AND r.project_id = $project_id ";
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		return $this->db->query($sql)->num_rows();
	}
    public function getProductList($productIds)
    {
        $sql  = "SELECT r.id, r.title, r.title_alias, r.vip_type, r.price, r.price_type, r.area, r.updated_at, c.title as title_cate ,c.title_alias as slug_cate, d.slug_name as slug_d, d.district_id, d.name as d_name, p.slug_name as slug_p, p.name as p_name, p.province_id, rtype.type_class ";
		$sql .= "FROM realestates as r ";
		$sql .= "INNER JOIN categories as c ON c.id = r.category_id ";
		$sql .= "INNER JOIN districts as d ON d.district_id = r.district_id ";
		$sql .= "INNER JOIN provinces as p ON p.province_id = r.province_id ";
		$sql .= "INNER JOIN realestates_type as rtype ON rtype.type_id = r.vip_type ";
		$sql .= "WHERE r.public = 1 AND approval = 2 AND r.id IN ($productIds)";
		$sql .= "ORDER BY r.vip_type asc , r.updated_at desc ";
		return $this->db->query($sql)->result();
    }
}

/* End of file Mrealestates.php */
/* Location: ./application/models/Mrealestates.php */