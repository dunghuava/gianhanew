<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrealestate_directions extends CI_Model {
	protected $table_name = 'realestate_directions';
	public function __construct()
	{
		parent::__construct();
	}
	public function getDrirection()
	{
		return $this->db->get($this->table_name)->result();
	}

}

/* End of file Mrealestate_directions.php */
/* Location: ./application/models/Mrealestate_directions.php */