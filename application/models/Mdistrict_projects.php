<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdistrict_projects extends MY_Model {

	protected $table_name = 'projects';
	public function __construct()
	{
		parent::__construct();
	}
	public function getProjectByDistrictId($districtId)
	{
		return $this->db->where('district_id',$districtId)
					    ->get($this->table_name)
					    ->result();
	}

}

/* End of file Mdistrict_projects.php */
/* Location: ./application/models/Mdistrict_projects.php */