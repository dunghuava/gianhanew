<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mward extends MY_Model
{
	protected $table_name ='wars';
	public function __construct()
	{
		parent::__construct();
	}
	public function getWardByDistrictId($districtId)
	{
		return $this->db->where('district_id',$districtId)
					    ->get($this->table_name)
					    ->result();
	}
}

/* End of file Mward.php */
/* Location: ./application/models/Mward.php */