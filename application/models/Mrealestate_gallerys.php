<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrealestate_gallerys extends MY_Model
{
	protected $table_name = 'realestate_gallerys';
	public function __construct()
	{
		parent::__construct();
		$this->open();
	}
	public function getRealestateGallerys($realestate_id)
	{
		$this->db->select('realestate_gallerys.id,realestate_gallerys.title,realestate_gallerys.image,realestate_gallerys.realestate_id');
		$this->db->join('realestates', 'realestates.id = realestate_gallerys.realestate_id');
		$this->db->where('realestate_gallerys.realestate_id', $realestate_id);
		return $this->db->get($this->table_name)->result();
	}
	//
	public function getGallery($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table_name)->row();
	}
}

/* End of file Mrealestate_gallerys.php */
/* Location: ./application/models/Mrealestate_gallerys.php */