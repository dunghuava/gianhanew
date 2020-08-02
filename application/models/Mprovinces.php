<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprovinces extends MY_Model {
	protected $table_name = 'provinces';
	public function __construct()
	{
		parent::__construct();
	}
	public function allProvinces()
	{
		$this->db->order_by('province_id','asc');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}
	//
	public function getProvince($province_id)
	{
		return $this->db->where('province_id',$province_id)->get($this->table_name)->row();
	}
	public function getProvinceSlug($slug_name)
	{
		return $this->db->where('slug_name',$slug_name)->get($this->table_name)->row();
	}
    public function searchLike($title)
    {
        return $this->db->select('province_id')->like('name',$title)->get($this->table_name)->row();
    }
}

/* End of file mprovinces.php */
/* Location: ./application/models/mprovinces.php */