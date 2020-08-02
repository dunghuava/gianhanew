<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrealestate_units extends MY_Model {
	public $table_name ="realestate_units";
	public function __construct()
	{
		parent::__construct(); 
	}
	public function getUnitByTypeId($type_id)
	{
		return $this->db->where('type_id',$type_id)
						->get($this->table_name)
						->result();
	}
}

/* End of file Mrealestate_units.php */
/* Location: ./application/models/Mrealestate_units.php */