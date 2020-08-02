<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mstreets extends MY_Model
{
	protected $table_name ='streets';
	public function __construct()
	{
		parent::__construct();
	}
	public function getStreetByDistrictId($districtId)
	{
		return $this->db->where('district_id',$districtId)
                        ->order_by('name','asc')
					    ->get($this->table_name)
					    ->result();
	}
}

/* End of file Mstreet.php */
/* Location: ./application/models/Mstreet.php */