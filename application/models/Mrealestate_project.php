<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrealestate_project extends MY_Model{

	protected $table_name = 'projects';
	public function __construct()
	{
		parent::__construct();
	}
	public function getProjectByDisId($district_id)
	{
		return $this->db->where('district_id',$district_id)->get($this->table_name)->result();
	}
	public function getProject($project_id)
	{
		return $this->db->select('projects.*, districts.name ,districts.pre')
						->join('districts','districts.district_id = projects.district_id')
						->where('projects.project_id',$project_id)
						->get($this->table_name)
						->row();
	}
}

/* End of file Mrealestate_project.php */
/* Location: ./application/models/Mrealestate_project.php */