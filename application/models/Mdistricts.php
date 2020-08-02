<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdistricts extends MY_Model {
	protected $table_name ='districts';
	public function __construct()
	{
		parent::__construct();
	}
	public function getDistrictByProvinceId($provinceId)
	{
		return $this->db->where('province_id',$provinceId)
                        ->order_by('district_id','asc')
                        ->get($this->table_name)
                        ->result();
	}
	public function getDistrict($district_id)
	{
		return $this->db->select('districts.*,provinces.name as province_name')
		                ->where('district_id',$district_id)
						->join('provinces', 'districts.province_id = provinces.province_id')
						->get($this->table_name)->row();
	}
	public function getADistrict($slug_name)
	{
		return $this->db->where('slug_name',$slug_name)->get($this->table_name)->row();
	}
    public function searchLike($title)
    {
        return $this->db->select('district_id')->like('name',$title)->get($this->table_name)->row();
    }
}

/* End of file mdistricts.php */
/* Location: ./application/models/mdistricts.php */